<?php
    include 'clase.php';
    
    $objetoEliminar = new categorias();
    $objetoEliminar->eliminarCategoria($_GET['idCategoria']);

?>

