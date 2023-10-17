<?php

namespace Model;

class Clasificacion extends ActiveRecord {
    protected static $tabla = 'clasificacion_problema';
    protected static $columnasDB = ['id', 'descripcion','estatus'];

    public $id;
    public $descripcion;
    public $estatus;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->estatus = $args['estatus'] ?? 1;
    }


    public function validarDescripcion(){
        if(!$this->descripcion) {
            self::$alertas['error'][] = 'El campo de clasificación no puede ir vacio';
        }


        return self::$alertas;
    }


}