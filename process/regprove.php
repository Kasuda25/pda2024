<?php
session_start();
include '../Consultas/consultasSql.php';

$nitProve=consultas::clean_string($_POST['prove-nit']);
$nameProve=consultas::clean_string($_POST['prove-name']);
$dirProve=consultas::clean_string($_POST['prove-dir']);
$telProve=consultas::clean_string($_POST['prove-tel']);
$webProve=consultas::clean_string($_POST['prove-web']);

$verificar=  ejecutar::consultar("SELECT * FROM proveedor WHERE NITProveedor='".$nitProve."'");
if(mysqli_num_rows($verificar)<=0){
    if(consultas::InsertSQL("proveedor", "NITProveedor, NombreProveedor, Direccion, Telefono, PaginaWeb", "'$nitProve','$nameProve','$dirProve','$telProve','$webProve'")){
        echo '<script>
            swal({
              title: "Proveedor registrado",
              text: "Los datos del proveedor se agregaron con éxito",
              type: "success",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Aceptar",
              cancelButtonText: "Cancelar",
              closeOnConfirm: false,
              closeOnCancel: false
              },
              function(isConfirm) {
              if (isConfirm) {
                location.reload();
              } else {
                location.reload();
              }
            });
        </script>';
    }else{
       echo '<script>swal("ERROR", "Ocurrió un error inesperado, por favor intente nuevamente", "error");</script>';
    }
}else{
    echo '<script>swal("ERROR", "El número de ID que ha ingresado ya se encuentra registrado en el sistema, por favor ingrese otro número de NIT o CEDULA", "error");</script>';
}
mysqli_free_result($verificar);