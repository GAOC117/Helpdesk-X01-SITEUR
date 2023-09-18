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

class ApiController
{

    public static function obtenerEmpleado(){

        session_start();
        $expediente = $_GET['idEmp'];
        $empleado = Empleado::find($expediente);
       

        echo json_encode($empleado);
    }

    public static function obtenerEmpleadoRol(){

        session_start();
        $expediente = $_SESSION['id'];
        $empleado = Empleado::find($expediente);
     
        

        echo json_encode($empleado);
    }


    public static function verTickets(){
         session_start();
        $idRol = $_SESSION['idRol'];
        $nombre = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $query = '';
        if ($idRol === '1' || $idRol === '2') { //si es mesa de ayuda
            //si el rol es de administrador o de mesa de ayuda
            // debuguear("primer if");
            
            $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
            $query .= " CASE e.nombre WHEN '0' THEN 'Sin asignar' ELSE e.nombre END AS nombreAsigna,";
            $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE e2.nombre END AS atiende,";
            $query .= " e4.nombre AS nombreRequiere,";
            $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
            $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON t.idEmpAsignado = e2.id ";
            $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
            $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
            $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
            $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
            $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema order by t.id desc";
        } else if ($idRol === '3') //si es soporte solo asignados a él
        {
            // debuguear("segundo if");
            $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
            $query .= " CASE e.nombre WHEN '0' THEN 'Sin asignar' ELSE e.nombre END AS nombreAsigna,";
            $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE e2.nombre END AS atiende,";
            $query .= " e4.nombre AS nombreRequiere,";
            $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
            $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON t.idEmpAsignado = e2.id ";
            $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
            $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
            $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
            $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
            $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where t.idEmpAsignado = $expedienteLogueado order by t.id desc";
        } else if ($idRol === '4') { //si es colaborador ver los reportados por el
            // debuguear("tercer if");
            $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
            $query .= " CASE e.nombre WHEN '0' THEN 'Sin asignar' ELSE e.nombre END AS nombreAsigna,";
            $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE e2.nombre END AS atiende,";
            $query .= " e4.nombre AS nombreRequiere,";
            $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
            $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON t.idEmpAsignado = e2.id ";
            $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
            $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
            $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
            $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
            $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where t.idEmpRequiere = $expedienteLogueado order by t.id desc";
        }



        //si el perfil es de colaborador ver solo los registrados por él
        $tickets = VerTickets::SQL($query);


        //  debuguear($tickets);



        echo json_encode($tickets);
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
        date_default_timezone_set('America/Mexico_City');
        $ticket->fechaCaptura = date('Y-m-d');
        
        

       

       
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
        date_default_timezone_set('America/Mexico_City');
        $historico->fechaRegistro =  date('Y-m-d');
        // debuguear($historico);
        $historico->crearHistorico();
        
        $email->nuevoTicket($empleadoRequiere->email, $empleadoRequiere->nombre." ".$empleadoRequiere->apellidoPaterno." ".$empleadoRequiere->apellidoMaterno, $resultado['id'], $clasificacion->descripcion,$subClasificacion->descripcion,$ticket->comentariosReporte, $empleadoReporta->extension, $empleadoRequiere->extension,$deptartamentoReporta->descripcion, $deptartamentoRequiere->descripcion);

    

         echo json_encode($resultado);


        
        

    }

}