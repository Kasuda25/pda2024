<?php
define("USER", "root");
define("SERVER", "localhost");
define("BD", "market");
define("PASS", "");

class ejecutar {
    public static function conectar(){
        if(!$con=  mysqli_connect(SERVER,USER,PASS,BD)){
            echo "Error en el servidor, verifique sus datos";
        }
       
        mysqli_set_charset($con, "utf8");
        return $con;  
    }
    public static function consultar($query) {
        if (!$consul = mysqli_query(ejecutar::conectar(), $query)) {
            echo 'Error en la consulta SQL ejecutada';
        }
        return $consul;
    }  
}

class consultas{
    public static function InsertSQL($tabla, $campos, $valores) {
        if (!$consul = ejecutar::consultar("INSERT INTO $tabla ($campos) VALUES($valores)")) {
            die("Ha ocurrido un error al insertar los datos en la tabla");
        }
        return $consul;
    }
    public static function DeleteSQL($tabla, $condicion) {
        if (!$consul = ejecutar::consultar("DELETE FROM $tabla WHERE $condicion")) {
            die("Ha ocurrido un error al eliminar los registros en la tabla");
        }
        return $consul;
    }
    public static function UpdateSQL($tabla, $campos, $condicion) {
        if (!$consul = ejecutar::consultar("UPDATE $tabla SET $campos WHERE $condicion")) {
            die("Ha ocurrido un error al actualizar los datos en la tabla");
        }
        return $consul;
    }
    public static function clean_string($val){
        $val=trim($val);
        $val=stripslashes($val);
        $val=str_ireplace("SELECT * FROM", "", $val);
        $val=str_ireplace("DELETE FROM", "", $val);
        $val=str_ireplace("INSERT INTO", "", $val);
      
        $val=str_ireplace("--", "", $val);
    return $val;
    
    }
}
