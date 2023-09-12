<?php


namespace Controllers;

use Classes\Email;
use Model\Clasificacion;
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
        $empReporta = new Empleado;
        $empRequiere = new Empleado;
        $cat = new Clasificacion;
        $sub = new Subclasificacion;
        $deptoReporta = new Departamento;
        $deptoRequiere = new Departamento;
        // $email = new Email();

        $ticket->sincronizar($_POST);

       
        $empleadoReporta = $empReporta->find($ticket->idEmpReporta);
        $empleadoRequiere = $empRequiere->find($ticket->idEmpRequiere);
       
        $clasificacion = $cat->find($ticket->idClasificacionProblema);
        $subClasificacion = $sub->find($ticket->idSubclasificacionProblema);
        $deptartamentoReporta = $deptoReporta->find($empleadoReporta->idDepartamento);
        $deptartamentoRequiere = $deptoRequiere->find($empleadoRequiere->idDepartamento);
        
        

        
        $email = new Email($empleadoReporta->email, $empleadoReporta->nombre." ".$empleadoReporta->apellidoPaterno." ".$empleadoReporta->apellidoMaterno, "");


        
        
        // $ticket->sincronizar($_POST);
        $resultado =  $ticket->guardar();
        
        $historico->idTicket = $resultado['id'];
        $historico->comentarios = $ticket->comentariosReporte;
        $historico->idEstado = $ticket->idEstado;
        // debuguear($historico);
        $historico->crearHistorico();
        
        $email->nuevoTicket($empleadoRequiere->email, $empleadoRequiere->nombre." ".$empleadoRequiere->apellidoPaterno." ".$empleadoRequiere->apellidoMaterno, $resultado['id'], $clasificacion->descripcion,$subClasificacion->descripcion,$ticket->comentariosReporte, $empleadoReporta->extension, $empleadoRequiere->extension,$deptartamentoReporta->descripcion, $deptartamentoRequiere->descripcion);

    

         echo json_encode($resultado);


        
        

    }

}