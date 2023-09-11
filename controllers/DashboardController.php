<?php

namespace Controllers;

use Classes\Email;
use Model\Clasificacion;
use Model\Departamento;
use Model\Empleado;
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
        $expedienteReporta = '';
        $expedienteRequiere = '';

        $alertas = [];
        $ticket = new Tickets;        
        $clasificaciones = Clasificacion::allOrderBy('descripcion asc');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $expedienteRequiere = $ticket->idEmpRequiere;
            $expedienteReporta = $ticket->idEmpReporta;
            $ticket->sincronizar($_POST);
            $alertas = $ticket->validarTicketNuevo();
            $existeExpReporta = Empleado::find($ticket->idEmpReporta);
            $existeExpRequiere = Empleado::find($ticket->idEmpRequiere);
            if(!$existeExpReporta)
            {
                Tickets::setAlerta('error','No existe el empleado que reporta el ticket');
                $alertas = Tickets::getAlertas();
            }
            if(!$existeExpRequiere){
                Tickets::setAlerta('error','No existe el empleado que requiere el ticket');
                $alertas = Tickets::getAlertas();
            }
            // debuguear($clasificaciones);
           

            if(empty($alertas)){

          

            
          
            // debuguear("si existe");
            // else
            // debuguear("no existe");

            // debuguear($ticket);

            

        }

        // comentarios
        // idEstado (abierto)
        // idEmpReporta (exp)
        // idEmpRequiere (exp)
        // extension
        // idClasificacionProblema
        // idsubclasificacionProblema
        // ticketNuevo = 1



        // debuguear($extension);
    }


        $titulo = 'Generar nuevo ticket';


        $router->renderView('dashboard/generar-ticket', [
            'alertas' =>$alertas,
            'titulo' => $titulo,
            'idRol' => $idRol,
            'expedienteLogueado' => $expedienteLogueado,
            'expedienteReporta' => $expedienteReporta,
            'expedienteRequiere' => $expedienteRequiere,
            'nombre' => $nombre,
            'extension' => $extension,
            'clasificaciones' => $clasificaciones,
            'ticket'=>$ticket
        ]);
    }
}
