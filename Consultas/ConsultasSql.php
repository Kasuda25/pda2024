<?php
define("USER", "root");
define("PASS", "");
define("SERVER", "localhost");
define("BD", "market");


class ejecutar
{
    public static function conectar()
    {
        $con = mysqli_connect(SERVER, USER, PASS, BD);
        if (!$con) {
            die("Error en el servidor, verifique sus datos: " . mysqli_connect_error());
        }

        if (!mysqli_set_charset($con, "utf8")) {
            die("Error configurando el charset: " . mysqli_error($con));
        }

        return $con;
    }

    public static function consultar($query)
    {
        $conexion = self::conectar();
        $resultado = mysqli_query($conexion, $query);

        if (!$resultado) {
            die('Error en la consulta SQL ejecutada: ' . mysqli_error($conexion));
        }

        return $resultado;
    }

    public static function cerrarConexion($conexion)
    {
        mysqli_close($conexion);
    }
}

class consultas
{
    public static function InsertSQL($tabla, $campos, $valores)
    {
        $query = "INSERT INTO $tabla ($campos) VALUES($valores)";
        return ejecutar::consultar($query);
    }

    public static function DeleteSQL($tabla, $condicion)
    {
        $query = "DELETE FROM $tabla WHERE $condicion";
        return ejecutar::consultar($query);
    }

    public static function UpdateSQL($tabla, $campos, $condicion)
    {
        $query = "UPDATE $tabla SET $campos WHERE $condicion";
        return ejecutar::consultar($query);
    }

    public static function clean_string($val)
    {
        $val = trim($val);
        $val = stripslashes($val);
        $val = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
        return $val;
    }
}
