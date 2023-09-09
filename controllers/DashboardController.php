<?php

namespace Controllers;

use Classes\Email;
use Model\Departamento;
use Model\Empleado;
use MVC\Router;

class DashboardController
{
    
    public static function index(Router $router)
    {
        session_start();
      $idRol = $_SESSION['idRol'];
      $nombre = $_SESSION['nombre'].' '.$_SESSION['apellidoPaterno']. ' '.$_SESSION['apellidoMaterno'];
      $expediente = $_SESSION['id'];
      
   
      
        $titulo = 'Dashboard de '.$nombre.' - '.$expediente;

      
        $router->renderView('dashboard/index', [
            'titulo'=> $titulo,
            'idRol' => $idRol,
            'expediente' => $expediente,
            'nombre' => $nombre
        ]);
    }

public static function capturarTicket(Router $router) {
    session_start();
    $idRol = $_SESSION['idRol'];
    $nombre = $_SESSION['nombre'].' '.$_SESSION['apellidoPaterno']. ' '.$_SESSION['apellidoMaterno'];
    $expediente = $_SESSION['id'];
    
 
    
      $titulo = 'Capturar nuevo ticket';

    
      $router->renderView('dashboard/capturar-ticket', [
          'titulo'=> $titulo,
          'idRol' => $idRol,
          'expediente' => $expediente,
          'nombre' => $nombre
      ]);


}


}

