<?php
include './Consultas/consultasSql.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <title>Admin</title>
  <?php include './include/links.html'; ?>
</head>

<body id="container-page-configAdmin">
  <?php include './include/navbar.php'; ?>
  <section id="prove-product-cat-config">
    <div class="container">
      <div class="page-header">
        <h1>Panel de administración </h1>
      </div>
      <ul class="nav nav-tabs nav-justified" style="margin-bottom: 15px;">
        <li>
          <a href="configAdmin.php?view=product">
            <i class="fa fa-cubes" aria-hidden="true"></i> &nbsp; Productos
          </a>
        </li>
        <li>
          <a href="configAdmin.php?view=provider">
            <i class="fa fa-truck" aria-hidden="true"></i> &nbsp; Proveedores
          </a>
        </li>
        <li>
          <a href="configAdmin.php?view=category">
            <i class="fa fa-shopping-basket" aria-hidden="true"></i> &nbsp; Categorías
          </a>
        </li>
        <li>
          <a href="configAdmin.php?view=admin">
            <i class="fa fa-users" aria-hidden="true"></i> &nbsp; Administradores
          </a>
        </li>
        <li>
          <a href="configAdmin.php?view=order">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp; Pedidos
          </a>
        </li>
        <li>
          <a href="configAdmin.php?view=bank">
            <i class="fa fa-university" aria-hidden="true"></i> &nbsp; Cuenta bancaria
          </a>
        </li>
        <li>
          <a href="configAdmin.php?view=account">
            <i class="fa fa-address-card" aria-hidden="true"></i> &nbsp; Mi cuenta
          </a>
        </li>
        <li>
          <a href="configAdmin.php?view=client">
            <i class="fa fa-user" aria-hidden="true"></i> &nbsp; Clientes
          </a>
        </li>
        <li>
          <a href="configAdmin.php?view=clientlist">
            <i class="fa fa-users" aria-hidden="true"></i> &nbsp; Lista de Clientes
          </a>
        </li>
      </ul>
      <?php
      $content = $_GET['view'];
      $WhiteList = ["product", "productlist", "productinfo", "provider", "providerlist", "providerinfo", "category", "categorylist", "categoryinfo", "admin", "adminlist", "order", "bank", "account", "client", "clientlist"];
      if (isset($content)) {
        if (in_array($content, $WhiteList)) {
          $htmlFile = "./admin/" . $content . "-view.html";
          $phpFile = "./admin/" . $content . "-view.php";
          if (is_file($htmlFile)) {
            include $htmlFile;
          } elseif (is_file($phpFile)) {
            include $phpFile;
          } else {
            echo '<h2 class="text-center">Lo sentimos, la opción que ha seleccionado no se encuentra disponible</h2>';
          }
        } else {
          echo '<h2 class="text-center">Lo sentimos, la opción que ha seleccionado no se encuentra disponible</h2>';
        }
      } else {
        echo '<h2 class="text-center">Para empezar, por favor escoja una opción del menú de administración</h2>';
      }
      ?>
    </div>
  </section>
  <?php include './include/piedepagina.html'; ?>
</body>

</html>