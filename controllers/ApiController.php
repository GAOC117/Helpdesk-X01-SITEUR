<?php


namespace Controllers;


use Model\Departamento;

class ApiController
{

    public static function index(){
        
        // $departamentos = Departamento::allOrderBy('descripcion');
        $departamentos = Departamento::allOrderBy('id');

        echo json_encode($departamentos);
    }

}