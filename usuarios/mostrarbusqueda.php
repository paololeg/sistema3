<?php
    include 'clase.php';
    $objetoMostrarBusqueda = new usuarios();
    $objetoMostrarBusqueda->resultados($_GET['busqueda']);
?>
