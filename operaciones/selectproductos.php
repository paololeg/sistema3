<?php
    include 'clase.php';
    $objetoMostrarProductos = new operaciones();
    $objetoMostrarProductos->mostrarProductos($_POST['idCategoria']);
?>

