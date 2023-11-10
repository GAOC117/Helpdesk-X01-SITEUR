<?php

namespace Controllers;

use Classes\Email;
use Model\Departamento;
use Model\Empleado;
use MVC\Router;

class AuthController
{


    public static function index()
    {
        session_start();
        if (!empty($_SESSION)) //si ya hay una sesión rediriccionarlo al dashboard
            header('Location: /dashboard');
        else 
            header('Location: /login'); //de lo contrario redireccionarlo al login
    }



    public static function login(Router $router)
    {

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario = new Empleado($_POST);

            $alertas = $usuario->validarLogin();

            if (empty($alertas)) {
                // Verificar quel el usuario exista
                $usuario = Empleado::whereLogin('email', $usuario->email);
                if (!$usuario || !$usuario->confirmado) {
                    Empleado::setAlerta('error', 'El Usuario no existe o no está confirmado');
                } else {
                    // El Usuario existe
                    if (password_verify($_POST['password'], $usuario->password)) {

                        // Iniciar la sesión
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellidoPaterno'] = $usuario->apellidoPaterno;
                        $_SESSION['apellidoMaterno'] = $usuario->apellidoMaterno;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['idDepartamento'] = $usuario->idDepartamento;
                        $_SESSION['idRol'] = $usuario->idRol;
                        $_SESSION['extension'] = $usuario->extension;
                       


                        header('Location: /dashboard');

                        // //si es perfil administrador o helpdesk (mesa de ayuda) o soporte
                        // if ($usuario->idRol === '1')
                        //     header('Location: /admin/dashboard');
                        // //si es perfil helpdesk (mesa de ayuda) o soporte
                        // else if ($usuario->idRol === '2' || $usuario->idRol === '3')
                        //     header('Location: /helpdesk/dashboard');
                        // //si es perfil  soporte
                        // else if ($usuario->idRol === '3')
                        //     header('Location: /soporte/dashboard');
                        // //si es perfil colaborador (empleado del siteur)
                        // else if ($usuario->idRol === '4')
                        //     header('Location: /colaborador/dashboard');
                    } else {
                        Empleado::setAlerta('error', 'Contraseña incorrecta');
                    }
                }
            }
        }

        $alertas = Empleado::getAlertas();

        // Render a la vista 
        $router->renderView('auth/login', [
            'titulo' => 'Iniciar sesión',
            'alertas' => $alertas,
            'email' => $usuario->email
        ]);
    }

    public static function logout()
    {
       
            session_start();
            $_SESSION = [];
            header('Location: /');
        
    }

    public static function registro(Router $router)
    {
        $alertas = [];
        $usuario = new Empleado;
        $departamentos =  Departamento::allOrderBy('descripcion asc');


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //sincroniza los datos de post con los de la base de datos
            $usuario->sincronizar($_POST);
           
            $alertas = $usuario->validar_cuenta();

            $existeUsuarioCorreo = Empleado::whereAndLogIn('id', $usuario->id, 'email', $usuario->email);
                $existeExpediente = Empleado::whereLogin('id', $usuario->id);
                $existeCorreo = Empleado::whereLogin('email', $usuario->email);

                if ($existeUsuarioCorreo) {
                    Empleado::setAlerta('error', 'Ya existe un empleado registrado con ese expediente y correo');
                  
                } else if ($existeExpediente) {
                    Empleado::setAlerta('error', 'Ya existe un empleado registrado con ese expediente');
                   
                } else if ($existeCorreo) {
                    Empleado::setAlerta('error', 'Ya existe un empleado registrado con ese correo');
                   
                } 

                $alertas = Empleado::getAlertas();

            if (empty($alertas)) {
                


                    // Hashear el password
                    $usuario->hashPassword();


                    // Eliminar password2
                    unset($usuario->password2);

                    // Generar el Token
                    $usuario->crearToken();


                    // Crear un nuevo usuario
                    $resultado =  $usuario->crearEmpleado();

                    // Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();


                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                
            }//if alertas
        }

        // Render a la vista
        $router->renderView('auth/registro', [
            'titulo' => 'Crea tu cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas,
            'departamentos' => $departamentos
        ]);
    }

    public static function olvide(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Empleado($_POST);
            $alertas = $usuario->validarEmail();

            if (empty($alertas)) {
                // Buscar el usuario
                $usuario = Empleado::whereLogin('email', $usuario->email);
                if ($usuario && $usuario->confirmado) {
                    // Generar un nuevo token
                    
                    $usuario->crearToken();
                    unset($usuario->password2);

                    // Actualizar el usuario
                    $usuario->actualizarEmpleado($usuario->id);

                    // Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();


                    // Imprimir la alerta
                    // Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');

                    $alertas['exito'][] = 'Hemos enviado las instrucciones a tu <a class="linkGmail--alerta" href="https://www.gmail.com">correo</a>';
                } else {

                    // Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');

                    $alertas['error'][] = 'El usuario no existe o no esta confirmado';
                }
            }
        }

        // Muestra la vista
        $router->renderView('auth/olvide', [
            'titulo' => 'Olvide mi contraseña',
            'alertas' => $alertas
        ]);
    }

    public static function reestablecer(Router $router)
    {

        $token = s($_GET['token']);

        $token_valido = true;

        if (!$token) header('Location: /');

        // Identificar el usuario con este token
        $usuario = Empleado::whereLogin('token', $token);
        

        if (empty($usuario)) {
            Empleado::setAlerta('error', 'Token no válido, intenta de nuevo');
            $token_valido = false;
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Añadir el nuevo password
            $usuario->sincronizar($_POST);

            // Validar el password
            $alertas = $usuario->validarPassword();

            if (empty($alertas)) {
                // Hashear el nuevo password
                $usuario->hashPassword();

                // Eliminar el Token
                $usuario->token = null;

                // Eliminar password2
                unset($usuario->password2);
                // Guardar el usuario en la BD
                // $resultado = $usuario->guardar();
                $resultado = $usuario->actualizarEmpleado($usuario->id);

                // Redireccionar
                if ($resultado) {
                    header('Location: /login');
                }
            }
        }

        $alertas = Empleado::getAlertas();

        // Muestra la vista
        $router->renderView('auth/reestablecer', [
            'titulo' => 'Reestablecer contraseña',
            'alertas' => $alertas,
            'token_valido' => $token_valido
        ]);
    }

    public static function mensaje(Router $router)
    {

        $router->renderView('auth/mensaje', [
            'titulo' => 'Cuenta creada con éxito'
        ]);
    }

    public static function confirmar(Router $router)
    {

        $token = s($_GET['token']);

        if (!$token) header('Location: /');

        // Encontrar al usuario con este token
        $usuario = Empleado::whereLogin('token', $token);

        if (empty($usuario)) {
            // No se encontró un usuario con ese token
            Empleado::setAlerta('error', 'Token no válido, la cuenta no se confirmó');
        } else {
            // Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = '';

            unset($usuario->password2);

            // Guardar en la BD
            $usuario->actualizarEmpleadoToken($token);

            Empleado::setAlerta('exito', 'Cuenta comprobada con éxito');
        }



        $router->renderView('auth/confirmar', [
            'titulo' => 'Confirma tu cuenta Helpdesk SITEUR',
            'alertas' => Empleado::getAlertas()
        ]);
    }
}
