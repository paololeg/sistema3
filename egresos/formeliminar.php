<?php
    include 'clase.php';
    
    $objetoEliminar = new egresos();
    $objetoEliminar->eliminarEgreso($_GET['idEgreso']);

?>

