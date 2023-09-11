<?php


namespace Controllers;


use Model\Departamento;
use Model\Empleado;
use Model\Subclasificacion;

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

}