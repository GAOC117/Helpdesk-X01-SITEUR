<?php

namespace Model;

class VerEmpleados extends ActiveRecord
{
    protected static $tabla = 'empleado';
    protected static $columnasDB = [
        'id', 'nombre','apellidoPaterno', 'apellidoMaterno', 'email', 'extension', 'departamento', 'estatus'];



    public $id;
    public $nombre;
    public $apellidoPaterno;
    public $apellidoMaterno;
    public $email;
    public $extension;
    public $departamento;
    public $estatus;
 
   


    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? null;       
        $this->nombre= $args['nombre'] ?? '';
        $this->apellidoPaterno = $args['apellidoPaterno'] ?? '';
        $this->apellidoMaterno = $args['apellidoMaterno'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->extension = $args['extension'] ?? '';
        $this->departamento = $args['departamento'] ?? '';
        $this->estatus = $args['estatus'] ?? '';
      

     
    }

}
