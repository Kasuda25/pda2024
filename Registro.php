<?php 
include './include/links.html'; 
include './include/navbar.php'; 
?>

<body id="container-page-registration">
  <section id="form-registration">
    <div class="container">
      <div class="page-header">
        <h1>REGISTRO</h1>
      </div>
      <p class="lead text-center">
        Gracias por registrarte en Click&Shop. ¡Esperamos que disfrutes de tus compras en nuestra tienda!
      </p>
      <div class="row">
        <div class="col-sm-5 text-center">
          <figure>
            <img src="./imagenes/img/registro.jpg" alt="E-market" class="img-responsive">
          </figure>
        </div>
        <div class="col-sm-7">
          <div id="container-form">
            <p class="text-center lead">Registro de Clientes</p>
            <form class="FormCatElec" action="process/regclien.php" role="form" method="POST" data-form="save">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12">
                    <legend><i class="fa fa-user"></i> &nbsp; Datos personales</legend>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp; Ingrese su número de DNI</label>
                      <input class="form-control" type="text" required name="clien-nit" pattern="[0-9]{1,15}" maxlength="15">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-user"></i>&nbsp; Ingrese sus nombres</label>
                      <input class="form-control" type="text" required name="clien-fullname" pattern="[a-zA-Z ]{1,50}" maxlength="50">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-user"></i>&nbsp; Ingrese sus apellidos</label>
                      <input class="form-control" type="text" required name="clien-lastname" pattern="[a-zA-Z ]{1,50}" maxlength="50">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-mobile"></i>&nbsp; Ingrese su número telefónico</label>
                      <input class="form-control" type="tel" required name="clien-phone" maxlength="15">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp; Ingrese su Email</label>
                      <input class="form-control" type="email" required name="clien-email" maxlength="50">
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-home"></i>&nbsp; Ingrese su dirección</label>
                      <input class="form-control" type="text" required name="clien-dir" maxlength="100">
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <legend><i class="fa fa-lock"></i> &nbsp; Datos de la cuenta</legend>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp; Ingrese su nombre de usuario</label>
                      <input class="form-control" type="text" required name="clien-name" pattern="[a-zA-Z0-9]{1,9}" maxlength="9">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-lock"></i>&nbsp; Introduzca una contraseña</label>
                      <input class="form-control" type="password" required name="clien-pass">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <div class="form-group label-floating">
                      <label class="control-label"><i class="fa fa-lock"></i>&nbsp; Repita la contraseña</label>
                      <input class="form-control" type="password" required name="clien-pass2">
                    </div>
                  </div>
                </div>
              </div>
              <p><button type="submit" class="btn btn-primary btn-block btn-raised">Registrarse</button></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <?php include './include/piedepagina.html'; ?>
</body>
