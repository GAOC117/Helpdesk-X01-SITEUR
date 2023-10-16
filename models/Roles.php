<?php

namespace Model;

class Roles extends ActiveRecord {
    protected static $tabla = 'roles';
    protected static $columnasDB = ['id', 'descripcion'];

    public $id;
    public $descripcion;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
       
    }


}