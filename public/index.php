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

//generar-ticket
$router->get('/dashboard/generar-ticket', [DashboardController::class, 'generarTicket']);
$router->post('/dashboard/generar-ticket', [DashboardController::class, 'generarTicket']);

//ver-tickets
$router->get('/dashboard/ver-tickets', [DashboardController::class, 'verTickets']);
$router->post('/dashboard/ver-tickets', [DashboardController::class, 'verTickets']);

//asignar-ticket
$router->get('/dashboard/asignar-tickets', [DashboardController::class, 'asignarTickets']);
$router->post('/dashboard/asignar-tickets', [DashboardController::class, 'asignarTickets']);


//API's
$router->get('/api/obtenerEmpleado', [ApiController::class, 'obtenerEmpleado']);
$router->get('/api/obtenerSubclasificacion', [ApiController::class, 'obtenerSubclasificacion']);
$router->post('/api/generar-ticket', [ApiController::class, 'generarTicket']);


$router->comprobarRutas();