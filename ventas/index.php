<?php 
    include '../config/sesion.php';
    $pagina=5;
    include 'clase.php';
    if(isset($_POST['buscar'])) {
        $objetoCargar = new ventas();
        $objetoCargar->detallesNuevaVenta($_POST['buscar'], $_POST['idRegistrante'], $_POST['idFactura']);
    }
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
</head>
<body class="theme-red">
    <!-- Loader -->
    <?php include '../config/loader.php'; ?>
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
                <h2>NUEVA VENTA</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div>                                
                                <form action="index.php" method="POST">
                                    <div class="col-sm-3"> 
                                        <input type="text" class="form-control col-sm-3" name="buscar" placeholder="INGRESAR CÓDIGO" autofocus="autofocus" required="">
                                        <input type="hidden" name="idFactura" value="<?php echo $_GET['idFactura']; ?>">
                                        <input type="hidden" name="idRegistrante" value="<?php echo $_SESSION['idusu']; ?>">      
                                    </div>                                      
                                    <div class="col-sm-3">
                                        <button class="btn btn-success" type="submit">Buscar</button>
                                    </div>
                                </form>
                                <a class="btn btn-danger" onclick="return confirm('¿Desea cancelar la venta?')" href="cancelar.php?idFactura=<?php echo $_GET['idFactura'] ; ?>">Cancelar Venta</a>
                                 <hr>  
                                 <h2>FACTURA Nº<?php echo $_GET['idFactura'];?></h2>
                            </div>                           
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Producto</th> 
                                        <th>Cantidad</th> 
                                        <th>Precio</th> 
                                        <th>Subtotal</th>                                         
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                         $objetoMostrarDetalles = new ventas();
                                         $objetoMostrarDetalles->mostrarDetalles($_GET['idFactura']);
                                    ?>                                                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fin Entorno de Trabajo -->
    
    <!-- ARCHIVOS JS -->
    <?php include '../config/js.php'; ?>
    <!-- FIN ARCHIVOS JS -->
</body>

</html>
