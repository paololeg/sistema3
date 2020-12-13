<?php
    include_once "../dompdf/autoload.inc.php";
    use Dompdf\Dompdf;

    ob_start();
        include_once "contenido.php";
    $html=ob_get_clean();
   
    
    $pdf = new Dompdf();
    $pdf->loadHtml($html);
    // portrait es orientación vertical y landscape es horizontal
    $pdf->setPaper("A4","portrait");
    $pdf->render();
    $pdf->stream();        

?>

