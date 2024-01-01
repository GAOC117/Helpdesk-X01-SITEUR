<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {

        $url_actual = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$url_actual] ?? null;
        } else {
            $fn = $this->postRoutes[$url_actual] ?? null;
        }

        if ($fn) {
            call_user_func($fn, $this);
        } else {

            echo "Página no encontrada o ruta no válida";
        }
    }

    public function renderView($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start(); //inicia almacenamiento en memoria para el siguiente include, GUARDAR EN MEMORIA A QUE SE LE DA RENDER
        include __DIR__ . '/views/' . $view . '.php';
        //y lo almacena en $contenido
        $contenido = ob_get_clean();

        //Utilizar el layout de acuerdo a la URL
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';

        //    if(str_contains($urlActual, '/admin') || str_contains($urlActual, '/helpdesk') || str_contains($urlActual, '/soporte')
        //    ||str_contains($urlActual, '/colaborador'))
        if (str_contains($urlActual, '/dashboard'))
            include_once __DIR__ . '/views/dashboard-layout.php';
        // include_once __DIR__ . '/views/layout-dashboard.php';
        else
            include_once __DIR__ . '/views/layout.php';
    }
}
