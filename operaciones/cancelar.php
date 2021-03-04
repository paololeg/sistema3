<?php
    include 'clase.php';
    $objetoCancelar = new ventas();
    $objetoCancelar->cancelar($_GET['idFactura']);

?>

