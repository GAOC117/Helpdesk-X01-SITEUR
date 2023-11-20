<?php

namespace Model;

class InfoTicket extends ActiveRecord
{
    protected static $tabla = 'tickets';
    protected static $columnasDB = [
        'idTicket', 'nombreRequiere','departamento', 'extension', 'email', 'estadoTicket', 'clasificacion','subclasificacion', 'comentariosReporte','comentariosSoporte','atiende'];



    public $idTicket;
    public $nombreRequiere;
    // public $nombreAsigna;
    public $departamento;
    public $extension;
    public $email;
    public $clasificacion;
    public $subclasificacion;
    public $comentariosReporte;
    public $comentariosSoporte;
    public $atiende;
    
   


    public function __construct($args = [])
    {

        $this->idTicket = $args['idTicket'] ?? null;
        // $this->nombreAsigna = $args['nombreAsigna'] ?? '';
        $this->nombreRequiere = $args['nombreRequiere'] ?? '';
        $this->departamento = $args['departamento'] ?? '';
        $this->extension = $args['extension'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->clasificacion = $args['clasificacion'] ?? '';
        $this->subclasificacion = $args['subclasificacion'] ?? '';
        $this->comentariosReporte = $args['comentariosReporte'] ?? '';
        $this->comentariosSoporte = $args['comentariosSoporte'] ?? '';
        $this->atiende = $args['atiende'] ?? '';
        

     
    }

}
