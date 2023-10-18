<?php

namespace Model;

class VerSubclasificaciones extends ActiveRecord
{
    protected static $tabla = 'subclasificacion_problema';
    protected static $columnasDB = [
        'id', 'idClasificacion','clasificacion','subclasificacion', 'estatus'];



    public $id;
    public $idClasificacion;
    public $clasificacion;
    public $subclasificacion;
    public $estatus;
  
   


    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? null;       
        $this->idClasificacion= $args['idClasificacion'] ?? '';
        $this->clasificacion = $args['clasificacion'] ?? '';
        $this->subclasificacion = $args['subclasificacion'] ?? '';
        $this->estatus = $args['estatus'] ?? '';
      

     
    }

}
