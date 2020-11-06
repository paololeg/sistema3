<?php
    include 'clase.php';
    
    $objetoEliminar = new tarjetas();
    $objetoEliminar->eliminarTarjeta($_GET['idTarjeta']);

?>

