<?php
    include 'clase.php';
    $objetoAgregarDetalle = new operaciones();
    $objetoAgregarDetalle->agregarDetalle($_POST['idProducto'],$_POST['cantidadProducto'],
                                            $_POST['idRegistrante'],$_POST['idOperacion']);
?>
