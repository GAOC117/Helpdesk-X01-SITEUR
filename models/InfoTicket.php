<?php

namespace Model;

class InfoTicket extends ActiveRecord
{
    protected static $tabla = 'tickets';
    protected static $columnasDB = [
        'idTicket', 'nombreRequiere','departamento', 'extension', 'email', 'estadoTicket', 'clasificacion','subclasificacion', 'comentariosReporte','comentariosSoporte','atiende','tipoServicio'];



    public $idTicket;
    public $nombreRequiere;
    public $departamento;
    public $extension;
    public $email;
    public $estadoTicket;
    public $clasificacion;
    public $subclasificacion;
    public $comentariosReporte;
    public $comentariosSoporte;
    public $atiende;
    public $tipoServicio;
    
   


    public function __construct($args = [])
    {

        $this->idTicket = $args['idTicket'] ?? null;
        $this->nombreRequiere = $args['nombreRequiere'] ?? '';
        $this->departamento = $args['departamento'] ?? '';
        $this->extension = $args['extension'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->estadoTicket = $args['estadoTicket'] ?? '';
        $this->clasificacion = $args['clasificacion'] ?? '';
        $this->subclasificacion = $args['subclasificacion'] ?? '';
        $this->comentariosReporte = $args['comentariosReporte'] ?? '';
        $this->comentariosSoporte = $args['comentariosSoporte'] ?? '';
        $this->atiende = $args['atiende'] ?? '';
        $this->tipoServicio = $args['tipoServicio'] ?? '';
        

     
    }

}
