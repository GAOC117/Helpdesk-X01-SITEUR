<?php

namespace Model;

class Empleado extends ActiveRecord {
    protected static $tabla = 'empleado';
    protected static $columnasDB = ['id', 'nombre', 'apellidoPaterno','apellidoMaterno', 'email', 'password','extension', 'idDepartamento',
                                    'idRol','estatus','ticketNuevo','confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellidoPaterno;
    public $apellidoMaterno;
    public $email;
    public $password;
    public $password2;
    public $extension;
    public $idDepartamento;
    public $idRol;
    public $estatus;
    public $ticketNuevo;
    public $confirmado;
    public $token;
    

    public $password_actual;
    public $password_nuevo;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellidoPaterno = $args['apellidoPaterno'] ?? '';
        $this->apellidoMaterno = $args['apellidoMaterno'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->extension = $args['extension'] ?? '';
        $this->idDepartamento = $args['idDepartamento'] ?? '';
        $this->idRol = $args['idRol'] ?? 4;
        $this->estatus = $args['estatus'] ?? 1;
        $this->ticketNuevo = $args['ticketNuevo'] ?? 0; //para el dashboard principal ver cuantos nuevos tiene
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
       
    }

    // Validar el Login de Usuarios
    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }
       else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Correo no válido';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña no puede ir vacia';
        }
        return self::$alertas;
    }

    // Validación para cuentas nuevas
    public function validar_cuenta() {
        
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->apellidoPaterno) {
            self::$alertas['error'][] = 'El apellido paterno es obligatorio';
        }
        if(!$this->apellidoMaterno) {
            self::$alertas['error'][] = 'El apellido materno es obligatorio';
        }
        if(!$this->id) {
            self::$alertas['error'][] = 'El expediente es obligatorio';
        }
        // if(!$this->extension) {
        //     self::$alertas['error'][] = 'La extensión es obligatoria';
        // }
        if(!$this->email) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña no puede ir vacia';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La contraseña debe contener al menos 6 caracteres';
        }
        if($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }

     
        if(!$this->idDepartamento) {
            self::$alertas['error'][] = 'Debe indicar a que departamento pertenece';
        }


        return self::$alertas;
    }

    // Valida un email
    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }
        else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Correo no válido';
        }
        return self::$alertas;
    }

    // Valida el Password 
    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña no puede ir vacia';
        }
       else if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La contraseña debe contener al menos 6 caracteres';
        }
        if($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }
        return self::$alertas;
    }

    public function nuevo_password() : array {
        if(!$this->password_actual) {
            self::$alertas['error'][] = 'La contraseña actual no puede ir vacia';
        }
        if(!$this->password_nuevo) {
            self::$alertas['error'][] = 'La contraseña nueva no puede ir vacia';
        }
        if(strlen($this->password_nuevo) < 6) {
            self::$alertas['error'][] = 'La contraseña debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    // Comprobar el password
    public function comprobar_password() : bool {
        return password_verify($this->password_actual, $this->password );
    }

    // Hashea el password
    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Generar un Token
    public function crearToken() : void {
        $this->token = uniqid();
    }


    public function validarEdicion(){
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->apellidoPaterno) {
            self::$alertas['error'][] = 'El apellido paterno es obligatorio';
        }
        if(!$this->apellidoMaterno) {
            self::$alertas['error'][] = 'El apellido materno es obligatorio';
        }
        if(!$this->id) {
            self::$alertas['error'][] = 'El expediente es obligatorio';
        }
        if(!$this->extension) {
            self::$alertas['error'][] = 'La extensión es obligatoria';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }    

        if(!$this->idDepartamento) {
            self::$alertas['error'][] = 'Debe indicar a que departamento pertenece';
        }


        return self::$alertas;
    }
}