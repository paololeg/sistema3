<?php
    include 'clase.php';
    
    $objetoEliminar = new productos();
    $objetoEliminar->eliminarProducto($_GET['idProducto']);

?>

