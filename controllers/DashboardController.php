<?php

namespace Controllers;

use Classes\Email;
use Model\Clasificacion;
use Model\Departamento;
use Model\Empleado;
use Model\HistoricoTicket;
use Model\Subclasificacion;
use Model\Tickets;
use Model\VerTickets;
use MVC\Router;

class DashboardController
{

    public static function index(Router $router)
    {
        isLogged();
        session_start();
        $idRol = $_SESSION['idRol'];
        $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];



        $titulo = 'Inicio';


        $router->renderView('dashboard/dashboard', [
            'titulo' => $titulo,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'nombre' => $nombre
        ]);
    }

    public static function generarTicket(Router $router)
    {
        isLogged();
        session_start();
        $idRol = $_SESSION['idRol'];
        $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];


        $clasificaciones = Clasificacion::allOrderBy('descripcion asc');



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
        isLogged();
        session_start();
        $idRol = $_SESSION['idRol'];
        $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $query = '';

        // if ($idRol === '1' || $idRol === '2') { //si es mesa de ayuda
        //     //si el rol es de administrador o de mesa de ayuda

        //     $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
        //     $query .= " CASE e.nombre WHEN '0' THEN 'Sin asignar' ELSE e.nombre END AS nombreAsigna,";
        //     $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE e2.nombre END AS atiende,";
        //     $query .= " e4.nombre AS nombreRequiere,";
        //     $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios";
        //     $query .= " FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON t.idEmpAsignado = e2.id ";
        //     $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
        //     $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
        //     $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
        //     $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
        //     $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema order by t.id desc";
        // } else if ($idRol === '3') //si es soporte solo asignados a él
        // {
        //     $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
        //     $query .= " CASE e.nombre WHEN '0' THEN 'Sin asignar' ELSE e.nombre END AS nombreAsigna,";
        //     $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE e2.nombre END AS atiende,";
        //     $query .= " e4.nombre AS nombreRequiere,";
        //     $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios";
        //     $query .= " FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON t.idEmpAsignado = e2.id ";
        //     $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
        //     $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
        //     $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
        //     $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
        //     $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where t.idEmpAsignado = $expedienteLogueado order by t.id desc";
        // } else if ($idRol === '4') { //si es colaborador ver los reportados por el
        //     $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
        //     $query .= " CASE e.nombre WHEN '0' THEN 'Sin asignar' ELSE e.nombre END AS nombreAsigna,";
        //     $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE e2.nombre END AS atiende,";
        //     $query .= " e4.nombre AS nombreRequiere,";
        //     $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios";
        //     $query .= " FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON t.idEmpAsignado = e2.id ";
        //     $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
        //     $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
        //     $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
        //     $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
        //     $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where t.idEmpRequiere = $expedienteLogueado order by t.id desc";
        // }



        // //si el perfil es de colaborador ver solo los registrados por él
        // $tickets = VerTickets::SQL($query);


        // // debuguear($tickets);



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
        isLogged();
        session_start();
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


        $titulo = 'Asignar tickets';


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

        isLogged();
        session_start();
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
        isLogged();
        session_start();
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
        isLogged();
        session_start();
        $idRol = $_SESSION['idRol'];
        $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];
        $alertas = [];


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
        isLogged();
        session_start();
        $idRol = $_SESSION['idRol'];
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
}
