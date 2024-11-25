<?php
include '../Consultas/consultasSql.php';

if (isset($_POST['nit'])) {
    $nitCliente = consultas::clean_string($_POST['nit']);

    if (!empty($nitCliente)) {
        if (consultas::DeleteSQL("cliente", "nit='$nitCliente'")) {
            echo '<script>
            swal({
                title: "Cliente eliminado",
                text: "El cliente ha sido eliminado con éxito",
                type: "success",
                confirmButtonText: "Aceptar"
            }).then(function() {
                window.location = "configAdmin.php"; // Redirecciona a la página de administración
            });
        </script>';
        } else {
            echo '<script>
                swal("ERROR", "Ocurrió un error inesperado, por favor intente nuevamente", "error");
            </script>';
        }
    } else {
        echo '<script>
            swal("ERROR", "El NIT del cliente no puede estar vacío", "error");
        </script>';
    }
} else {
    echo '<script>
        swal("ERROR", "No se recibió el NIT del cliente", "error");
    </script>';
}

