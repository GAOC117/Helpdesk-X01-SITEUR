<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\ApiController;
use Controllers\AuthController;
use Controllers\DashboardController;
use Controllers\AdminController;
use Controllers\ColaboradorController;
use Controllers\HelpdeskController;
use Controllers\SoporteController;

$router = new Router();


// Login
$router->get('/', [AuthController::class, 'index']);
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);



//Area de dashboard
$router->get('/dashboard', [DashboardController::class, 'index']);


// $router->get('/admin/dashboard', [DashboardController::class, 'index']);
// $router->get('/helpdesk/dashboard', [DashboardController::class, 'index']);
// $router->get('/soporte/dashboard', [DashboardController::class, 'index']);
// $router->get('/colaborador/dashboard', [DashboardController::class, 'index']);


// $router->get('/admin/dashboard', [AdminController::class, 'indexAdmin']);
// $router->get('/helpdesk/dashboard', [AdminController::class, 'indexHelpdesk']);
// $router->get('/soporte/dashboard', [AdminController::class, 'indexSoporte']);
// $router->get('/colaborador/dashboard', [AdminController::class, 'indexColaborador']);


// //Area de admin
// $router->get('/admin/dashboard', [AdminController::class, 'index']);


// //Area de helpdesk
// $router->get('/helpdesk/dashboard', [HelpdeskController::class, 'index']);


// //Area de soporte
// $router->get('/soporte/dashboard', [SoporteController::class, 'index']);


// //Area de colaborador
// $router->get('/colaborador/dashboard', [ColaboradorController::class, 'index']);


//API's
// $router->get('/api/departamentos', [ApiController::class, 'index']);


$router->comprobarRutas();