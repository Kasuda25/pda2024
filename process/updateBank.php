<?php
session_start();
include '../Consultas/consultasSql.php';

$id=consultas::clean_string($_POST['id']);
$bancoCuenta=consultas::clean_string($_POST['bancoCuenta']);
$bancoNombre=consultas::clean_string($_POST['bancoNombre']);
$bancoBeneficiario=consultas::clean_string($_POST['bancoBeneficiario']);
$bancoTipo=consultas::clean_string($_POST['bancoTipo']);

if(consultas::UpdateSQL("cuentabanco", "NumeroCuenta='$bancoCuenta', NombreBanco='$bancoNombre', NombreBeneficiario='$bancoBeneficiario', TipoCuenta='$bancoTipo'", "id='$id'")){
  echo '<script>
  swal({
    title: "Cuenta actualizada",
    text: "La cuanta bancaria se actualizo con exito",
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
  echo '<script>swal("ERROR", "Ocurrio un error inesperado", "error");</script>';
}
