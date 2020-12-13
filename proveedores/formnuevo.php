<?php include '../config/sesion.php';
    $pagina=9;
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
                <h3>Nuevo Movimiento </h3>
                <hr>
                <form action="formnuevo.php" method="POST" id="formnuevo"> 
                    <input type="hidden" name="idUsuario" value="<?php echo $_GET['idUsuario']?>">
                    <input type="hidden" name="proveedor" value="<?php echo $_GET['proveedor']?>">
                    <div class="row clearfix">
                        <div class="col-md-2">
                            <label for="tipomovimiento">Tipo Movimiento</label>
                            <select class="form-control show-tick" name="tipomovimiento" id="tipomovimiento" required="" onchange="carg(this);">
                                <option value="">-- Tipo Movimiento --</option>
                                <option value="1">Crédito</option>
                                <option value="2">Pago</option>
                            </select>
                        </div>  
                        <div class=" col-md-4">
                            <div class="form-group">
                                <label for="detalle">Detalle</label>
                                <input type="text" class="form-control" id="detalle" name="detalle" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="debe">Debe</label>
                                <input type="number" step="any" class="form-control" id="debe" name="debe" required="" placeholder="0.00">
                            </div>  
                        </div>   
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="haber">Haber</label>
                                <input type="number" step="any" class="form-control" id="haber" name="haber" required="" placeholder="0.00">
                            </div>
                        </div>                      
                    </div>                    
                    <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>
                    <a href="vercuentaprov.php?idUsuario=<?php echo $_GET['idUsuario'];?>&proveedor=<?php echo $_GET['proveedor'];?>" class="btn btn-danger">Cancelar</a>
                </form>
                <?php
                include 'clase.php';
                $objetoNuevo= new proveedores();
                if(isset ($_POST['idUsuario'])){
                    $objetoNuevo->guardar($_POST['idUsuario'],$_POST['proveedor'],$_POST['detalle'],$_POST['debe'],$_POST['haber']);
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Fin Entorno de Trabajo -->
    <script type="text/javascript"> 
         var debe = document.getElementById('debe');
         var haber = document.getElementById('haber');

         function carg(tipomovimiento) {
            d = tipomovimiento.value;  
            if(d == "1"){
            debe.disabled = false;    
            haber.disabled = true;
            }else if (d == "2"){
            debe.disabled = true;
            haber.disabled = false;
            }
        }
     </script>
    
    <!-- ARCHIVOS JS -->
    <?php include '../config/js.php'; ?>
    <!-- FIN ARCHIVOS JS -->
</body>

</html>
