<!DOCTYPE html>
<html lang="es">

<head>
  <title>Pedido</title>
  <?php include './include/links.html'; ?>
</head>

<body id="container-page-index">
  <?php include './include/navbar.php'; ?>
  <section id="container-pedido">
    <div class="container">
      <div class="page-header">
        <h1>PEDIDOS </h1>
      </div>
      <br><br><br>
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
          <?php
          require_once "./Consultas/consultasSql.php";
          if ($_SESSION['UserType'] == "Admin" || $_SESSION['UserType'] == "User") {
            if (isset($_SESSION['carro'])) {
              ?>
              <br><br><br>
              <div class="container-fluid">
                <?php
                session_start();
                include '../Consultas/consultasSql.php';

                $suma = 0;
                if (!empty($_SESSION['carro'])) {
                  foreach ($_SESSION['carro'] as $codess) {
                    $consulta = ejecutar::consultar("SELECT * FROM producto WHERE CodigoProd='" . $codess['producto'] . "'");
                    while ($fila = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
                      $tp = number_format($fila['Precio'] - ($fila['Precio'] * ($fila['Descuento'] / 100)), 2, '.', '');
                      $suma += $tp * $codess['cantidad'];
                    }
                    mysqli_free_result($consulta);
                  }
                } else {
                  $suma = 0;
                }
                ?>

                <div class="container-fluid">
                  <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                      <p class="text-center lead">Selecciona un método de pago</p>
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th class="text-center">Método de Pago</th>
                            <th class="text-center">Valor a Pagar</th>
                            <th class="text-center">Acción</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-center">
                              <p>Transacción Bancaria</p>
                              <img class="img-responsive center-all-contens" src="./imagenes/img/credit-card (3).png"
                                alt="Credit Card">
                            </td>
                            <td class="text-center">
                              <?php echo '$' . number_format($suma, 2); ?>
                            </td>
                            <td class="text-center">
                              <button class="btn btn-lg btn-raised btn-success" data-toggle="modal"
                                data-target="#PagoModalTran">Seleccionar</button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <?php
            } else {
              echo '<p class="text-center lead">No tienes pedidos pendientes de pago</p>';
            }
          } else {
            echo '<p class="text-center lead">Inicia sesión para realizar pedidos</p>';
          }
          ?>
          </div>
        </div>
      </div>
      <?php
      if ($_SESSION['UserType'] == "User") {
        $consultaC = ejecutar::consultar("SELECT * FROM venta WHERE NIT='" . $_SESSION['UserNIT'] . "'");
        ?>
        <div class="container" style="margin-top: 70px;">
          <div class="page-header">
            <h1>Mis pedidos</h1>
          </div>
        </div>
        <?php
        if (mysqli_num_rows($consultaC) >= 1) {
          ?>
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <table class="table table-hover table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Total</th>
                      <th>Estado</th>
                      <th>Envío</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($rw = mysqli_fetch_array($consultaC, MYSQLI_ASSOC)) {
                      ?>
                      <tr>
                        <td><?php echo $rw['Fecha']; ?></td>
                        <td>$<?php echo $rw['TotalPagar']; ?></td>
                        <td>
                          <?php
                          switch ($rw['Estado']) {
                            case 'Enviado':
                              echo "En camino";
                              break;
                            case 'Pendiente':
                              echo "En espera";
                              break;
                            case 'Entregado':
                              echo "Entregado";
                              break;
                            case 'Cancelado':
                              echo "Cancelado";
                              break;
                            default:
                              echo "Sin informacion";
                              break;
                          }
                          ?>
                        <td><?php echo $rw['TipoEnvio']; ?></td>
                        <td><a href="report\factura.php?id=<?php echo $order['NumPedido']; ?>"
                            class="btn btn-raised btn-xs btn-primary btn-block" target="_blank">Imprimir Recibo</a></td>
                      </tr>
                      <?php
                    }
                    ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php
        } else {
          echo '<p class="text-center lead">No tienes ningun pedido realizado</p>';
        }
        mysqli_free_result($consultaC);
      }
      ?>
  </section>
  <div class="modal fade" id="PagoModalTran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <form class="modal-content FormCatElec" action="process/confirmcompra.php" method="POST" role="form"
        data-form="save">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Pago por transaccion bancaria</h4>
        </div>
        <div class="modal-body">

          <?php
          $consult1 = ejecutar::consultar("SELECT * FROM cuentabanco");
          if (mysqli_num_rows($consult1) >= 1) {
            $datBank = mysqli_fetch_array($consult1, MYSQLI_ASSOC);
            ?>
            <p>Por favor haga el deposito en la siguiente cuenta de banco e ingrese el numero de deposito que se le
              proporciono.</p><br>
            <p>
              <strong>Nombre del banco:</strong> <?php echo $datBank['NombreBanco']; ?><br>
              <strong>Numero de cuenta:</strong> <?php echo $datBank['NumeroCuenta']; ?><br>
              <strong>Nombre del beneficiario:</strong> <?php echo $datBank['NombreBeneficiario']; ?><br>
              <strong>Tipo de cuenta:</strong> <?php echo $datBank['TipoCuenta']; ?><br><br>
            </p>
            <?php if ($_SESSION['UserType'] == "Admin"): ?>
              <div class="form-group">
                <label>Numero de deposito</label>
                <input class="form-control" type="text" name="NumDepo" placeholder="Numero de deposito" maxlength="50"
                  required="">
              </div>
              <div class="form-group">
                <span>Tipo De Envio</span>
                <select class="form-control" name="tipo-envio" data-toggle="tooltip" data-placement="top"
                  title="Elige El Tipo De Envio">
                  <option value="" disabled="" selected="">Selecciona una opción</option>
                  <option value="Recoger Por Tienda">Recoger Por Tienda</option>
                  <option value="Envio Por Currier">Envio Gratis</option>
                </select>
              </div>
              <div class="form-group">
                <label>DNI del cliente</label>
                <input class="form-control" type="text" name="Cedclien" placeholder="DNI del cliente" maxlength="15"
                  required="">
              </div>
              <div class="form-group">
                <input type="file" name="comprobante">
                <div class="input-group">
                  <input type="text" readonly="" class="form-control" placeholder="Seleccione la imagen del comprobante...">
                  <span class="input-group-btn input-group-sm">
                    <button type="button" class="btn btn-fab btn-fab-mini">
                      <i class="fa fa-file-image-o" aria-hidden="true"></i>
                    </button>
                  </span>
                </div>
                <p class="help-block"><small>Tipos de archivos admitidos, imagenes .jpg y .png. Maximo 5 MB</small></p>
              </div>
            <?php else: ?>
              <div class="form-group">
                <label>Numero de deposito</label>
                <input class="form-control" type="text" name="NumDepo" placeholder="Numero de deposito" maxlength="50"
                  required="">
              </div>
              <div class="form-group">
                <span>Tipo De Envio</span>
                <select class="form-control" name="tipo-envio" data-toggle="tooltip" data-placement="top"
                  title="Elige El Tipo De Envio">
                  <option value="" disabled="" selected="">Selecciona una opción</option>
                  <option value="Recoger Por Tienda">Recoger Por Tienda</option>
                  <option value="Envio Por Currier">Envio Gratis</option>
                </select>
              </div>
              <input type="hidden" name="Cedclien" value="<?php echo $_SESSION['UserNIT']; ?>">
              <div class="form-group">
                <input type="file" name="comprobante" required>
                <div class="input-group">
                  <input type="text" readonly="" class="form-control" placeholder="Seleccione la imagen del comprobante...">
                  <span class="input-group-btn input-group-sm">
                    <button type="button" class="btn btn-fab btn-fab-mini">
                      <i class="fa fa-file-image-o" aria-hidden="true"></i>
                    </button>
                  </span>
                </div>
                <p class="help-block"><small>Tipos de archivos admitidos, imagenes.jpg y.png. Maximo 5 MB</small></p>
              </div>
              <?php
            endif;
          } else {
            echo "Ocurrio un error: Parese ser que no se ha configurado las cuentas de banco";
          }
          mysqli_free_result($consult1);
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm btn-raised" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary btn-sm btn-raised">Confirmar</button>
        </div>
      </form>
    </div>
  </div>
  <div class="ResForm"></div>
  <?php include './include/piedepagina.html'; ?>
</body>

</html>