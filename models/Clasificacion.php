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
        $this->descripcion = $args['nombre'] ?? '';
        $this->estatus = $args['estatus'] ?? 1;
    }


}