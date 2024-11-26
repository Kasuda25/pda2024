<?php
session_start();
include '../Consultas/consultasSql.php';

$code = consultas::clean_string($_POST['code']);

$SelectUser = ejecutar::consultar("SELECT * FROM cliente WHERE NIT='$code'");

if (mysqli_num_rows($SelectUser) === 1) {
    $DataUser = mysqli_fetch_array($SelectUser, MYSQLI_ASSOC);

    echo '
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <legend><i class="fa fa-user"></i> &nbsp; Datos personales</legend>
                </div>
                <div class="col-xs-12">
                    <div class="form-group label-floating">
                        <label class="control-label"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp; DNI</label>
                        <input class="form-control" type="text" readonly name="clien-nit" value="' . htmlspecialchars($DataUser['NIT']) . '">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                        <label class="control-label"><i class="fa fa-user"></i>&nbsp; Nombres</label>
                        <input class="form-control" type="text" name="clien-fullname" value="' . htmlspecialchars($DataUser['NombreCompleto']) . '" pattern="[a-zA-Z ]{1,50}" maxlength="50" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                        <label class="control-label"><i class="fa fa-user"></i>&nbsp; Apellidos</label>
                        <input class="form-control" type="text" name="clien-lastname" value="' . htmlspecialchars($DataUser['Apellido']) . '" pattern="[a-zA-Z ]{1,50}" maxlength="50" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                        <label class="control-label"><i class="fa fa-mobile"></i>&nbsp; Teléfono</label>
                        <input class="form-control" type="tel" name="clien-phone" value="' . htmlspecialchars($DataUser['Telefono']) . '" maxlength="15" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                        <label class="control-label"><i class="fa fa-envelope-o"></i>&nbsp; Email</label>
                        <input class="form-control" type="email" name="clien-email" value="' . htmlspecialchars($DataUser['Email']) . '" maxlength="50" required>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group label-floating">
                        <label class="control-label"><i class="fa fa-home"></i>&nbsp; Dirección</label>
                        <input class="form-control" type="text" name="clien-dir" value="' . htmlspecialchars($DataUser['Direccion']) . '" maxlength="100" required>
                    </div>
                </div>
                <div class="col-xs-12">
                    <legend><i class="fa fa-lock"></i> &nbsp; Datos de la cuenta</legend>
                </div>
                <input type="hidden" name="clien-old-name" value="' . htmlspecialchars($DataUser['Nombre']) . '">
                <div class="col-xs-12">
                    <div class="form-group label-floating">
                        <label class="control-label"><i class="fa fa-user-circle-o"></i>&nbsp; Nombre de usuario</label>
                        <input class="form-control" type="text" name="clien-name" value="' . htmlspecialchars($DataUser['Nombre']) . '" pattern="[a-zA-Z0-9]{1,9}" maxlength="9" required>
                    </div>
                </div>
                <div class="col-xs-12">
                    <p>No es necesario actualizar la contraseña. Si desea hacerlo, introduzca la contraseña actual y defina una nueva.</p>
                </div>
                <div class="col-xs-12">
                    <div class="form-group label-floating">
                        <label class="control-label"><i class="fa fa-lock"></i>&nbsp; Contraseña actual</label>
                        <input class="form-control" type="password" name="clien-old-pass">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                        <label class="control-label"><i class="fa fa-lock"></i>&nbsp; Nueva contraseña</label>
                        <input class="form-control" type="password" name="clien-new-pass">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                        <label class="control-label"><i class="fa fa-lock"></i>&nbsp; Repita la nueva contraseña</label>
                        <input class="form-control" type="password" name="clien-new-pass2">
                    </div>
                </div>
            </div>
        </div>
    ';
} else {
    echo '<div class="alert alert-danger">Ocurrió un error, por favor recargue la página e intente nuevamente.</div>';
}
