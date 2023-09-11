<?php

namespace Model;

class Tickets extends ActiveRecord
{
    protected static $tabla = 'tickets';
    protected static $columnasDB = [
        'id', 'idEmpAsigna', 'idEmpAsignado', 'comentariosReporte', 'comentariosSoporte','fechaAsignacion', 'fechaCierre', 'idEstado', 'idEmpReporta', 'idEmpRequiere', 'extensionReporta','extensionRequiere', 'idClasificacionProblema', 'idSubclasificacionProblema', 'ticketNuevo'
    ];



    public $id;
    public $idEmpAsigna;
    public $idEmpAsignado;
    public $comentariosReporte;
    public $comentariosSoporte;
    public $fechaAsignacion;
    public $fechaCierre;
    public $idEstado;
    public $idEmpReporta;
    public $idEmpRequiere;
    public $extensionReporta;
    public $extensionRequiere;
    public $idClasificacionProblema;
    public $idSubclasificacionProblema;
    public $ticketNuevo;



    public function __construct($arg = [])
    {

        $this->id = $args['id'] ?? '';
        $this->idEmpAsigna = $args['idEmpAsigna'] ?? '';
        $this->idEmpAsignado = $args['idEmpAsignado'] ?? '';
        $this->comentariosReporte = $args['comentariosReporte'] ?? '';
        $this->comentariosSoporte = $args['comentariosSoporte'] ?? '';
        $this->fechaAsignacion = $args['fechaAsignacion'] ?? '';
        $this->fechaCierre = $args['fechaCierre'] ?? '';
        $this->idEstado = $args['idEstado'] ?? 1;
        $this->idEmpReporta = $args['idEmpReporta'] ?? '';
        $this->idEmpRequiere = $args['idEmpRequiere'] ?? '';
        $this->idClasificacionProblema = $args['idClasificacionProblema'] ?? '';
        $this->extensionReporta = $args['extensionReporta'] ?? '';
        $this->extensionRequiere = $args['extensionRequiere'] ?? '';
        $this->idSubclasificacionProblema = $args['idSubclasificacionProblema'] ?? '';
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
