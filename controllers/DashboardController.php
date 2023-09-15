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



        $titulo = 'Dashboard de ' . $nombre . ' - ' . $expedienteLogueado;


        $router->renderView('dashboard/index', [
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
        $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];


        $clasificaciones = Clasificacion::allOrderBy('descripcion asc');



        $titulo = 'Generar nuevo ticket';


        $router->renderView('dashboard/generar-ticket', [

            'titulo' => $titulo,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'nombre' => $nombre,
            'extension' => $extension,
            'clasificaciones' => $clasificaciones

        ]);
    }



    public static function verTickets(Router $router){
        session_start();
        $idRol = $_SESSION['idRol'];
        $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $query ='';

        if($idRol ==='1'|| $idRol ==='2') {//si es mesa de ayuda
        //si el rol es de administrador o de mesa de ayuda

        $query ="SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
        $query.= " CASE e.nombre WHEN '0' THEN 'Sin asignar' ELSE e.nombre END AS nombreAsigna,";
        $query.= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE e2.nombre END AS atiende,";
        $query.= " e4.nombre AS nombreRequiere,";
        $query.= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios";
        $query.= " FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON t.idEmpAsignado = e2.id ";
        $query.= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
        $query.= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
        $query.= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
        $query.= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
        $query.= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema order by t.id desc";
        }
        else if($idRol==='3' ) //si es soporte solo asignados a él
        {
            $query ="SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
            $query.= " CASE e.nombre WHEN '0' THEN 'Sin asignar' ELSE e.nombre END AS nombreAsigna,";
            $query.= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE e2.nombre END AS atiende,";
            $query.= " e4.nombre AS nombreRequiere,";
            $query.= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios";
            $query.= " FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON t.idEmpAsignado = e2.id ";
            $query.= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
            $query.= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
            $query.= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
            $query.= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
            $query.= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where t.idEmpAsignado = $expedienteLogueado order by t.id desc";
        }
        else if($idRol === '4'){//si es colaborador ver los reportados por el
            $query ="SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
            $query.= " CASE e.nombre WHEN '0' THEN 'Sin asignar' ELSE e.nombre END AS nombreAsigna,";
            $query.= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE e2.nombre END AS atiende,";
            $query.= " e4.nombre AS nombreRequiere,";
            $query.= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios";
            $query.= " FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON t.idEmpAsignado = e2.id ";
            $query.= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
            $query.= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
            $query.= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
            $query.= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
            $query.= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where t.idEmpRequiere = $expedienteLogueado order by t.id desc";
        }
   


        //si el perfil es de colaborador ver solo los registrados por él
        $tickets = VerTickets::SQL($query);


        // debuguear($tickets);



        $titulo = 'Ver tickets';


        $router->renderView('dashboard/ver-tickets', [

            'titulo' => $titulo,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'nombre' => $nombre,
            'extension' => $extension,
            'tickets' =>$tickets,
            'meses'=>$meses

        ]);
    }



    public static function asignarTickets(Router $router)
    {
        session_start();
        $idRol = $_SESSION['idRol'];
        $nombreLogueado = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];


        if ($idRol  !== '1' && $idRol !== '2')
            header('Location: /dashboard/ver-tickets');

        if (!is_numeric($_GET['id']))
            header('Location: /dashboard/ver-tickets');

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
          

            

            // debuguear($idAsignado);
            
            $fechaAsignacion = date('Y-m-d');
            
            
            $informacionTicket->idEmpAsigna = $expedienteLogueado;
            $informacionTicket->idEmpAsignado = $idAsignado;
            $informacionTicket->fechaAsignacion = $fechaAsignacion;
            


            
            $alertas = $informacionTicket->validarAsignarTicketNuevo();


          
            
            
            //debuguear(($informacionTicket));

            if (empty($alertas)) {

                $empAsignado = $empleados->find($idAsignado);
                $correoAsignado = $empAsignado->email;
                $nombreAsignado = $empAsignado->nombre." ".$empAsignado->apellidoPaterno." ".$empAsignado->apellidoMaterno;


                $historico->idEmpAsignado = $idAsignado;
                $historico->fecha = $fechaAsignacion;
                $informacionTicket->guardar();
                $historico->crearHistorico();

                $email = new Email($informacionEmpleadoReporta->email,$informacionEmpleadoReporta->nombre." ".$informacionEmpleadoReporta->apellidoPaterno." ".$informacionEmpleadoReporta->apellidoMaterno, "");

                $email->nuevaAsignacionColaborador($nombreAsignado,$correoAsignado, $informacionEmpleadoRequiere->email,$informacionEmpleadoRequiere->nombre.' '.$informacionEmpleadoRequiere->apellidoPaterno.' '.$informacionEmpleadoRequiere->apellidoMaterno, $idTicket,$clasificacion->descripcion,$subclasificacion->descripcion,$informacionTicket->comentariosReporte,$informacionEmpleadoReporta->extension,$informacionEmpleadoRequiere->extension, $informacionDepartamentoReporta->descripcion,$informacionDepartamentoRequiere->descripcion);
                
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
            'nombreRequiere' => $informacionEmpleadoRequiere->nombre . " " . $informacionEmpleadoRequiere->apellidoParterno . " " . $informacionEmpleadoRequiere->apellidoMaterno,
            'departamentoRequiere' => $informacionDepartamentoRequiere->descripcion,
            'comentarios' => $informacionTicket->comentariosReporte,
            'clasificacion' => $clasificacion->descripcion,
            'subclasificacion' => $subclasificacion->descripcion,
            'empleadosInformatica' => $informatica,
            'alertas' => $alertas
            


        ]);
    }
}
