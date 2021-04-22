<?php
    require 'modelografico.php';
    
    $MG = new modeloGrafico();
    $consulta = $MG->traerDatosGraficoBar();
    echo json_encode($consulta);
    
?> 

