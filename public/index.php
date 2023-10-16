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
$router->get('/logout', [AuthController::class, 'logout']);

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
$router->get('/dashboard/', [DashboardController::class, 'index']);

//generar-ticket
$router->get('/dashboard/generar-ticket', [DashboardController::class, 'generarTicket']);
$router->post('/dashboard/generar-ticket', [DashboardController::class, 'generarTicket']);

//ver-tickets
$router->get('/dashboard/ver-tickets', [DashboardController::class, 'verTickets']);
$router->post('/dashboard/ver-tickets', [DashboardController::class, 'verTickets']);

//ver el historial de los tickets
$router->get('/dashboard/historial-tickets', [DashboardController::class, 'historialTickets']);

//pausar tickets
$router->get('/dashboard/pausar-tickets', [DashboardController::class, 'pausarTickets']);
$router->post('/dashboard/pausar-tickets', [DashboardController::class, 'pausarTickets']);

//escalar tickets
$router->get('/dashboard/escalar-tickets', [DashboardController::class, 'escalarTickets']);
$router->post('/dashboard/escalar-tickets', [DashboardController::class, 'escalarTickets']);

//asignar-ticket
$router->get('/dashboard/asignar-tickets', [DashboardController::class, 'asignarTickets']);
$router->post('/dashboard/asignar-tickets', [DashboardController::class, 'asignarTickets']);

//cerrar-ticket
$router->get('/dashboard/cerrar-tickets', [DashboardController::class, 'cerrarTickets']);
$router->post('/dashboard/cerrar-tickets', [DashboardController::class, 'cerrarTickets']);

//empleados
$router->get('/dashboard/empleados', [DashboardController::class, 'verEmpleados']);
$router->post('/dashboard/empleados', [DashboardController::class, 'verEmpleados']);
$router->get('/dashboard/empleados/update', [DashboardController::class, 'altaBajaEmpleado']);
$router->post('/dashboard/empleados/update', [DashboardController::class, 'altaBajaEmpleado']);
$router->get('/dashboard/empleados/editar', [DashboardController::class, 'editarEmpleado']);
$router->post('/dashboard/empleados/editar', [DashboardController::class, 'editarEmpleado']);

//clasificaciones
$router->get('/dashboard/clasificaciones', [DashboardController::class, 'verClasificaciones']);
$router->post('/dashboard/clasificaciones', [DashboardController::class, 'verClasificaciones']);
$router->get('/dashboard/clasificaciones/update', [DashboardController::class, 'altaBajaClasificacion']);
$router->post('/dashboard/clasificaciones/update', [DashboardController::class, 'altaBajaClasificacion']);
$router->get('/dashboard/clasificaciones/editar', [DashboardController::class, 'editarEmpleado']);
$router->post('/dashboard/clasificaciones/editar', [DashboardController::class, 'editarEmpleado']);


//subclasificaciones
$router->get('/dashboard/subclasificaciones', [DashboardController::class, 'versubclasificaciones']);
$router->post('/dashboard/subclasificaciones', [DashboardController::class, 'versubclasificaciones']);
$router->get('/dashboard/subclasificaciones/update', [DashboardController::class, 'altaBajaSubclasificacion']);
$router->post('/dashboard/subclasificaciones/update', [DashboardController::class, 'altaBajaSubclasificacion']);
$router->get('/dashboard/subclasificaciones/editar', [DashboardController::class, 'editarSubclasificacion']);
$router->post('/dashboard/subclasificaciones/editar', [DashboardController::class, 'editarSubclasificacion']);

//departamentos
$router->get('/dashboard/departamentos', [DashboardController::class, 'verDepartamentos']);
$router->post('/dashboard/departamentos', [DashboardController::class, 'verDepartamentos']);
$router->get('/dashboard/departamentos/update', [DashboardController::class, 'altaBajaDepartamento']);
$router->post('/dashboard/departamentos/update', [DashboardController::class, 'altaBajaDepartamento']);
$router->get('/dashboard/departamentos/editar', [DashboardController::class, 'editarDepartamento']);
$router->post('/dashboard/departamentos/editar', [DashboardController::class, 'editarDepartamento']);

//API's
$router->get('/api/obtenerEmpleado', [ApiController::class, 'obtenerEmpleado']);
$router->get('/api/obtenerEmpleadoRol', [ApiController::class, 'obtenerEmpleadoRol']);
$router->get('/api/obtenerSubclasificacion', [ApiController::class, 'obtenerSubclasificacion']);
$router->post('/api/generar-ticket', [ApiController::class, 'generarTicket']);
$router->get('/api/obtenerTablaTickets', [ApiController::class, 'verTickets']);
$router->get('/api/obtenerTablaHistorico', [ApiController::class, 'historialTickets']);
$router->get('/api/obtenerNotificaciones', [ApiController::class, 'obtenerNotificaciones']);
$router->get('/api/limpiarNotificaciones', [ApiController::class, 'limpiarNotificaciones']);
$router->get('/api/getMonthlyTickets', [ApiController::class, 'getMonthlyTickets']);


$router->comprobarRutas();