<?php
namespace Model;
class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Alertas y Mensajes
    protected static $alertas = [];
    
    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    // Setear un tipo de Alerta
    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Obtener las alertas
    public static function getAlertas() {
        return static::$alertas;
    }

    // Validación que se hereda en modelos
    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria (Active Record)
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }


    public static function contar($query){
        $resultado = self::$db->query($query);
        return $resultado->fetch_assoc();
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function atributosEmpleado() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
         
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }


    public static function SQL($query)
    {
        $resultado = self::consultarSQL($query);

        return  $resultado;
        
    }


    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }


    public function sanitizarAtributosEmpleado() {
        $atributos = $this->atributosEmpleado();
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }


    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key =  s($value);
          }
        }
    }

    // Registros - CRUD
    public function guardar() {
        $resultado = '';

        if(!is_null($this->id)) {
           
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            
           
            $resultado = $this->crear();
        }
        return $resultado;
    }

    // Obtener todos los Registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }


    public static function allWhere($columna, $valor, $orden) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE $columna = '$valor' and estatus = 1 ORDER BY $orden";
        $resultado = self::consultarSQL($query);
        return  $resultado;
    }
    //solo un valor
    public static function OneWhere($columna, $valor, $orden) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE $columna = '$valor' ORDER BY $orden";
        $resultado = self::consultarSQL($query);
        return  array_shift($resultado);
    }

    public static function allInformatica($columna,  $orden) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE estatus = 1 AND $columna in (52,87,32) ORDER BY nombre $orden";
       
        $resultado = self::consultarSQL($query);
        return  $resultado;
    }

    public static function allOrderBy($order) {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY $order";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function allOrderByWhere($order) {
        $query = "SELECT * FROM " . static::$tabla . " where estatus = 1 ORDER BY $order ";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = $id AND estatus = 1";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }
    public static function findWithOutEstatus($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = $id";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }
    public static function findEmpleado($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = $id";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Obtener Registros con cierta cantidad
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT $limite ORDER BY id DESC" ;
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Busqueda Where con Columna 
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE $columna = '$valor'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }
    public static function whereLogin($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE $columna = '$valor' AND estatus = 1";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }
    public static function whereAll($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE $columna = '$valor'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function whereAnd($columna1, $valor1, $columna2, $valor2) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE $columna1 = '$valor1' AND $columna2 = '$valor2' ";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }
    public static function whereAndLogIn($columna1, $valor1, $columna2, $valor2) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE $columna1 = '$valor1' AND $columna2 = '$valor2' AND estatus = 1";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // crea un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= "') ";
        
      

        //    debuguear($query); // Descomentar si no te funciona algo

        // Resultado de la consulta
        $resultado = self::$db->query($query);
       
        return [
           'resultado' =>  $resultado,
           'id' => self::$db->insert_id
        ];
    }


        // crea un nuevo registro
        public function crearHistorico() {
            // Sanitizar los datos
            $atributos = $this->sanitizarAtributos();
    
            // Insertar en la base de datos
            $query = " INSERT INTO " . static::$tabla . " ( ";
            $query .= join(', ', array_keys($atributos));
            $query .= " ) VALUES (' "; 
            $query .= join("', '", array_values($atributos));
            $query .= "') ";
            
          
    
            //    debuguear($query); // Descomentar si no te funciona algo
    
            // Resultado de la consulta
            $resultado = self::$db->query($query);
           
            return [
               'resultado' =>  $resultado,
               'id' => self::$db->insert_id
            ];
        }
    // crea un nuevo registro
    public function crearEmpleado() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributosEmpleado();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

         //debuguear($query); // Descomentar si no te funciona algo

        // Resultado de la consulta
        $resultado = self::$db->query($query);
       
        return [
           'resultado' =>  $resultado,
           'id' => self::$db->insert_id
        ];
    }

    // Actualizar el registro
    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }

public static function actualizarQuery($query){
    $resultado = self::$db->query($query);
    return $resultado;
}

    public function actualizarEmpleado($id) {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributosEmpleado();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($id) . "' ";
        $query .= " LIMIT 1 "; 

        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }


    public function EditarEmpleado($idEmpleado) {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributosEmpleado();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($idEmpleado) . "' ";
        $query .= " LIMIT 1 "; 

        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un Registro por su ID
    public function eliminar() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }


}