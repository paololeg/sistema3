<?php
    include 'clase.php';
    
    $objetoEliminar = new proveedores();
    $objetoEliminar->eliminarMovimiento($_GET['idCuentaProveedor'],$_GET['idUsuario'],$_GET['proveedor']);

?>

