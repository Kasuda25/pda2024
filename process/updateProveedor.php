<?php
include '../Consultas/consultasSql.php';

$nitOldProveUp=consultas::clean_string($_POST['nit-prove-old']);
$nameProveUp=consultas::clean_string($_POST['prove-name']);
$dirProveUp=consultas::clean_string($_POST['prove-dir']);
$telProveUp=consultas::clean_string($_POST['prove-tel']);
$webProveUp=consultas::clean_string($_POST['prove-web']);

if(consultas::UpdateSQL("proveedor", "NombreProveedor='$nameProveUp',Direccion='$dirProveUp',Telefono='$telProveUp',PaginaWeb='$webProveUp'", "NITProveedor='$nitOldProveUp'")){
    echo '<script>
        swal({
          title: "Proveedor actualizado",
          text: "Los datos del proveedor se actualizaron correctamente",
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