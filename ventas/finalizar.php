<?php include '../config/sesion.php';
    $pagina=5;
    include 'clase.php';
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
</head>
<body class="theme-red">
    <!-- Loader -->
    <?php //include '../config/loader.php'; ?>
    <!-- Fin Loader -->
    <!-- Menu Superior -->
    <?php include '../config/menusuperior.php'; ?>
    <!-- Fin Menu Supeior -->
    <!-- Menu Principal -->
    <?php include '../config/menuprincipal.php'; ?>
    <!-- Fin Menu Principal -->
    
    <!-- Entorno de Trabajo -->
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>FINALIZAR VENTA</h2>
            </div>
            <div class="block-header">
                <a class="btn btn-primary" href="index.php?idFactura=<?php echo $_GET['idFactura']; ?>"><i class="material-icons">reply</i> REGRESAR</a>
            </div>
            <hr>
            <form id="formnuevo" action="finalizar.php" method="POST">
                <div class="row clearfix">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="idFactura">Nº Factura</label>
                            <input type="text" class="form-control font-bold font-20" id="idFactura" name="idFactura" value="<?php echo $_GET['idFactura'];?>" readonly="" >
                        </div>
                    </div>    
                </div>     
                <div class="row clearfix">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="idCliente">Cliente</label>
                            <select class="form-control" id="idCliente" name="idCliente" required="">
                                <option value="">Seleccionar</option>
                                <?php 
                                    $objetoCliente = new ventas();
                                    $objetoCliente->cliente();
                                ?>                       
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="idVendedor">Vendedor</label>
                            <select class="form-control" id="idVendedor" name="idVendedor" required="">
                                <option value="">Seleccionar</option>
                                <?php 
                                    $objetoVendedor = new ventas();
                                    $objetoVendedor->vendedor();
                                ?>
                            </select>
                        </div>
                    </div>
                </div>  
                <div class="row clearfix">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="condicionVenta">Condición Venta</label>
                            <select class="form-control" id="condicionVenta" name="condicionVenta" required="">
                                <option value="">Seleccionar</option>
                                 <?php                                 
                                $objetoOption = new ventas();
                                $objetoOption->selectTarjetas();
                               ?> 
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="comprobanteTarjeta">Nº Comprobante</label>
                            <input type="text" class="form-control font-bold font-20" id="comprobanteTarjeta" name="comprobanteTarjeta">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-20 font-bold" for="totalVenta">Total</label>
                            <input type="text" class="form-control font-bold font-20" id="totalVenta" name="totalVenta" value="<?php echo $_GET['totalVenta'];?>" readonly="" >
                        </div>
                    </div>
                </div>
                <input type="hidden" name="idRegistrante" value="<?php echo $_SESSION['idusu']; ?>"/>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Registar Venta">
                </div>
            </form>
            <?php
                if(!isset($_GET['idFactura'])){
                    if(isset($_POST['idFactura'])){
                        $objetoFactura= new ventas();
                        $objetoFactura->finalizarVenta($_POST['idFactura'],$_POST['idCliente'],$_POST['idVendedor'],
                                $_POST['condicionVenta'],$_POST['comprobanteTarjeta'],$_POST['totalVenta'],$_POST['idRegistrante']);
                        
                    }
                    
                }
            ?>
        </div>
    </section>
    <!-- Fin Entorno de Trabajo -->
    
    <!-- ARCHIVOS JS -->
    <?php include '../config/js.php'; ?>
    <!-- FIN ARCHIVOS JS -->
</body>

</html>
