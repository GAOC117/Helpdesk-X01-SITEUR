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
        $this->id = $args['id'] ?? null;
        $this->idClasificacion = $args['idClasificacion'] ?? '';
        $this->descripcion = $args['nombre'] ?? '';
        $this->estatus = $args['estatus'] ?? 1;
    }

    public function validarDescripcion(){
        if(!$this->descripcion) {
            self::$alertas['error'][] = 'El campo de subclasificación no puede ir vacio';
        }

        return self::$alertas;
    }
}
