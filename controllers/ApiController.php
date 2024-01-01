<?php


namespace Controllers;

use Classes\Email;
use Classes\Paginacion;
use Model\Clasificacion;
use Model\Departamento;
use Model\Empleado;
use Model\HistoricoTicket;
use Model\InfoTicket;
use Model\Subclasificacion;
use Model\Tickets;
use Model\VerTickets;

class ApiController
{

    public static function obtenerEmpleado()
    {

        session_start();
        $expediente = $_GET['idEmp'];
        $empleado = Empleado::find($expediente);


        echo json_encode($empleado);
    }

    public static function obtenerEmpleadoRol()
    {

        session_start();
        $expediente = $_SESSION['id'];
        $empleado = Empleado::find($expediente);



        echo json_encode($empleado);
    }


    public static function verTickets()
    {
        session_start();
        $idRol = $_SESSION['idRol'];
        $nombreLogueado = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];

        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $query = '';

        $rangoCheck = filter_var($_GET['rangoChecked'], FILTER_VALIDATE_BOOLEAN);

        // if(!$rangoCheck)
        // debuguear("no checado entre");
        // else
        // debuguear("si checado entre");

        $desde = $_GET['fechaDesde'];
        $hasta = $_GET['fechaHasta'];

        $pagina_actual = $_GET['page'];
        $folio = $_GET['folio'];
        $fecha = $_GET['fecha'];
        $atiende = $_GET['atiende'];
        $requiere = $_GET['requiere'];
        $estado = $_GET['estado'];
        $clasificacion = $_GET['clasificacion'];
        $subclasificacion = $_GET['subclasificacion'];
        $servicio = $_GET['servicio'];



        // debuguear($_GET);
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            $pagina_actual = 1;
        }

        $registros_por_pagina = 10;


        // if ($idRol === '1' || $idRol === '2') { //si es mesa de ayuda, aqui el admin si quiere todo el poder
        if ($idRol === '2') { //si es mesa de ayuda
            //si el rol es de administrador o de mesa de ayuda
            // debuguear("primer if");
            // $query_total_registros = "SELECT COUNT(*) as cantidad  FROM tickets where id like '%$folio%'";

            if (!$rangoCheck) {



                $query_total_registros = "SELECT COUNT(*) as cantidad FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado   AS e2 ON e2.id = t.idEmpAsignado ";
                $query_total_registros .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query_total_registros .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query_total_registros .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query_total_registros .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query_total_registros .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema WHERE t.id like '%$folio%' ";
                $query_total_registros .= " AND t.fechaCaptura like '%$fecha%'and concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query_total_registros .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query_total_registros .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%'";
            } else {
                $query_total_registros = "SELECT COUNT(*) as cantidad FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado   AS e2 ON e2.id = t.idEmpAsignado ";
                $query_total_registros .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query_total_registros .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query_total_registros .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query_total_registros .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query_total_registros .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema WHERE t.id like '%$folio%' ";
                $query_total_registros .= " AND concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query_total_registros .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query_total_registros .= " AND  sp.descripcion like '%$subclasificacion%'AND t.tipoServicio like '%$servicio%' AND t.fechaCaptura BETWEEN '$desde' AND '$hasta' ";
            }


            // $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura where id like '%$folio%'";

            // } else if ($idRol === '3') //si es soporte solo asignados a él
        } else if ($idRol === '1' || $idRol === '3') //si es soporte solo asignados a él , si admin quiere todo el poder, mover para arriba
        {

            // debuguear("segundo if");


            if (!$rangoCheck) {

                $query_total_registros = "SELECT COUNT(*) as cantidad FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query_total_registros .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query_total_registros .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query_total_registros .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query_total_registros .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query_total_registros .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  WHERE (t.idEmpAsignado = $expedienteLogueado OR t.idEmpRequiere = $expedienteLogueado) and t.id like '%$folio%' ";
                $query_total_registros .= " AND t.fechaCaptura like '%$fecha%'and concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query_total_registros .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query_total_registros .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%'";
            } else {
                $query_total_registros = "SELECT COUNT(*) as cantidad FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query_total_registros .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query_total_registros .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query_total_registros .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query_total_registros .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query_total_registros .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  WHERE (t.idEmpAsignado = $expedienteLogueado OR t.idEmpRequiere = $expedienteLogueado) and t.id like '%$folio%' ";
                $query_total_registros .= " AND concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query_total_registros .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query_total_registros .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%' AND t.fechaCaptura BETWEEN '$desde' AND '$hasta' ";
            }
        } else if ($idRol === '4') { //si es colaborador ver los reportados por el
            // debuguear("tercer if");

            if (!$rangoCheck) {


                $query_total_registros = "SELECT COUNT(*) as cantidad FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query_total_registros .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query_total_registros .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query_total_registros .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query_total_registros .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query_total_registros .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where t.idEmpRequiere = $expedienteLogueado and t.id like '%$folio%' ";
                $query_total_registros .= " AND t.fechaCaptura like '%$fecha%'and concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query_total_registros .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query_total_registros .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%'";
                
            } else {
                
                $query_total_registros = "SELECT COUNT(*) as cantidad FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query_total_registros .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query_total_registros .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query_total_registros .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query_total_registros .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query_total_registros .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where t.idEmpRequiere = $expedienteLogueado and t.id like '%$folio%' ";
                $query_total_registros .= " AND concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query_total_registros .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query_total_registros .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%' AND t.fechaCaptura BETWEEN '$desde' AND '$hasta' ";
                
                
            }
        }

        

        $total_registros = VerTickets::contar($query_total_registros);



        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros['cantidad']);
        $offset = $paginacion->offset();

        $pagina_siguiente = $paginacion->pagina_siguiente();
        $pagina_anterior = $paginacion->pagina_anterior();
        $total_paginas = $paginacion->total_paginas();



        // if ($idRol === '1' || $idRol === '2') { //si es mesa de ayuda, aqui el admin si quiere todo el poder
        if ($idRol === '2') { //si es mesa de ayuda
            //si el rol es de administrador o de mesa de ayuda
            // debuguear("primer if");
            // $query_total_registros = "SELECT COUNT(*) as cantidad  FROM tickets";
            if (!$rangoCheck) {


                $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
                // $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) END AS atiende,";
                $query .= " concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) AS atiende,";
                $query .= " concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno)  AS nombreRequiere,";
                $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
                $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte, t.tipoServicio AS tipoServicio FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema WHERE t.id like '%$folio%' ";
                $query .= " AND t.fechaCaptura like '%$fecha%'and concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%' order by t.id desc LIMIT $registros_por_pagina OFFSET $offset";

                    
                
            } else {
                $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
                // $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) END AS atiende,";
                $query .= " concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno)  AS atiende,";
                $query .= " concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno)  AS nombreRequiere,";
                $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
                $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte, t.tipoServicio AS tipoServicio FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema WHERE t.id like '%$folio%' ";
                $query .= " AND concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%' AND t.fechaCaptura BETWEEN '$desde' AND '$hasta'  order by t.id desc LIMIT $registros_por_pagina OFFSET $offset";
                
                
                // debuguear($query);
            }
            // } else if ($idRol === '3') //si es soporte solo asignados a él
        } else if ($idRol === '1' || $idRol === '3') //si es soporte solo asignados a él , si admin quiere todo el poder, mover para arriba
        {

            if (!$rangoCheck) {
                // debuguear("segundo if");


                // $query_total_registros = "SELECT COUNT(*) as cantidad  FROM tickets where idEmpAsignado = $expedienteLogueado OR idEmpRequiere = $expedienteLogueado";
                $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
                // $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno)  END AS atiende,";
                $query .= " concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno)  AS atiende,";
                $query .= " concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno)  AS nombreRequiere,";
                $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
                $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte, t.tipoServicio AS tipoServicio FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where (t.idEmpAsignado = $expedienteLogueado OR t.idEmpRequiere = $expedienteLogueado) and t.id like '%$folio%' ";
                $query .= " AND t.fechaCaptura like '%$fecha%'and concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%' order by t.id desc LIMIT $registros_por_pagina OFFSET $offset";
            } else {
                $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
                // $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno)  END AS atiende,";
                $query .= " concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) AS atiende,";
                $query .= " concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno)  AS nombreRequiere,";
                $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
                $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte, t.tipoServicio AS tipoServicio FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where (t.idEmpAsignado = $expedienteLogueado OR t.idEmpRequiere = $expedienteLogueado) and t.id like '%$folio%' ";
                $query .= " AND concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%' AND t.fechaCaptura BETWEEN '$desde' AND '$hasta' order by t.id desc LIMIT $registros_por_pagina OFFSET $offset";
            }

            // debuguear($query);
        } else if ($idRol === '4') { //si es colaborador ver los reportados por el
            // debuguear("tercer if");
            if (!$rangoCheck) {

                // $query_total_registros = "SELECT COUNT(*) as cantidad  FROM tickets where idEmpRequiere = $expedienteLogueado";
                $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
                // $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno)  END AS atiende,";
                $query .= " concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno)  AS atiende,";
                $query .= " concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno)  AS nombreRequiere,";
                $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
                $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte, t.tipoServicio AS tipoServicio FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where t.idEmpRequiere = $expedienteLogueado and t.id like '%$folio%' ";
                $query .= " AND t.fechaCaptura like '%$fecha%'and concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%' order by t.id desc LIMIT $registros_por_pagina OFFSET $offset";
            } else {
                $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
                // $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno)  END AS atiende,";
                $query .= " concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) AS atiende,";
                $query .= " concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno)  AS nombreRequiere,";
                $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
                $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte, t.tipoServicio AS tipoServicio FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where t.idEmpRequiere = $expedienteLogueado and t.id like '%$folio%' ";
                $query .= " AND  concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%' AND t.fechaCaptura BETWEEN '$desde' AND '$hasta' order by t.id desc LIMIT $registros_por_pagina OFFSET $offset";
            }
        }


        // $html_siguiente = $paginacion->enlace_siguiente();
        // debuguear($query);
        //si el perfil es de colaborador ver solo los registrados por él
        $tickets = VerTickets::SQL($query);

        // debuguear($tickets);


        $resultado['tablaRows'] = $tickets;
        $resultado['idRol'] = $idRol;
        $resultado['nombreLogueado'] = $nombreLogueado;
        $resultado['pagina_siguiente'] = $pagina_siguiente;
        $resultado['pagina_anterior'] = $pagina_anterior;
        $resultado['total_registros'] = $total_registros['cantidad'];
        $resultado['total_paginas'] = $total_paginas;
        $resultado['expediente_logueado'] = $expedienteLogueado;



        echo json_encode($resultado);
    }





    public static function exportarExcel()
    {
        session_start();
        $idRol = $_SESSION['idRol'];
        $nombreLogueado = $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno'];

        $expedienteLogueado = $_SESSION['id'];
        $extension = $_SESSION['extension'];
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $query = '';

        $rangoCheck = filter_var($_GET['rangoChecked'], FILTER_VALIDATE_BOOLEAN);



        $desde = $_GET['fechaDesde'];
        $hasta = $_GET['fechaHasta'];
        $folio = $_GET['folio'];
        $fecha = $_GET['fecha'];
        $atiende = $_GET['atiende'];
        $requiere = $_GET['requiere'];
        $estado = $_GET['estado'];
        $clasificacion = $_GET['clasificacion'];
        $subclasificacion = $_GET['subclasificacion'];
        $servicio = $_GET['servicio'];








        // if ($idRol === '1' || $idRol === '2') { //si es mesa de ayuda, aqui el admin si quiere todo el poder
        if ($idRol === '2') { //si es mesa de ayuda
            //si el rol es de administrador o de mesa de ayuda
            // debuguear("primer if");
            // $query_total_registros = "SELECT COUNT(*) as cantidad  FROM tickets";
            if (!$rangoCheck) {


                $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
                // $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) END AS atiende,";
                $query .= " concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) AS atiende,";
                $query .= " concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno)  AS nombreRequiere,";
                $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
                $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte, t.tipoServicio AS tipoServicio FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema WHERE t.id like '%$folio%' ";
                $query .= " AND t.fechaCaptura like '%$fecha%'and concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%' order by t.id desc ";
            } else {
                $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
                // $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) END AS atiende,";
                $query .= " concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) AS atiende,";
                $query .= " concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno)  AS nombreRequiere,";
                $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
                $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte, t.tipoServicio AS tipoServicio FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema WHERE t.id like '%$folio%' ";
                $query .= " AND concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%' AND t.fechaCaptura BETWEEN '$desde' AND '$hasta'  order by t.id desc ";

                // debuguear($query);
            }
            // } else if ($idRol === '3') //si es soporte solo asignados a él
        } else if ($idRol === '1' || $idRol === '3') //si es soporte solo asignados a él , si admin quiere todo el poder, mover para arriba
        {

            if (!$rangoCheck) {
                // debuguear("segundo if");


                // $query_total_registros = "SELECT COUNT(*) as cantidad  FROM tickets where idEmpAsignado = $expedienteLogueado OR idEmpRequiere = $expedienteLogueado";
                $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
                // $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno)  END AS atiende,";
                $query .= " concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) AS atiende,";
                $query .= " concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno)  AS nombreRequiere,";
                $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
                $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte, t.tipoServicio AS tipoServicio FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where (t.idEmpAsignado = $expedienteLogueado OR t.idEmpRequiere = $expedienteLogueado) and t.id like '%$folio%' ";
                $query .= " AND t.fechaCaptura like '%$fecha%'and concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%' order by t.id desc ";
            } else {
                $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
                // $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno)  END AS atiende,";
                $query .= " concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) AS atiende,";
                $query .= " concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno)  AS nombreRequiere,";
                $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
                $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte, t.tipoServicio AS tipoServicio FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where (t.idEmpAsignado = $expedienteLogueado OR t.idEmpRequiere = $expedienteLogueado) and t.id like '%$folio%' ";
                $query .= " AND concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%' AND t.fechaCaptura BETWEEN '$desde' AND '$hasta' order by t.id desc ";
            }

            // debuguear($query);
        } else if ($idRol === '4') { //si es colaborador ver los reportados por el
            // debuguear("tercer if");
            if (!$rangoCheck) {

                // $query_total_registros = "SELECT COUNT(*) as cantidad  FROM tickets where idEmpRequiere = $expedienteLogueado";
                $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
                // $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno)  END AS atiende,";
                $query .= " concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno)  AS atiende,";
                $query .= " concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno)  AS nombreRequiere,";
                $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
                $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte, t.tipoServicio AS tipoServicio FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where t.idEmpRequiere = $expedienteLogueado and t.id like '%$folio%' ";
                $query .= " AND t.fechaCaptura like '%$fecha%'and concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%' order by t.id desc ";
            } else {
                $query = "SELECT t.id as idTicket, t.fechaCaptura as fechaCaptura,";
                // $query .= " CASE e2.nombre WHEN '0' THEN 'Sin asignar' ELSE concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno)  END AS atiende,";
                $query .= " concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) AS atiende,";
                $query .= " concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno)  AS nombreRequiere,";
                $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte AS comentarios,";
                $query .= " CASE t.comentariosSoporte WHEN '' THEN 'Sin comentarios' ELSE t.comentariosSoporte END AS comentariosSoporte, t.tipoServicio AS tipoServicio FROM tickets AS t LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna LEFT OUTER JOIN empleado AS e2 ON e2.id = t.idEmpAsignado ";
                $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta ";
                $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
                $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
                $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema  ";
                $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema  where t.idEmpRequiere = $expedienteLogueado and t.id like '%$folio%' ";
                $query .= " AND  concat(e2.nombre,' ', e2.apellidoPaterno,' ', e2.apellidoMaterno) like '%$atiende%' ";
                $query .= " AND concat(e4.nombre,' ', e4.apellidoPaterno,' ', e4.apellidoMaterno) like '%$requiere%' and e5.descripcion like '%$estado%' and  cp.descripcion like '%$clasificacion%'  ";
                $query .= " AND  sp.descripcion like '%$subclasificacion%' AND t.tipoServicio like '%$servicio%' AND t.fechaCaptura BETWEEN '$desde' AND '$hasta' order by t.id desc ";
            }
        }


        // $html_siguiente = $paginacion->enlace_siguiente();
        // debuguear($query);
        //si el perfil es de colaborador ver solo los registrados por él
        $tickets = VerTickets::SQL($query);

        // debuguear($tickets);


        $resultado['tablaRows'] = $tickets;
        $resultado['idRol'] = $idRol;
        $resultado['nombreLogueado'] = $nombreLogueado;




        echo json_encode($resultado);
    }



    public static function obtenerSubclasificacion()
    {
        $clasificacion = $_GET['idClasificacion'];


        $subclasificacion = Subclasificacion::allWhere('idClasificacion', $clasificacion, 'id asc');
        // debuguear($subclasificacion);

        echo json_encode($subclasificacion);
    }


    public static function generarTicket()
    {

        session_start();

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
        if ($_SESSION['idRol'] === '2') //mesa
            $ticket->ticketNuevo = 0;


        date_default_timezone_set('America/Mexico_City');
        $ticket->fechaCaptura = date('Y-m-d');






        $empleadoReporta = $empReporta->find($ticket->idEmpReporta);
        $empleadoRequiere = $empRequiere->find($ticket->idEmpRequiere);

        $clasificacion = $cat->find($ticket->idClasificacionProblema);
        $subClasificacion = $sub->find($ticket->idSubclasificacionProblema);
        $deptartamentoReporta = $deptoReporta->find($empleadoReporta->idDepartamento);
        $deptartamentoRequiere = $deptoRequiere->find($empleadoRequiere->idDepartamento);




        $email = new Email($empleadoReporta->email, $empleadoReporta->nombre . " " . $empleadoReporta->apellidoPaterno . " " . $empleadoReporta->apellidoMaterno, "");




        // $ticket->sincronizar($_POST);
        $resultado =  $ticket->guardar();

        $historico->idTicket = $resultado['id'];
        $historico->comentarios = $ticket->comentariosReporte;
        $historico->idEstado = $ticket->idEstado;
        date_default_timezone_set('America/Mexico_City');
        $historico->fechaRegistro =  date('Y-m-d');
        // debuguear($historico);
        $historico->crearHistorico();

        $email->nuevoTicket($empleadoRequiere->email, $empleadoRequiere->nombre . " " . $empleadoRequiere->apellidoPaterno . " " . $empleadoRequiere->apellidoMaterno, $resultado['id'], $clasificacion->descripcion, $subClasificacion->descripcion, $ticket->comentariosReporte, $empleadoReporta->extension, $empleadoRequiere->extension, $deptartamentoReporta->descripcion, $deptartamentoRequiere->descripcion);



        echo json_encode($resultado);
    }



    public static function obtenerNotificaciones()
    {
        session_start();
        $idRol = $_SESSION['idRol'];


        if ($idRol === '1' || $idRol === '2' || $idRol === '3') {
            $expedienteLogueado = $_SESSION['id'];


            if ($idRol === '1' || $idRol === '3') {
                $query = " SELECT COUNT(*) as cantidad  FROM tickets WHERE idEmpAsignado = $expedienteLogueado AND ticketNuevo = 1 "; //obtener cuantos tickets hay

                $cantidad = Tickets::contar($query);
            }
            if ($idRol === '2') {
                $query = " SELECT COUNT(*) as cantidad FROM tickets WHERE idEmpAsignado = 0 AND ticketNuevo = 1 ";
                $cantidad = Tickets::contar($query);
            }
        }


        $resultado['idRol'] = $idRol; //envio el rol para no mostrar el popup con colaboradores
        $resultado['cantidad'] = $cantidad['cantidad'];


        echo json_encode($resultado);
    }


    public static function limpiarNotificaciones()
    {
        session_start();
        $idRol = $_SESSION['idRol'];



        if ($idRol === '1' || $idRol === '2' || $idRol === '3') {
            $expedienteLogueado = $_SESSION['id'];

            if ($idRol === '1' || $idRol === '3') {

                $query = " UPDATE tickets SET ticketNuevo = 0 WHERE idEmpAsignado = $expedienteLogueado AND ticketNuevo = 1"; //
                Tickets::actualizarQuery($query);
            }
            if ($idRol === '2') {
                $query = " UPDATE tickets SET ticketNuevo = 0 WHERE idEmpAsignado = 0 AND ticketNuevo = 1"; //
                Tickets::actualizarQuery($query);
            }
        }

        $resultado['idRol'] = $idRol; //envio el rol para no mostrar el popup con colaboradores


        echo json_encode($resultado);
    }


    public static function getMonthlyTickets()
    {
        session_start();
        $idRol = $_SESSION['idRol'];
        $expediente = $_SESSION['id'];
        date_default_timezone_set('America/Mexico_City');
        $mesActual = date('m');
        $actualYear = date('Y');
        $resultado = [];
        

        if ($mesActual === '01') {

            $mesAnterior = 12;
            $mesDobleAnterior = 11;
            $lastYear = $actualYear - 1;
          } else if ($mesActual == '02') {
      
            $mesAnterior = '01';
            $mesDobleAnterior = '12';
            $lastYear = $actualYear - 1;
          }
          else {
            $mesAnterior = $mesActual - 1;
            $mesDobleAnterior = $mesActual - 2;
            $lastYear = $actualYear;
          }

// debuguear($mesActual.' '.$mesAnterior.' '.$mesDobleAnterior.' '.$actualYear.' '.$lastYear);


        if ($idRol === '2') //si es mesa de ayuda ve todos los tickets del mes
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

            ///un mes anterior
            $query = "SELECT  COUNT(*) as abiertos1 from tickets where month(fechaCaptura) = $mesAnterior AND year(fechaCaptura) = $lastYear AND idEstado = 1";
            $resultado['abiertos1']  = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as pausados1 from tickets where month(fechaCaptura) = $mesAnterior AND year(fechaCaptura) = $lastYear AND idEstado = 2";
            $resultado['pausados1'] =  Tickets::contar($query);

            $query = "SELECT  COUNT(*) as escalados1 from tickets where month(fechaCaptura) = $mesAnterior AND year(fechaCaptura) = $lastYear AND idEstado = 3";
            $resultado['escalados1'] =  Tickets::contar($query);

            $query = "SELECT  COUNT(*) as cerrados1 from tickets where month(fechaCaptura) = $mesAnterior AND year(fechaCaptura) = $lastYear AND idEstado = 4";
            $resultado['cerrados1'] =  Tickets::contar($query);

            $query = "SELECT  COUNT(*) as total1 from tickets where month(fechaCaptura) = $mesAnterior AND year(fechaCaptura) = $lastYear";
            $resultado['total1'] =  Tickets::contar($query);

            //dos meses atras
            $query = "SELECT  COUNT(*) as abiertos2 from tickets where month(fechaCaptura) = $mesDobleAnterior AND year(fechaCaptura) = $lastYear AND idEstado = 1";
            $resultado['abiertos2']  = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as pausados2 from tickets where month(fechaCaptura) = $mesDobleAnterior AND year(fechaCaptura) = $lastYear AND idEstado = 2";
            $resultado['pausados2'] =  Tickets::contar($query);

            $query = "SELECT  COUNT(*) as escalados2 from tickets where month(fechaCaptura) = $mesDobleAnterior AND year(fechaCaptura) = $lastYear AND idEstado = 3";
            $resultado['escalados2'] =  Tickets::contar($query);

            $query = "SELECT  COUNT(*) as cerrados2 from tickets where month(fechaCaptura) = $mesDobleAnterior AND year(fechaCaptura) = $lastYear AND idEstado = 4";
            $resultado['cerrados2'] =  Tickets::contar($query);

            $query = "SELECT  COUNT(*) as total2 from tickets where month(fechaCaptura) = $mesDobleAnterior AND year(fechaCaptura) = $lastYear";
            $resultado['total2'] =  Tickets::contar($query);
        }

        if ($idRol === '1' || $idRol === '3') //si es mesa de ayuda ve todos los tickets del mes
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
            // debuguear($query);

            //un mes atras
            $query = "SELECT  COUNT(*) as abiertos1 from tickets where month(fechaAsignacion) = $mesAnterior AND year(fechaAsignacion) = $lastYear and idEstado = 1 and idEmpAsignado = $expediente";
            $resultado['abiertos1'] = Tickets::contar($query);


            $query = "SELECT  COUNT(*) as pausados1 from tickets where month(fechaAsignacion) = $mesAnterior AND year(fechaAsignacion) = $lastYear and idEstado = 2  and idEmpAsignado = $expediente";
            $resultado['pausados1'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as escalados1 from tickets where month(fechaAsignacion) = $mesAnterior AND year(fechaAsignacion) = $lastYear and idEstado = 3  and idEmpAsignado = $expediente";
            $resultado['escalados1']  = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as cerrados1 from tickets where month(fechaAsignacion) = $mesAnterior AND year(fechaAsignacion) = $lastYear and idEstado = 4  and idEmpAsignado = $expediente";
            $resultado['cerrados1'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as total1 from tickets where month(fechaAsignacion) = $mesAnterior AND year(fechaAsignacion) = $lastYear and idEmpAsignado = $expediente";
            $resultado['total1'] = Tickets::contar($query);

            //dos meses atras

            $query = "SELECT  COUNT(*) as abiertos2 from tickets where month(fechaAsignacion) = $mesDobleAnterior AND year(fechaAsignacion) = $lastYear and idEstado = 1 and idEmpAsignado = $expediente";
            $resultado['abiertos2'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as pausados2 from tickets where month(fechaAsignacion) = $mesDobleAnterior AND year(fechaAsignacion) = $lastYear and idEstado = 2  and idEmpAsignado = $expediente";
            $resultado['pausados2'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as escalados2 from tickets where month(fechaAsignacion) = $mesDobleAnterior AND year(fechaAsignacion) = $lastYear and idEstado = 3  and idEmpAsignado = $expediente";
            $resultado['escalados2']  = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as cerrados2 from tickets where month(fechaAsignacion) = $mesDobleAnterior AND year(fechaAsignacion) = $lastYear and idEstado = 4  and idEmpAsignado = $expediente";
            $resultado['cerrados2'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as total2 from tickets where month(fechaAsignacion) = $mesDobleAnterior AND year(fechaAsignacion) = $lastYear and idEmpAsignado = $expediente";
            $resultado['total2'] = Tickets::contar($query);
        }


        if ($idRol === '4') //si es mesa de ayuda ve todos los tickets del mes
        {
            $query = "SELECT  COUNT(*) as abiertos from tickets where month(fechaCaptura) = $mesActual  AND year(fechaCaptura) = $actualYear and idEstado = 1 and idEmpRequiere = $expediente";
            $resultado['abiertos'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as pausados from tickets where month(fechaCaptura) = $mesActual  AND year(fechaCaptura) = $actualYear and idEstado = 2 and idEmpRequiere = $expediente";
            $resultado['pausados'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as escalados from tickets where month(fechaCaptura) = $mesActual  AND year(fechaCaptura) = $actualYear and idEstado = 3 and idEmpRequiere = $expediente";
            $resultado['escalados']  = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as cerrados from tickets where month(fechaCaptura) = $mesActual  AND year(fechaCaptura) = $actualYear and idEstado = 4 and idEmpRequiere = $expediente";
            $resultado['cerrados'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as total from tickets where month(fechaCaptura) = $mesActual  AND year(fechaCaptura) = $actualYear and idEmpRequiere = $expediente";
            $resultado['total'] = Tickets::contar($query);

            //un mes atras
            $query = "SELECT  COUNT(*) as abiertos1 from tickets where month(fechaCaptura) = $mesAnterior  AND year(fechaCaptura) = $lastYear and idEstado = 1 and idEmpRequiere = $expediente";
            $resultado['abiertos1'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as pausados1 from tickets where month(fechaCaptura) = $mesAnterior  AND year(fechaCaptura) = $lastYear and idEstado = 2 and idEmpRequiere = $expediente";
            $resultado['pausados1'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as escalados1 from tickets where month(fechaCaptura) = $mesAnterior  AND year(fechaCaptura) = $lastYear and idEstado = 3 and idEmpRequiere = $expediente";
            $resultado['escalados1']  = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as cerrados1 from tickets where month(fechaCaptura) = $mesAnterior  AND year(fechaCaptura) = $lastYear and idEstado = 4 and idEmpRequiere = $expediente";
            $resultado['cerrados1'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as total1 from tickets where month(fechaCaptura) = $mesAnterior  AND year(fechaCaptura) = $lastYear and idEmpRequiere = $expediente";
            $resultado['total1'] = Tickets::contar($query);

            //dos meses atras
            $query = "SELECT  COUNT(*) as abiertos2 from tickets where month(fechaCaptura) = $mesDobleAnterior  AND year(fechaCaptura) = $lastYear and idEstado = 1 and idEmpRequiere = $expediente";
            $resultado['abiertos2'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as pausados2 from tickets where month(fechaCaptura) = $mesDobleAnterior  AND year(fechaCaptura) = $lastYear and idEstado = 2 and idEmpRequiere = $expediente";
            $resultado['pausados2'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as escalados2 from tickets where month(fechaCaptura) = $mesDobleAnterior  AND year(fechaCaptura) = $lastYear and idEstado = 3 and idEmpRequiere = $expediente";
            $resultado['escalados2']  = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as cerrados2 from tickets where month(fechaCaptura) = $mesDobleAnterior  AND year(fechaCaptura) = $lastYear and idEstado = 4 and idEmpRequiere = $expediente";
            $resultado['cerrados2'] = Tickets::contar($query);

            $query = "SELECT  COUNT(*) as total2 from tickets where month(fechaCaptura) = $mesDobleAnterior  AND year(fechaCaptura) = $lastYear and idEmpRequiere = $expediente";
            $resultado['total2'] = Tickets::contar($query);
        }

        $resultado['mesActual'] = $mesActual;
        debuguear($resultado);
        
        echo json_encode($resultado);
    }


    public static function modal()
    {

        $folioModal = $_GET['folio'];

        $query = "SELECT t.id as idTicket,";
        $query .= " e4.id AS expRequiere, concat(e4.nombre,' ',e4.apellidoPaterno,' ',e4.apellidoMaterno) AS nombreRequiere, d.descripcion as departamento, e4.extension , e4.email, ";
        $query .= " e5.descripcion AS estadoTicket, cp.descripcion AS clasificacion , sp.descripcion AS subclasificacion ,t.comentariosReporte, t.comentariosSoporte, t.tipoServicio,";
        // $query .= " CASE e2.nombre WHEN '0' THEN 'Aun sin asignar' ELSE concat(e2.nombre,' ',e2.apellidoPaterno,' ',e2.apellidoMaterno) END AS atiende";
        $query .= " e2.id AS expAtiende, concat(e2.nombre,' ',e2.apellidoPaterno,' ',e2.apellidoMaterno) AS atiende";
        $query .= " FROM tickets AS t";
        $query .= " LEFT OUTER JOIN empleado AS e ON e.id = t.idEmpAsigna ";
        $query .= " LEFT OUTER JOIN empleado AS e2 ON t.idEmpAsignado = e2.id";
        $query .= " LEFT OUTER JOIN empleado AS e3 ON e3.id = t.idEmpReporta";
        $query .= " LEFT OUTER JOIN empleado AS e4 ON e4.id  = t.idEmpRequiere";
        $query .= " LEFT OUTER JOIN estados AS e5 ON e5.id = t.idEstado";
        $query .= " LEFT OUTER JOIN departamento AS d on d.id = e4.idDepartamento";
        $query .= " LEFT OUTER JOIN clasificacion_problema AS cp ON cp.id = t.idClasificacionProblema ";
        $query .= " LEFT OUTER JOIN subclasificacion_problema AS sp ON sp.id = t.idSubclasificacionProblema WHERE t.id=$folioModal";


        $tickets = InfoTicket::SQL($query);
        $resultado['infoTicket'] = $tickets[0];
        // debuguear($tickets[0]);





        echo json_encode($resultado);
    }
}
