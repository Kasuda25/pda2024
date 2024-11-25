<<<<<<< HEAD
=======
<?php
?>
>>>>>>> efc062797bcf19337e6d130eaf7b3383252a82bd

<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li>
        <a href="configAdmin.php?view=provider">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Nuevo Proveedor
        </a>
    </li>
    <li>
        <a href="configAdmin.php?view=providerlist"><i class="fa fa-list-ol" aria-hidden="true"></i> &nbsp; Proveedores de la tienda</a>
    </li>
</ul>
<div class="container">
<<<<<<< HEAD
    <div class="row">
        <div class="col-xs-12">
            <div class="container-form-admin">
                <h3 class="text-primary text-center">Actualizar datos del proveedor</h3>
                <?php
                    $code=$_GET['code'];
                    $proveedor=ejecutar::consultar("SELECT * FROM proveedor WHERE NITProveedor='$code'");
                    $prov=mysqli_fetch_array($proveedor, MYSQLI_ASSOC);
                ?>
                <form action="process/updateProveedor.php" method="POST" class="FormCatElec" data-form="update">
                    <input type="hidden" name="nit-prove-old" value="<?php echo $prov['NITProveedor']; ?>">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">NIT/CEDULA</label>
                                    <input class="form-control" value="<?php echo $prov['NITProveedor']; ?>" type="text" name="prove-nit" readonly pattern="[0-9]{1,20}" maxlength="20" required="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre</label>
                                    <input class="form-control" type="text" value="<?php echo $prov['NombreProveedor']; ?>" name="prove-name" maxlength="30" required="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Dirección</label>
                                    <input class="form-control" type="text" value="<?php echo $prov['Direccion']; ?>" name="prove-dir" required="">
                                </div> 
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Teléfono</label>
                                    <input class="form-control" value="<?php echo $prov['Telefono']; ?>" type="tel" name="prove-tel" pattern="[0-9]{1,20}" maxlength="20" required="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Página Web (http://ejemplo.com)</label>
                                    <input class="form-control" value="<?php echo $prov['PaginaWeb']; ?>" type="url" name="prove-web">
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-center"><button type="submit" class="btn btn-primary btn-raised">Actualizar proveedor</button></p>
                </form>
            </div>
        </div>
    </div>
</div>
=======
	<div class="row">
		<div class="col-xs-12">
            <br><br>
            <div class="panel panel-info">
                <div class="panel-heading text-center"><h4>Proveedores de la tienda</h4></div>
              	<div class="table-responsive">
                  <table class="table table-striped table-hover">
                      	<thead>
                          	<tr>
								<th class="text-center">#</th>
                              	<th class="text-center">NIT</th>
                              	<th class="text-center">Nombre</th>
                              	<th class="text-center">Dirección</th>
                              	<th class="text-center">Telefono</th>
                              	<th class="text-center">Página web</th>
                              	<th class="text-center">Actualizar</th>
                              	<th class="text-center">Eliminar</th>
                          	</tr>
                      	</thead>
                      	<tbody>
                          	<?php
								$mysqli = mysqli_connect(SERVER, USER, PASS, BD);
								mysqli_set_charset($mysqli, "utf8");

								$pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
								$regpagina = 30;
								$inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

								$proveedores=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM proveedor LIMIT $inicio, $regpagina");

								$totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
								$totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

								$numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

								$cr=$inicio+1;
                                while($prov=mysqli_fetch_array($proveedores, MYSQLI_ASSOC)){
                            ?>
							<tr>
								<td class="text-center"><?php echo $cr; ?></td>
								<td class="text-center"><?php echo $prov['NITProveedor']; ?></td>
								<td class="text-center"><?php echo $prov['NombreProveedor']; ?></td>
								<td class="text-center"><?php echo $prov['Direccion']; ?></td>
								<td class="text-center"><?php echo $prov['Telefono']; ?></td>
								<td class="text-center"><?php echo $prov['PaginaWeb']; ?></td>
								<td class="text-center">
	                        		<a href="configAdmin.php?view=providerinfo&code=<?php echo $prov['NITProveedor']; ?>" class="btn btn-raised btn-xs btn-success">Actualizar</a>
	                        	</td>
	                        	<td class="text-center">
	                        		<form action="process/delprove.php" method="POST" class="FormCatElec" data-form="delete">
	                        			<input type="hidden" name="nit-prove" value="<?php echo $prov['NITProveedor']; ?>">
	                        			<button type="submit" class="btn btn-raised btn-xs btn-danger">Eliminar</button>	
	                        		</form>
	                        	</td>
							</td>
                            <?php
                            	$cr++;
                                }
                            ?>
                      	</tbody>
                  </table>
              	</div>
                <?php if($numeropaginas>=1): ?>
              	<div class="text-center">
                  <ul class="pagination">
                    <?php if($pagina == 1): ?>
                        <li class="disabled">
                            <a>
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="configAdmin.php?view=providerlist&pag=<?php echo $pagina-1; ?>">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>


                    <?php
                        for($i=1; $i <= $numeropaginas; $i++ ){
                            if($pagina == $i){
                                echo '<li class="active"><a href="configAdmin.php?view=providerlist&pag='.$i.'">'.$i.'</a></li>';
                            }else{
                                echo '<li><a href="configAdmin.php?view=providerlist&pag='.$i.'">'.$i.'</a></li>';
                            }
                        }
                    ?>
                    

                    <?php if($pagina == $numeropaginas): ?>
                        <li class="disabled">
                            <a>
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="configAdmin.php?view=providerlist&pag=<?php echo $pagina+1; ?>">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                  </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
	</div>
</div>
>>>>>>> efc062797bcf19337e6d130eaf7b3383252a82bd


