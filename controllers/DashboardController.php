<?php

namespace Controllers;

use Classes\Email;
use Model\Clasificacion;
use Model\Departamento;
use Model\Empleado;
use Model\HistoricoTicket;
use Model\Subclasificacion;
use Model\Tickets;
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



    public static function verTickets(Router $router)
    {
        session_start();
        $idRol = $_SESSION['idRol'];
        $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];

        $query ="SELECT t.id as dTicket,";
        $query.= "CASE e.nombre WHEN '0' THEN 'Aun sin asignar' ELSE e.nombre END AS nombreAsigna,";
        $query.= "CASE e2.nombre WHEN '0' THEN 'Aun sin asignar' ELSE e2.nombre END AS atiende,";
        $query.= "e4.nombre AS nombreRequiere,";
        $query.= "e5.descripcion AS estadoTicket, cp.descripcion AS clasificación , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios";
        $query.= "FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON t.idEmpAsignado = e2.id ";
        $query.= "LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
        $query.= "LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
        $query.= "LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
        $query.= "LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
        $query.= "LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema";

        $tickets = Tickets::SQL($query);

        debuguear($tickets);


        $titulo = 'Ver tickets';


        $router->renderView('dashboard/ver-tickets', [

            'titulo' => $titulo,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'nombre' => $nombre,
            'extension' => $extension,
            'tickets' =>$tickets

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
        $empRequiere = new Empleado;
        $depto = new Departamento;
        $cla = new Clasificacion;
        $sub = new Subclasificacion;
        $hist = new HistoricoTicket;

        $idTicket = $_GET['id'];

        $informacionTicket = $ticket->find($idTicket);
        if ($informacionTicket->idEmpAsignado !== '0')
            header('Location: /dashboard/ver-tickets');


        $informacionEmpleado = $empRequiere->find($informacionTicket->idEmpRequiere);
        $informacionDepartamento = $depto->find($informacionEmpleado->idDepartamento);

        $clasificacion = $cla->find($informacionTicket->idClasificacionProblema);
        $subclasificacion = $sub->find($informacionTicket->idSubclasificacionProblema);


        $historico = $hist->where('idTicket', $idTicket);

        


        $empleados = new Empleado;

        $informatica = $empleados->allInformatica('idDepartamento', 'asc');

        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

           
            $idAsignado = $_POST['idEmpAsignado'];


            
            $fechaAsignacion = date('Y-m-d');
            
            
            $informacionTicket->idEmpAsigna = $expedienteLogueado;
            $informacionTicket->idEmpAsignado = $idAsignado;
            $informacionTicket->fechaAsignacion = $fechaAsignacion;
            


            
            $alertas = $informacionTicket->validarAsignarTicketNuevo();


          
            
            
            //debuguear(($informacionTicket));

            if (empty($alertas)) {

                $historico->idEmpAsignado = $idAsignado;
                $historico->fecha = $fechaAsignacion;
                $informacionTicket->guardar();
                $historico->crearHistorico();
                
                $_SESSION['mensaje'] = "Empleado asignado con éxito";

                header('Location: /dashboard/ver-tickets');

            }







        }











        $titulo = 'Asignar tickets';


        $router->renderView('dashboard/asignar-tickets', [

            'titulo' => $titulo,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'extensionRequiere' => $informacionEmpleado->extension,
            'idTicket' => $idTicket,
            'nombreRequiere' => $informacionEmpleado->nombre . " " . $informacionEmpleado->apellidoParterno . " " . $informacionEmpleado->apellidoMaterno,
            'departamentoRequiere' => $informacionDepartamento->descripcion,
            'comentarios' => $informacionTicket->comentariosReporte,
            'clasificacion' => $clasificacion->descripcion,
            'subclasificacion' => $subclasificacion->descripcion,
            'empleadosInformatica' => $informatica,
            'alertas' => $alertas


        ]);
    }
}
