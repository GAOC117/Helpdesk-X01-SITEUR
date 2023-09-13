<?php

namespace Model;

class VerTickets extends ActiveRecord
{
    protected static $tabla = 'tickets';
    protected static $columnasDB = [
        'idTicket', 'fecha','nombreAsigna', 'atiende', 'nombreRequiere', 'estadoTicket', 'clasificacion', 'subclasificacion', 'comentarios','fechaAsignacion','fechaCierra'];



    public $idTicket;
    public $fecha;
    public $nombreAsigna;
    public $atiende;
    public $nombreRequiere;
    public $estadoTicket;
    public $clasificacion;
    public $subclasificacion;
    public $comentarios;
    public $fechaAsignacion;
    public $fechaCierra;
   


    public function __construct($args = [])
    {

        $this->idTicket = $args['idTicket'] ?? null;
        $this->nombreAsigna = $args['nombreAsigna'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->atiende = $args['atiende'] ?? '';
        $this->nombreRequiere = $args['nombreRequiere'] ?? '';
        $this->estadoTicket = $args['estadoTicket'] ?? '';
        $this->estadoTicket = $args['estadoTicket'] ?? '';
        $this->clasificacion = $args['clasificacion'] ?? '';
        $this->subclasificacion = $args['subclasificacion'] ?? '';
        $this->comentarios = $args['comentarios'] ?? '';
        $this->fechaAsignacion = $args['fechaAsignacion'] ?? '';
        $this->fechaCierra = $args['fechaCierra'] ?? '';

     
    }

}
