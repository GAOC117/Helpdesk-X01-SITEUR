<?php

namespace Model;

class Departamento extends ActiveRecord {
    protected static $tabla = 'departamento';
    protected static $columnasDB = ['id', 'descripcion'];

    public $id;
    public $descripcion;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->descripcion = $args['nombre'] ?? '';
    }

    // Validar que se digite el departamento
    // public function validarLogin() {
    //     if(!$this->descripcion) {
    //         self::$alertas['error'][] = 'Debe indicar el departamento';
    //     }  
    //     return self::$alertas;

    // }

}