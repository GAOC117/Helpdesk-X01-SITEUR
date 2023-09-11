<?php

namespace Model;

class Clasificacion extends ActiveRecord {
    protected static $tabla = 'clasificacion_problema';
    protected static $columnasDB = ['id', 'descripcion'];

    public $id;
    public $descripcion;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->descripcion = $args['nombre'] ?? '';
    }


}