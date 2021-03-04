<?php 
    include '../config/sesion.php';
    $pagina=11;
    include 'clase.php';
    if(isset($_POST['buscar'])) {
        $objetoCargar = new operaciones();
        $objetoCargar->detallesNuevaOperacion($_POST['buscar'], $_POST['idRegistrante'], $_POST['idOperacion']);
    }
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
                <h2>NUEVA OPERACIÓN</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div>                                
                                <form action="formnuevo.php" method="POST">
                                    <div class="col-sm-3"> 
                                        <input type="hidden" name="idOperacion" value="<?php echo $_GET['idOperacion']; ?>">
                                        <input type="text" class="form-control col-sm-3" name="buscar" placeholder="Ingresar código de servicio" autofocus="autofocus" required="">                                        
                                        <input type="hidden" name="idRegistrante" value="<?php echo $_SESSION['idusu']; ?>">      
                                    </div>                                      
                                    <div class="col-sm-2">
                                        <button class="btn btn-primary" type="submit">Buscar</button>
                                    </div>
                                </form> 
                                <div class="row">
                                    <select class="col-lg-4">
                                         <option value="">--Cliente--</option> 
                                        <?php                                      
                                         $objetoOption = new operaciones();
                                         $objetoOption->selectCliente();
                                        ?>
                                    </select> 
                                    <a class="btn btn-primary m-l-15"  href="nuevaoperacion.php">Guardar</a>
                                </div>
                                <br>
                                <div class="form-horizontal p-l-5">                                   
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="pax">Cantidad Pax</label>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="number" id="pax" class="form-control" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="descripcion">Descripción</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="descripcion" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <hr> 
                            </div>                           
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Producto</th> 
                                        <th>Cantidad</th> 
                                        <th>Venta Unitaria</th> 
                                        <th>Costo Unitario</th>
                                        <th>Subtotal Venta</th>  
                                        <th>Subtotal Costo</th>  
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(isset($_GET['idOperacion'])){
                                            $objetoMostrarDetalles = new operaciones();
                                            $objetoMostrarDetalles->mostrarDetalles($_GET['idOperacion']);
                                        }                                         
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
