<?php
session_start();
include '../Consultas/consultasSql.php';

$bancoCuenta=consultas::clean_string($_POST['bancoCuenta']);
$bancoNombre=consultas::clean_string($_POST['bancoNombre']);
$bancoBeneficiario=consultas::clean_string($_POST['bancoBeneficiario']);
$bancoTipo=consultas::clean_string($_POST['bancoTipo']);

if(consultas::InsertSQL("cuentabanco", "NumeroCuenta, NombreBanco, NombreBeneficiario, TipoCuenta", "'$bancoCuenta','$bancoNombre','$bancoBeneficiario','$bancoTipo'")){
  echo '<script>
    swal({
      title: "Cuenta agregada",
      text: "La cuenta bancaria se agregó con éxito",
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