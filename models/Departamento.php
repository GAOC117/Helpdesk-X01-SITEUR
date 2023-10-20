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
        $this->id = $args['id'] ?? null;
        $this->descripcion = $args['nombre'] ?? '';
        $this->estatus = $args['estatus'] ?? 1;
    }

    public function validarDescripcion(){
        if(!$this->descripcion) {
            self::$alertas['error'][] = 'El campo de departamento no puede ir vacio';
        }


        return self::$alertas;
    }

}
