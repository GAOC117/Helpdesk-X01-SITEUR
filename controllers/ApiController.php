<?php


namespace Controllers;


use Model\Departamento;
use Model\Empleado;
use Model\HistoricoTicket;
use Model\Subclasificacion;
use Model\Tickets;

class ApiController
{

    public static function obtenerEmpleado(){
        $expediente = $_GET['idEmp'];
        $empleado = Empleado::find($expediente);
        

        echo json_encode($empleado);
    }


    public static function obtenerSubclasificacion(){
        $clasificacion = $_GET['idClasificacion'];
         
     
        $subclasificacion = Subclasificacion::allWhere('idClasificacion',$clasificacion,'id asc');
        // debuguear($subclasificacion);

        echo json_encode($subclasificacion);
    }


    public static function generarTicket(){
    
        
        $ticket = new Tickets;
        $historico = new HistoricoTicket;

        $ticket->sincronizar($_POST);
        
        // $ticket->sincronizar($_POST);
        $resultado =  $ticket->guardar();
        
        $historico->idTicket = $resultado['id'];
        $historico->comentarios = $ticket->comentariosReporte;
        $historico->idEstado = $ticket->idEstado;
        // debuguear($historico);
        $historico->guardar();

         echo json_encode($resultado);


        
        

    }

}