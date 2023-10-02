<?php

namespace Model;

class Departamento extends ActiveRecord
{
    protected static $tabla = 'departamento';
    protected static $columnasDB = ['id', 'descripcion', 'estatus'];

    public $id;
    public $descripcion;
    public $estatus;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->descripcion = $args['nombre'] ?? '';
        $this->estatus = $args['estatus'] ?? 1;
    }

    // Validar que se digite el departamento
    // public function validarLogin() {
    //     if(!$this->descripcion) {
    //         self::$alertas['error'][] = 'Debe indicar el departamento';
    //     }  
    //     return self::$alertas;

    // }

}
