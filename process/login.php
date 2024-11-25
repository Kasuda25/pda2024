<?php
session_start();
include '../Consultas/consultasSql.php';

$nombre = consultas::clean_string($_POST['nombre-login']);
$clave = consultas::clean_string(password_hash($_POST['clave-login'], PASSWORD_DEFAULT));

if (!empty($nombre) && !empty($clave)) {
    $verAdmin = ejecutar::consultar("SELECT * FROM administrador WHERE Nombre='$nombre' AND Clave='$clave'");
    if (mysqli_num_rows($verAdmin) > 0) {
        $admin = mysqli_fetch_array($verAdmin, MYSQLI_ASSOC);
        $_SESSION['nombreAdmin'] = $admin['Nombre'];
        $_SESSION['adminID'] = $admin['id'];
        $_SESSION['UserType'] = "Admin";
        echo '<script> location.href="index.php"; </script>';
        exit;
    }

    $verUser = ejecutar::consultar("SELECT * FROM cliente WHERE Nombre='$nombre' AND Clave='$clave'");
    if (mysqli_num_rows($verUser) > 0) {
        $user = mysqli_fetch_array($verUser, MYSQLI_ASSOC);
        $_SESSION['nombreUser'] = $user['Nombre'];
        $_SESSION['UserNIT'] = $user['NIT'];
        $_SESSION['UserType'] = "User";
        echo '<script> location.href="index.php"; </script>';
        exit;
    }

    echo 'Error: Nombre o contraseña inválidos';
} else {
    echo 'Error: Complete todos los campos.';
}
?>
