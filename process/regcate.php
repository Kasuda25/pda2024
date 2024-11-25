<?php
session_start();
include '../Consultas/consultasSql.php';

$codeCateg=consultas::clean_string($_POST['categ-code']);
$nameCateg=consultas::clean_string($_POST['categ-name']);
$descripCateg=consultas::clean_string($_POST['categ-descrip']);

$verificar=ejecutar::consultar("SELECT * FROM categoria WHERE CodigoCat='".$codeCateg."'");
if(mysqli_num_rows($verificar)<=0){
    if(consultas::InsertSQL("categoria", "CodigoCat, Nombre, Descripcion", "'$codeCateg','$nameCateg','$descripCateg'")){
        echo '<script>
            swal({
              title: "Categoría registrada",
              text: "La categoría se registró con éxito en el sistema",
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
    echo '<script>swal("ERROR", "El código que ha ingresado ya se encuentra registrado en el sistema, por favor verifique e intente nuevamente", "error");</script>';
}
mysqli_free_result($verificar);