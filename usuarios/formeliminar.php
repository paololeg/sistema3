<?php
    include 'clase.php';
    
    $objetoEliminar = new usuarios();
    $objetoEliminar->eliminarUsuario($_GET['idUsuario']);

?>

