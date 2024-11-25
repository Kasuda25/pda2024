<?php
session_start();
if(isset($_POST['codigo'])){
    $codigo = $_POST['codigo'];
    foreach($_SESSION['carro'] as $indice => $producto){
        if($producto['producto'] == $codigo){
            unset($_SESSION['carro'][$indice]);
            $_SESSION['carro'] = array_values($_SESSION['carro']); // Reindexar el array
            break;
        }
    }
    echo '<script>window.location.href = "./carrito.php";</script>';
} else {
    echo '<script>alert("No se pudo eliminar el producto. Inténtelo de nuevo."); window.location.href = "./carrito.php";</script>';
}