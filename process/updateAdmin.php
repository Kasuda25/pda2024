<?php
session_start();
include '../Consultas/consultasSql.php';

$code=consultas::clean_string($_POST['admin-code']);
$name=consultas::clean_string($_POST['admin-name']);
$nameold=consultas::clean_string($_POST['admin-name-old']);
$password1=consultas::clean_string($_POST['admin-pass1']);
$password2=consultas::clean_string($_POST['admin-pass2']);

$finalname=$nameold;
if($nameold!=$name){
	$verificar=ejecutar::consultar("SELECT * FROM administrador WHERE Nombre='".$name."'");
	if(mysqli_num_rows($verificar)<=0){
		$finalname=$name;
	}else{
	    echo '<script>swal("ERROR", "El nombre de usuario que acaba de ingresar ya se encuentra registrado, por favor elija otro", "error");</script>';
	    exit();
	}
}

if($password1!="" && $password2!=""){
	if($password1!=$password2){
		echo '<script>swal("ERROR", "Las contraseñas que acaba de ingresar no coinciden", "error");</script>';
		exit();
	}else{
		$finalPass=md5($password1);
		$campos="Nombre='$finalname',Clave='$finalPass'";
	}
}else{
	$campos="Nombre='$finalname'";
}


if(consultas::UpdateSQL("administrador", $campos, "id='$code'")){
    echo '<script>
        swal({
          title: "Administrador actualizado",
          text: "El administrador se actualizo con éxito",
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
    $_SESSION['nombreAdmin']=$finalname;
}else{
   echo '<script>swal("ERROR", "Ocurrió un error inesperado, por favor intente nuevamente", "error");</script>';
}
