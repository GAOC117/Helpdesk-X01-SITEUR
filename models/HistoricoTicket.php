<?php

namespace Model;

class HistoricoTicket extends ActiveRecord
{
    protected static $tabla = 'historico_ticket';
    protected static $columnasDB = [
        'id', 'idTicket', 'idEstado', 'idEmpAsignado', 'fecha','comentarios'];



    public $id;
    public $idTicket;
    public $idEstado;
    public $idEmpAsignado;
    public $fecha;
    public $comentarios;
    


    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? null;
        $this->idTicket = $args['idTicket'] ?? 0;
        $this->idEstado = $args['idEstado'] ?? 0;
        $this->idEmpAsignado = $args['idEmpAsignado'] ?? '';
        $this->fecha = $args['fecha'] ?? date('0000-00-00');
        $this->comentarios = $args['comentarios'] ??  '';
      

    }
}
