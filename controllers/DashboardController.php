<?php

namespace Controllers;

use Classes\Email;
use Model\Clasificacion;
use Model\Departamento;
use Model\Empleado;
use Model\HistoricoTicket;
use Model\Subclasificacion;
use Model\Tickets;
use Model\VerEmpleados;
use Model\VerTickets;
use Model\Roles;
use MVC\Router;

class DashboardController
{

    public static function index(Router $router)
    {
        session_start();
        isLogged();
        $idRol = $_SESSION['idRol'];
        $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];



        $titulo = 'Dashboard de ' . $nombre;


        $router->renderView('dashboard/dashboard', [
            'titulo' => $titulo,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'nombre' => $nombre
        ]);
    }

    public static function generarTicket(Router $router)
    {
        session_start();
        $idRol = $_SESSION['idRol'];
        isLogged();
        $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];

        esSoporte();

        $clasificaciones = Clasificacion::allOrderByWhere('descripcion asc');



        $titulo = 'Nuevo ticket';


        $router->renderView('dashboard/generar-ticket', [

            'titulo' => $titulo,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'nombre' => $nombre,
            'extension' => $extension,
            'clasificaciones' => $clasificaciones

        ]);
    }

    public static function verTickets(Router $router)
    {
        session_start();
        isLogged();
        $idRol = $_SESSION['idRol'];
        $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $query = '';



        $titulo = 'Ver tickets';


        $router->renderView('dashboard/ver-tickets', [

            'titulo' => $titulo,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'nombre' => $nombre,
            'extension' => $extension,
            // 'tickets' => $tickets,
            'meses' => $meses

        ]);
    }

    public static function asignarTickets(Router $router)
    {
        session_start();
        isLogged();
        $idRol = $_SESSION['idRol'];
        $nombreLogueado = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];


        if ($idRol  !== '1' && $idRol !== '2')
            header('Location: /dashboard/ver-tickets');

        //si el id no es un numero redirigir
        idNotNumeric();

        $ticket = new Tickets;
        $hist = new HistoricoTicket;
        $empRequiere = new Empleado;
        $empReporta = new Empleado;
        $cla = new Clasificacion;
        $sub = new Subclasificacion;
        $deptoReporta = new Departamento;
        $deptoRequiere = new Departamento;

        $idTicket = $_GET['id'];

        $informacionTicket = $ticket->find($idTicket);
        if ($informacionTicket->idEmpAsignado !== '0')
            header('Location: /dashboard/ver-tickets');


        $informacionEmpleadoRequiere = $empRequiere->find($informacionTicket->idEmpRequiere);
        $informacionEmpleadoReporta = $empReporta->find($informacionTicket->idEmpReporta);
        $informacionDepartamentoRequiere = $deptoRequiere->find($informacionEmpleadoRequiere->idDepartamento);
        $informacionDepartamentoReporta = $deptoReporta->find($informacionEmpleadoReporta->idDepartamento);


        $clasificacion = $cla->find($informacionTicket->idClasificacionProblema);
        $subclasificacion = $sub->find($informacionTicket->idSubclasificacionProblema);


        $historico = $hist->where('idTicket', $idTicket);

        $empleados = new Empleado;

        $informatica = $empleados->allInformatica('idDepartamento', 'asc');



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $idAsignado = $_POST['idEmpAsignado'];

            date_default_timezone_set('America/Mexico_City');
            $fechaAsignacion = date('Y-m-d');



            $informacionTicket->idEmpAsigna = $expedienteLogueado;
            $informacionTicket->idEmpAsignado = $idAsignado;
            $informacionTicket->fechaAsignacion = $fechaAsignacion;

            $alertas = $informacionTicket->validarAsignarTicketNuevo();

            if (empty($alertas)) {

                $empAsignado = $empleados->find($idAsignado);
                $correoAsignado = $empAsignado->email;
                $nombreAsignado = $empAsignado->nombre . " " . $empAsignado->apellidoPaterno . " " . $empAsignado->apellidoMaterno;

                $historico->idEmpAsignado = $idAsignado;
                $historico->fecha = $fechaAsignacion;
                $informacionTicket->ticketNuevo = 1;

                $informacionTicket->guardar();
                $historico->crearHistorico();

                $email = new Email($informacionEmpleadoReporta->email, $informacionEmpleadoReporta->nombre . " " . $informacionEmpleadoReporta->apellidoPaterno . " " . $informacionEmpleadoReporta->apellidoMaterno, "");

                $email->nuevaAsignacionColaborador($nombreAsignado, $correoAsignado, $informacionEmpleadoRequiere->email, $informacionEmpleadoRequiere->nombre . ' ' . $informacionEmpleadoRequiere->apellidoPaterno . ' ' . $informacionEmpleadoRequiere->apellidoMaterno, $idTicket, $clasificacion->descripcion, $subclasificacion->descripcion, $informacionTicket->comentariosReporte, $informacionEmpleadoReporta->extension, $informacionEmpleadoRequiere->extension, $informacionDepartamentoReporta->descripcion, $informacionDepartamentoRequiere->descripcion);

                $_SESSION['mensaje'] = "Empleado asignado con éxito";

                header('Location: /dashboard/ver-tickets');
            }
        }


        $titulo = 'Asignar ticket #' . $idTicket;


        $router->renderView('dashboard/asignar-tickets', [

            'titulo' => $titulo,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'extensionRequiere' => $informacionEmpleadoRequiere->extension,
            'idTicket' => $idTicket,
            'nombreRequiere' => $informacionEmpleadoRequiere->nombre . " " . $informacionEmpleadoRequiere->apellidoPaterno . " " . $informacionEmpleadoRequiere->apellidoMaterno,
            'departamentoRequiere' => $informacionDepartamentoRequiere->descripcion,
            'comentarios' => $informacionTicket->comentariosReporte,
            'clasificacion' => $clasificacion->descripcion,
            'subclasificacion' => $subclasificacion->descripcion,
            'empleadosInformatica' => $informatica,
            'alertas' => $alertas

        ]);
    }

    public static function historialTickets(Router $router)
    {

        session_start();
        isLogged();
        $idRol = $_SESSION['idRol'];
        $expedienteLogueado = $_SESSION['id'];
        $nombreLogueado = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];

        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");


        idNotNumeric();

        $idTicket = $_GET['id'];


        //en los alias se dejo como viene en la tabla original, asi no se crea un modelo mas para la consulta, ejemplo en e.nombre su alias es el nombre de la columna del historico
        $query =  "SELECT ht.id,ht.id,ht.idTicket, e2.descripcion as idEstado,";
        $query .=  " case  e.nombre when '0' then 'Sin asignar' else e.nombre end idEmpAsignado , ht.fechaRegistro , ht.comentarios ";
        $query .= " from historico_ticket ht left outer join tickets t on t.id = ht.id ";
        $query .= " left outer join empleado e on e.id = ht.idEmpAsignado left outer join estados e2 on e2.id = ht.idEstado ";
        $query .= " where ht.idTicket = $idTicket order by ht.id desc";

        $historialTicket = HistoricoTicket::SQL($query);

        // debuguear($historialTicket);






        $titulo = 'Historico del ticket #' . $idTicket;


        $router->renderView('dashboard/historial-tickets', [

            'titulo' => $titulo,
            'historialTicket' => $historialTicket,
            'meses' => $meses,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'nombre' => $nombreLogueado


        ]);
    }

    public static function pausarTickets(Router $router)
    {
        session_start();
        isLogged();
        $idRol = $_SESSION['idRol'];
        $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];
        $alertas = [];


        idNotNumeric();


        $idTicket = $_GET['id'];


        $historico = new HistoricoTicket;
        $tickets = new Tickets;
        $empleado = new Empleado;
        $cla = new Clasificacion;
        $sub = new Subclasificacion;
        $depto = new Departamento;

        $ticket = $tickets->find($idTicket);


        if (!$ticket)
            header('Location: /dashboard/ver-tickets');


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {




            $historicoTicket = $historico->OneWhere('idTicket', $idTicket, 'id desc');


            $historicoTicket->comentarios = $_POST['comentarios'];



            $alertas = $historicoTicket->validarComentarioTicketPausado();


            if (empty($alertas)) {
                $historicoTicket->id = null;
                date_default_timezone_set('America/Mexico_City');
                $historicoTicket->fechaRegistro = date('Y-m-d');
                $historicoTicket->idEstado = 2;

                $ticketToUpdate = $tickets->find($idTicket);

                $ticketToUpdate->idEstado = 2;
                $ticketToUpdate->ticketNuevo = 0;
                $ticketToUpdate->comentariosSoporte = $_POST['comentarios'];

                $empleadoAsignado = $empleado->find($ticketToUpdate->idEmpAsigna);
                $empleadoReporta = $empleado->find($ticketToUpdate->idEmpReporta);
                $empleadoRequiere = $empleado->find($ticketToUpdate->idEmpRequiere);

                $departamentoReporta = $depto->find($empleadoReporta->idDepartamento);
                $departamentoRequiere = $depto->find($empleadoRequiere->idDepartamento);

                $clasificacion = $cla->find($ticketToUpdate->idClasificacionProblema);
                $subClasificacion = $sub->find($ticketToUpdate->idSubclasificacionProblema);
                $motivo = $_POST['comentarios'];



                $resultadoTicket = $ticketToUpdate->guardar();
                $resultadoHistorico = $historicoTicket->crearHistorico();

                $email = new Email($empleadoReporta->email, $empleadoAsignado->nombre . ' ' . $empleadoReporta->apellidoPaterno . ' ' . $empleadoReporta->apellidoMaterno, '');
                $email->pausarTicket(
                    $empleadoAsignado->nombre . ' ' . $empleadoAsignado->apellidoPaterno . ' ' . $empleadoAsignado->apellidoMaterno,
                    $empleadoAsignado->email,
                    $empleadoRequiere->email,
                    $empleadoRequiere->nombre . ' ' . $empleadoRequiere->apellidoPaterno . ' ' . $empleadoRequiere->apellidoMaterno,
                    $idTicket,
                    $clasificacion->descripcion,
                    $subClasificacion->descripcion,
                    $ticketToUpdate->comentariosReporte,
                    $empleadoReporta->extension,
                    $empleadoRequiere->extension,
                    $departamentoReporta->descripcion,
                    $departamentoRequiere->descripcion,
                    $motivo
                );

                $_SESSION['mensaje'] = "El ticket #$idTicket fue pausado";


                if ($resultadoTicket && $resultadoHistorico)
                    header('Location: /dashboard/ver-tickets');
            }
        }



        $titulo = 'Pausar el ticket #' . $idTicket;


        $router->renderView('dashboard/pausar-tickets', [

            'titulo' => $titulo,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'nombre' => $nombre,
            'extension' => $extension,
            'idTicket' => $idTicket,
            'alertas' => $alertas


        ]);
    }

    public static function escalarTickets(Router $router)
    {
        session_start();
        $idRol = $_SESSION['idRol'];
        isLogged();
        $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];
        $alertas = [];

        esSoporte();

        idNotNumeric();

        $historico = new HistoricoTicket;
        $tickets = new Tickets;
        $empleado = new Empleado;
        $cla = new Clasificacion;
        $sub = new Subclasificacion;
        $depto = new Departamento;




        $idTicket = $_GET['id'];

        //existe el ticket en base dedatos
        $ticket = $tickets->find($idTicket);
        if (!$ticket)
            header('Location: /dashboard/ver-tickets');
        $informatica = $empleado->allInformatica('idDepartamento', 'asc');


        $idEmpAnterior = $ticket->idEmpAsignado;

        $empleadoAnterior = $empleado->find($idEmpAnterior);



        $ticket->comentariosSoporte = '';
        $ticket->idEmpAsignado = '';




        $empleadoReporta = $empleado->find($ticket->idEmpReporta);
        $empleadoRequiere = $empleado->find($ticket->idEmpRequiere);




        $departamentoReporta = $depto->find($empleadoReporta->idDepartamento);
        $departamentoRequiere = $depto->find($empleadoRequiere->idDepartamento);

        $clasificacion = $cla->find($ticket->idClasificacionProblema);
        $subClasificacion = $sub->find($ticket->idSubclasificacionProblema);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $ticket->comentariosSoporte = $_POST['comentariosSoporte'];
            $ticket->idEmpAsignado = $_POST['idEmpAsignado'];
            $empleadoAsignado = $empleado->find($ticket->idEmpAsignado);

            // debuguear($_POST);
            $alertas = $ticket->validarEscalarTicket();

            $historicoTicket = $historico->OneWhere('idTicket', $idTicket, 'id desc');

            $historicoTicket->comentarios = $_POST['comentariosSoporte'];






            if (empty($alertas)) {
                $historicoTicket->id = null;
                date_default_timezone_set('America/Mexico_City');
                $historicoTicket->fechaRegistro = date('Y-m-d');
                $historicoTicket->idEstado = 3;
                $historicoTicket->idEmpAsignado = $_POST['idEmpAsignado'];



                $ticket->idEstado = 3;
                $ticket->ticketNuevo = 1;


                $motivo = $_POST['comentariosSoporte'];



                $resultadoTicket = $ticket->guardar();
                $resultadoHistorico = $historicoTicket->crearHistorico();

                $email = new Email($empleadoReporta->email, $empleadoReporta->nombre . ' ' . $empleadoReporta->apellidoPaterno . ' ' . $empleadoReporta->apellidoMaterno, '');
                $email->escalarTicket(
                    $empleadoAnterior->nombre . ' ' . $empleadoAnterior->apellidoPaterno . ' ' . $empleadoAnterior->apellidoMaterno,
                    $empleadoAnterior->email,
                    $empleadoAsignado->nombre . ' ' . $empleadoAsignado->apellidoPaterno . ' ' . $empleadoAsignado->apellidoMaterno,
                    $empleadoAsignado->email,
                    $empleadoRequiere->email,
                    $empleadoRequiere->nombre . ' ' . $empleadoRequiere->apellidoPaterno . ' ' . $empleadoRequiere->apellidoMaterno,
                    $idTicket,
                    $clasificacion->descripcion,
                    $subClasificacion->descripcion,
                    $ticket->comentariosReporte,
                    $empleadoReporta->extension,
                    $empleadoRequiere->extension,
                    $departamentoReporta->descripcion,
                    $departamentoRequiere->descripcion,
                    $motivo
                );

                $_SESSION['mensaje'] = "El ticket #$idTicket fue escalado";


                if ($resultadoTicket && $resultadoHistorico)
                    header('Location: /dashboard/ver-tickets');
            }
        }



        $titulo = 'Escalar el ticket #' . $idTicket;


        $router->renderView('dashboard/escalar-tickets', [

            'titulo' => $titulo,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'nombre' => $nombre,
            'extension' => $extension,
            'idTicket' => $idTicket,
            'alertas' => $alertas,
            'empleadosInformatica' => $informatica,
            'ticket' => $ticket,
            'nombreRequiere' => $empleadoRequiere->nombre . " " . $empleadoRequiere->apellidoPaterno . " " . $empleadoRequiere->apellidoMaterno,
            'extensionRequiere' => $empleadoRequiere->extension,
            'departamentoRequiere' => $departamentoRequiere->descripcion,
            'comentarios' => $ticket->comentariosReporte,
            'clasificacion' => $clasificacion->descripcion,
            'subclasificacion' => $subClasificacion->descripcion,
            'empleadoAnterior' => $empleadoAnterior


        ]);
    }

    public static function  cerrarTickets(Router $router)
    {
        session_start();
        $idRol = $_SESSION['idRol'];
        isLogged();
        $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];
        $alertas = [];


        idNotNumeric();


        $idTicket = $_GET['id'];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {



            $historico = new HistoricoTicket;
            $tickets = new Tickets;
            $empleado = new Empleado;
            $cla = new Clasificacion;
            $sub = new Subclasificacion;
            $depto = new Departamento;


            $historicoTicket = $historico->OneWhere('idTicket', $idTicket, 'id desc');


            $historicoTicket->comentarios = $_POST['comentarios'];

            // debuguear($historicoTicket);


            $alertas = $historicoTicket->validarComentarioTicketCerrado();


            if (empty($alertas)) {
                $historicoTicket->id = null;
                date_default_timezone_set('America/Mexico_City');
                $historicoTicket->fechaRegistro = date('Y-m-d');
                $historicoTicket->idEstado = 4;

                $ticketToUpdate = $tickets->find($idTicket);

                $ticketToUpdate->idEstado = 4;
                $ticketToUpdate->ticketNuevo = 0;
                $ticketToUpdate->comentariosSoporte = $_POST['comentarios'];

                $empleadoAsignado = $empleado->find($ticketToUpdate->idEmpAsigna);
                $empleadoReporta = $empleado->find($ticketToUpdate->idEmpReporta);
                $empleadoRequiere = $empleado->find($ticketToUpdate->idEmpRequiere);

                $departamentoReporta = $depto->find($empleadoReporta->idDepartamento);
                $departamentoRequiere = $depto->find($empleadoRequiere->idDepartamento);

                $clasificacion = $cla->find($ticketToUpdate->idClasificacionProblema);
                $subClasificacion = $sub->find($ticketToUpdate->idSubclasificacionProblema);
                $motivo = $_POST['comentarios'];




                $resultadoTicket = $ticketToUpdate->guardar();
                $resultadoHistorico = $historicoTicket->crearHistorico();

                $email = new Email($empleadoReporta->email, $empleadoAsignado->nombre . ' ' . $empleadoReporta->apellidoPaterno . ' ' . $empleadoReporta->apellidoMaterno, '');
                $email->cerrarTicket(
                    $empleadoAsignado->nombre . ' ' . $empleadoAsignado->apellidoPaterno . ' ' . $empleadoAsignado->apellidoMaterno,
                    $empleadoAsignado->email,
                    $empleadoRequiere->email,
                    $empleadoRequiere->nombre . ' ' . $empleadoRequiere->apellidoPaterno . ' ' . $empleadoRequiere->apellidoMaterno,
                    $idTicket,
                    $clasificacion->descripcion,
                    $subClasificacion->descripcion,
                    $ticketToUpdate->comentariosReporte,
                    $empleadoReporta->extension,
                    $empleadoRequiere->extension,
                    $departamentoReporta->descripcion,
                    $departamentoRequiere->descripcion,
                    $motivo
                );

                $_SESSION['mensaje'] = "El ticket #$idTicket fue cerrado";


                if ($resultadoTicket && $resultadoHistorico)
                    header('Location: /dashboard/ver-tickets');
            }
        }



        $titulo = 'Cerrar el ticket #' . $idTicket;


        $router->renderView('dashboard/cerrar-tickets', [

            'titulo' => $titulo,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'nombre' => $nombre,
            'extension' => $extension,
            'idTicket' => $idTicket,
            'alertas' => $alertas


        ]);
    }

    public static function verEmpleados(Router $router)
    {
        session_start();
        isLogged();
        isAdmin();
        $idRol = $_SESSION['idRol'];
        // $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        // $extension = $_SESSION['extension'];
        $query = 'SELECT  e.id, e.nombre, e.apellidoPaterno, e.apellidoMaterno,e.email, e.extension, r.descripcion as rol, d.descripcion as departamento, e.estatus FROM empleado as e left outer join departamento d on e.idDepartamento = d.id left outer join roles as r on e.idRol = r.id;
        ';

        $empleados = VerEmpleados::SQL($query);





        $titulo = 'Empleados';


        $router->renderView('dashboard/empleados', [

            'titulo' => $titulo,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'empleados' => $empleados

        ]);
    }

    public static function altaBajaEmpleado()
    {

        $id = $_POST['id'];

        if (!is_numeric($id)) //si no es un numero regresar al dashboard
            header('Location: /dashboard/empleados');

        $empleado = Empleado::findEmpleado($id);
        session_start();
        if ($empleado->estatus === '1') {
            $empleado->estatus = '0';
            $_SESSION['mensaje'] = 'Empleado dado de baja';
        } else {
            $empleado->estatus = '1';
            $_SESSION['mensaje'] = 'Empleado dado de alta';
        }


        $empleado->actualizarEmpleado();


        header('Location: /dashboard/empleados');
    }


    public static function editarEmpleado(Router $router)
    {


        session_start();
        isLogged();
        isAdmin();
        $idRol = $_SESSION['idRol'];

        $expedienteLogueado = $_SESSION['id'];
        $alertas = [];
        $id = $_GET['id'];
        idNotNumeric($id);

        $usuario = Empleado::find($id);



        $departamentos =  Departamento::allOrderBy('descripcion asc');
        $roles = Roles::allOrderby('id asc');



        // debuguear($usuario);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $expedienteAnterior = $usuario->id;
            $correoAnterior = $usuario->email;
            //sincroniza los datos de post con los de la base de datos
            $usuario->sincronizar($_POST);

            $alertas = $usuario->validarEdicion();

            $existeUsuarioCorreo = Empleado::whereAndLogIn('id', $usuario->id, 'email', $usuario->email);
            $existeExpediente = Empleado::whereLogin('id', $usuario->id);
            $existeCorreo = Empleado::whereLogin('email', $usuario->email);
            if ($expedienteAnterior !== $usuario->id && $correoAnterior !== $usuario->email) {

                if ($existeUsuarioCorreo) {
                    Empleado::setAlerta('error', 'Ya existe un empleado registrado con ese expediente y correo');
                } else if ($existeExpediente) {
                    Empleado::setAlerta('error', 'Ya existe un empleado registrado con ese expediente');
                } else if ($existeCorreo) {
                    Empleado::setAlerta('error', 'Ya existe un empleado registrado con ese correo');
                }
            } else {
                if ($expedienteAnterior !== $usuario->id) {
                    if ($existeExpediente) {
                        Empleado::setAlerta('error', 'Ya existe un empleado registrado con ese expediente');
                    }
                    if ($correoAnterior !== $usuario->email) {


                        if ($existeCorreo) {
                            Empleado::setAlerta('error', 'Ya existe un empleado registrado con ese correo');
                        }
                    }
                }
            }

            $alertas = Empleado::getAlertas();


            if (empty($alertas)) {


                //SINCRONIZAR CON POST


                //EDITAR EL EMPLEADO CON WHERE EL EXPEDIENTE ES EL ANTERIOR
                $resultado =  $usuario->actualizarEmpleado($expedienteAnterior);

                if ($resultado) {
                    session_start();
                    $_SESSION['mensaje'] = 'Empleado actualizado con éxito';
                    header('Location: /dashboard/empleados');
                }
            } //if alertas
        }

        // Render a la vista
        $router->renderView('dashboard/editar-empleado', [

            'titulo' => 'Editar empleado',
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'usuario' => $usuario,
            'departamentos' => $departamentos,
            'roles' => $roles,
            'alertas' => $alertas



        ]);
    }


    public static function verClasificaciones(Router $router)
    {
        session_start();
        isLogged();
        isAdmin();
        $idRol = $_SESSION['idRol'];
        // $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        // $extension = $_SESSION['extension'];
        
        $clasificaciones = Clasificacion::allOrderBy('id asc');
        




        $titulo = 'Clasificación de averias';


        $router->renderView('dashboard/clasificaciones', [

            'titulo' => $titulo,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'clasificaciones' => $clasificaciones

        ]);
    }
}
