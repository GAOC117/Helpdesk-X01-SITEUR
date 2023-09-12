<?php

namespace Model;

class Tickets extends ActiveRecord
{
    protected static $tabla = 'tickets';
    protected static $columnasDB = [
        'id', 'idEmpAsigna', 'idEmpAsignado', 'comentariosReporte', 'comentariosSoporte','fechaAsignacion', 'fechaCierra', 'idEstado', 'idEmpReporta', 'idEmpRequiere','idClasificacionProblema', 'idSubclasificacionProblema', 'ticketNuevo'
    ];



    public $id;
    public $idEmpAsigna;
    public $idEmpAsignado;
    public $comentariosReporte;
    public $comentariosSoporte;
    public $fechaAsignacion;
    public $fechaCierra;
    public $idEstado;
    public $idEmpReporta;
    public $idEmpRequiere;
    public $idClasificacionProblema;
    public $idSubclasificacionProblema;
    public $ticketNuevo;



    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? null;
        $this->idEmpAsigna = $args['idEmpAsigna'] ?? 0;
        $this->idEmpAsignado = $args['idEmpAsignado'] ?? 0;
        $this->comentariosReporte = $args['comentariosReporte'] ?? '';
        $this->comentariosSoporte = $args['comentariosSoporte'] ?? '';
        $this->fechaAsignacion = $args['fechaAsignacion'] ??  date('0000-00-00');
        $this->fechaCierra = $args['fechaCierra'] ?? date('0000-00-00');
        $this->idEstado = $args['idEstado'] ?? 1;
        $this->idEmpReporta = $args['idEmpReporta'] ?? 0;
        $this->idEmpRequiere = $args['idEmpRequiere'] ?? 0;
        $this->idClasificacionProblema = $args['idClasificacionProblema'] ?? 0;
        $this->idSubclasificacionProblema = $args['idSubclasificacionProblema'] ?? 0;
        $this->ticketNuevo = $args['ticketNuevo'] ?? 1;
    }


    public function validarTicketNuevo()
    {

        if(!$this->idClasificacionProblema){
            self::$alertas['error'][] ='Debe seleccionar una clasificacion de acuerdo al problema presentado';
          
        }

         if(!$this->idSubclasificacionProblema)
        {
            self::$alertas['error'][]='Debe seleccionar una subclasificacion de acuerdo al problema presentado';
        }
         if(!$this->comentariosReporte)
        {
            self::$alertas['error'][]='De una breve explicación del problema que presenta';
        }

        if(strlen($this->comentariosReporte) > 250) {
            self::$alertas['error'][] = 'La descripción debe ser breve, no debe exceder los 250 carácteres';
        }



        return self::$alertas;
    }
}