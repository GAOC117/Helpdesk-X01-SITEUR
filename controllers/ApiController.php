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
        $nombreLogueado = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];
        
        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $query = '';
        // if ($idRol === '1' || $idRol === '2') { //si es mesa de ayuda, aqui el admin si quiere todo el poder
        if ($idRol === '2') { //si es mesa de ayuda
            //si el rol es de administrador o de mesa de ayuda
            // debuguear("primer if");
            
            $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
            // $query .= " CASE e.nombre WHEN '0' THEN 'Sin asignar' ELSE e.nombre END AS nombreAsigna,";
            $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) END AS atiende,";
            $query .= " concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno)  AS nombreRequiere,";
            $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
            $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON t.idEmpAsignado = e2.id ";
            $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
            $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
            $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
            $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
            $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema order by t.id desc";
        // } else if ($idRol === '3') //si es soporte solo asignados a él
        } else if ($idRol ==='1' || $idRol === '3') //si es soporte solo asignados a él , si admin quiere todo el poder, mover para arriba
        {
            
            // debuguear("segundo if");
            $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
            // $query .= " CASE e.nombre WHEN '0' THEN 'Sin asignar' ELSE e.nombre END AS nombreAsigna,";
            $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno)  END AS atiende,";
            $query .= " concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno)  AS nombreRequiere,";
            $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
            $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON t.idEmpAsignado = e2.id ";
            $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
            $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
            $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
            $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
            $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where t.idEmpAsignado = $expedienteLogueado OR t.idEmpRequiere = $expedienteLogueado order by t.id desc";
        } else if ($idRol === '4') { //si es colaborador ver los reportados por el
            // debuguear("tercer if");
            $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
            // $query .= " CASE e.nombre WHEN '0' THEN 'Sin asignar' ELSE e.nombre END AS nombreAsigna,";
            $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno)  END AS atiende,";
            $query .= " concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno)  AS nombreRequiere,";
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
        $resultado['tablaRows'] = $tickets;
        $resultado['idRol'] = $idRol;
        $resultado['nombreLogueado'] = $nombreLogueado;


        echo json_encode($resultado);
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



    public static function obtenerNotificaciones()
    {
        session_start();
        $idRol = $_SESSION['idRol'];
       

        if($idRol==='1'||$idRol==='2' || $idRol==='3')
        {
            $expedienteLogueado = $_SESSION['id'];
        

            if($idRol ==='1'|| $idRol ==='3')
            {
             $query = " SELECT COUNT(*) as cantidad  FROM tickets WHERE idEmpAsignado = $expedienteLogueado AND ticketNuevo = 1 "; //obtener cuantos tickets hay
             
             $cantidad = Tickets::contar($query);
             
            }
            if($idRol==='2'){
                $query = " SELECT COUNT(*) as cantidad FROM tickets WHERE idEmpAsignado = 0 AND ticketNuevo = 1 ";
                $cantidad = Tickets::contar($query);
            }
        }

     
        $resultado['idRol'] = $idRol; //envio el rol para no mostrar el popup con colaboradores
        $resultado['cantidad'] = $cantidad['cantidad'];


        echo json_encode($resultado);


    }


    public static function limpiarNotificaciones(){
        session_start();
        $idRol = $_SESSION['idRol'];
       
        

        if($idRol==='1'||$idRol==='2' || $idRol==='3')
        {
            $expedienteLogueado = $_SESSION['id'];

            if($idRol ==='1'|| $idRol ==='3')
            {
             
             $query = " UPDATE tickets SET ticketNuevo = 0 WHERE idEmpAsignado = $expedienteLogueado AND ticketNuevo = 1"; //
             Tickets::actualizarQuery($query);
            }
            if($idRol==='2'){
                $query = " UPDATE tickets SET ticketNuevo = 0 WHERE idEmpAsignado = 0 AND ticketNuevo = 1"; //
                Tickets::actualizarQuery($query);
            }
            
        }

        $resultado['idRol'] = $idRol; //envio el rol para no mostrar el popup con colaboradores
        

        echo json_encode($resultado);

    }


    public static function getMonthlyTickets(){
        session_start();
        $idRol = $_SESSION['idRol'];
        $expediente = $_SESSION['id'];
        date_default_timezone_set('America/Mexico_City');
        $mesActual = date('m');
        $actualYear = date('Y');
      
        
        

        if($idRol === '2') //si es mesa de ayuda ve todos los tickets del mes
        {
            $query = "SELECT  COUNT(*) as abiertos from tickets where month(fechaCaptura) = $mesActual AND year(fechaCaptura) = $actualYear AND idEstado = 1";
            $resultado['abiertos']  = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as pausados from tickets where month(fechaCaptura) = $mesActual AND year(fechaCaptura) = $actualYear AND idEstado = 2";
            $resultado['pausados'] =  Tickets::contar($query);
            
            $query = "SELECT  COUNT(*) as escalados from tickets where month(fechaCaptura) = $mesActual AND year(fechaCaptura) = $actualYear AND idEstado = 3";
            $resultado['escalados'] =  Tickets::contar($query);

            $query = "SELECT  COUNT(*) as cerrados from tickets where month(fechaCaptura) = $mesActual AND year(fechaCaptura) = $actualYear AND idEstado = 4";
            $resultado['cerrados'] =  Tickets::contar($query);

            $query = "SELECT  COUNT(*) as total from tickets where month(fechaCaptura) = $mesActual AND year(fechaCaptura) = $actualYear";
            $resultado['total'] =  Tickets::contar($query);

        }

        if($idRol === '1' || $idRol === '3') //si es mesa de ayuda ve todos los tickets del mes
        {
            
            $query = "SELECT  COUNT(*) as abiertos from tickets where month(fechaAsignacion) = $mesActual AND year(fechaAsignacion) = $actualYear and idEstado = 1 and idEmpAsignado = $expediente";
            $resultado['abiertos'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as pausados from tickets where month(fechaAsignacion) = $mesActual AND year(fechaAsignacion) = $actualYear and idEstado = 2  and idEmpAsignado = $expediente";
            $resultado['pausados'] = Tickets::contar($query);
            
            $query = "SELECT  COUNT(*) as escalados from tickets where month(fechaAsignacion) = $mesActual AND year(fechaAsignacion) = $actualYear and idEstado = 3  and idEmpAsignado = $expediente";
            $resultado['escalados']  = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as cerrados from tickets where month(fechaAsignacion) = $mesActual AND year(fechaAsignacion) = $actualYear and idEstado = 4  and idEmpAsignado = $expediente";
            $resultado['cerrados'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as total from tickets where month(fechaAsignacion) = $mesActual AND year(fechaAsignacion) = $actualYear and idEmpAsignado = $expediente";
            $resultado['total'] = Tickets::contar($query);

        }

        
        if($idRol === '4') //si es mesa de ayuda ve todos los tickets del mes
        {
            $query = "SELECT  COUNT(*) as abiertos from tickets where month(fechaCaptura) = $mesActual  AND year(fechaCaptura) = $actualYear and idEstado = 1 and idEmpRequiere = $expediente";
            $resultado['abiertos'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as pausados from tickets where month(fechaCaptura) = $mesActual  AND year(fechaCaptura) = $actualYear and idEstado = 2 and idEmpRequiere = $expediente";
            $resultado['pausados'] = Tickets::contar($query);
            
            $query = "SELECT  COUNT(*) as escalados from tickets where month(fechaCaptura) = $mesActual  AND yea(fechaCaptura) = $actualYear and idEstado = 3 and idEmpRequiere = $expediente";
            $resultado['escalados']  = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as cerrados from tickets where month(fechaCaptura) = $mesActual  AND year(fechaCaptura) = $actualYear and idEstado = 4 and idEmpRequiere = $expediente";
            $resultado['cerrados'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as total from tickets where month(fechaCaptura) = $mesActual  AND yea(fechaCaptura) = $actualYear and idEmpRequiere = $expediente";
            $resultado['total'] = Tickets::contar($query);

        }

        
        echo json_encode($resultado);

    }
}

