<?php
session_start();
include '../Consultas/consultasSql.php';

$NIT = consultas::clean_string($_POST['clien-nit']);
$Nombre = consultas::clean_string($_POST['clien-fullname']);
$Apellido = consultas::clean_string($_POST['clien-lastname']);
$Telefono = consultas::clean_string($_POST['clien-phone']);
$Email = consultas::clean_string($_POST['clien-email']);
$Direccion = consultas::clean_string($_POST['clien-dir']);
$oldUser = consultas::clean_string($_POST['clien-old-name']);
$user = consultas::clean_string($_POST['clien-name']);
$oldPass = consultas::clean_string($_POST['clien-old-pass']);
$newPass = consultas::clean_string($_POST['clien-new-pass']);
$newPass2 = consultas::clean_string($_POST['clien-new-pass2']);

if ($oldUser !== $user) {
    $SelectUser = ejecutar::consultar("SELECT * FROM cliente WHERE Nombre='$user'");
    if (mysqli_num_rows($SelectUser) > 0) {
        echo '<script>swal("Error", "El nombre de usuario ya está registrado. Intente con otro.", "error");</script>';
        mysqli_free_result($SelectUser);
        exit();
    }
    mysqli_free_result($SelectUser);
}

$newPassHashed = '';
if (!empty($oldPass) && !empty($newPass) && !empty($newPass2)) {
    if ($newPass !== $newPass2) {
        echo '<script>swal("Error", "Las nuevas contraseñas no coinciden.", "error");</script>';
        exit();
    }

    $oldPassHashed = md5($oldPass);
    $CheckLog = ejecutar::consultar("SELECT * FROM cliente WHERE Nombre='$oldUser' AND Clave='$oldPassHashed'");

    if (mysqli_num_rows($CheckLog) === 1) {
        $newPassHashed = md5($newPass);
    } else {
        echo '<script>swal("Error", "La contraseña actual no es correcta.", "error");</script>';
        exit();
    }
    mysqli_free_result($CheckLog);
}

$campos = "Nombre='$user', NombreCompleto='$Nombre', Apellido='$Apellido', Direccion='$Direccion', Telefono='$Telefono', Email='$Email'";
if (!empty($newPassHashed)) {
    $campos .= ", Clave='$newPassHashed'";
}

if (consultas::UpdateSQL("cliente", $campos, "NIT='$NIT'")) {
    $_SESSION['nombreUser'] = $user;
    echo '<script>
        swal({
            title: "Datos actualizados",
            text: "Tus datos se han actualizado correctamente.",
            icon: "success"
        }).then(() => {
            location.reload();
        });
    </script>';
} else {
    echo '<script>swal("Error", "Ocurrió un error al actualizar los datos.", "error");</script>';
}
?>
