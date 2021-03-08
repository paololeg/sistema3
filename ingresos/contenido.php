<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Egreso</title>
</head>
<body>
    <table style="width: 100%; height: 100px" border="0">
        <tbody>
            <tr>
                <input type="hidden" name="idEgreso" value="<?php echo $_GET['idEgreso']?>">
                <td style="width: 30%; height:100px" rowspan="2"><img src="agenciaj.jpg"/></td>
                <td style="width: 30%; text-align: center;"><strong>Agencia Viaja y Sueña</strong></td>
                <td style="width: 30%; text-align: right;"><strong>San Martin 385</strong></td>
            </tr>
            <tr>
                <td style="width: 30%; text-align: center;"><strong>CUIT 20330501848 </strong></td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%; margin-top: 10px;" border="0">
        <tbody>
            <tr>
                <td style="text-align: center;" colspan="2"><span style="font-size: large;"><strong>COMPROBANTE DE CAJA</strong></span></td>
            </tr>
            <tr>
                <td style="text-align: left;" colspan="2"><span style="font-size: medium;"><strong><strong><strong>&nbsp;</strong></strong></strong></span>&nbsp;   
                    <hr />
                </td>
            </tr>
            <?php
                  include 'clase.php';
                  if(!isset($_POST['descripcionEgreso'])){
                      $objetoDatos = new egresos();
                      $objetoDatos->datosImprimir($_GET['idEgreso']);                        
                  }  
            ?>
        </tbody>
    </table>    
</body>
</html>
