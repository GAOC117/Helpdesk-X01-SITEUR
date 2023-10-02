<?php

namespace Model;

class Subclasificacion extends ActiveRecord
{
    protected static $tabla = 'subclasificacion_problema';
    protected static $columnasDB = ['id', 'idClasificacion', 'descripcion', 'estatus'];

    public $id;
    public $idClasificacion;
    public $descripcion;
    public $estatus;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->idClasificacion = $args['idClasificacion'] ?? '';
        $this->descripcion = $args['nombre'] ?? '';
        $this->estatus = $args['estatus'] ?? 1;
    }
}
