<nav id="navbar-auto-hidden">
    <div class="row hidden-xs">
        <div class="col-xs-4">
            <p class="text-navbar tittles-pages-logo">Click&Shop</p>
        </div>
        <div class="col-xs-8">
            <div class="contenedor-tabla pull-right">
                <div class="contenedor-tr">
                    <a href="index.php" class="table-cell-td">Inicio</a>
                    <a href="productos.php" class="table-cell-td">Productos</a>
                    <?php if (isset($_SESSION['UserType'])): ?>
                        <?php if ($_SESSION['UserType'] === "Admin"): ?>
                            <a href="configAdmin.php" class="table-cell-td">Administración</a>
                            <a href="#!" class="table-cell-td exit-system">
                                <i class="fa fa-user"></i>&nbsp; <?= $_SESSION['nombreAdmin'] ?>
                            </a>
                        <?php elseif ($_SESSION['UserType'] === "User"): ?>
                            <a href="pedido.php" class="table-cell-td">Pedido</a>
                            <a href="#!" class="table-cell-td exit-system">
                                <i class="fa fa-user"></i>&nbsp; <?= $_SESSION['nombreUser'] ?>
                            </a>
                            <a href="#!" class="table-cell-td userConBtn" data-code="<?= $_SESSION['UserNIT'] ?>">
                                <i class="glyphicon glyphicon-cog"></i>
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="registro.php" class="table-cell-td">Registro</a>
                        <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-login">
                            <i class="fa fa-user"></i>&nbsp; Login
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</nav>
