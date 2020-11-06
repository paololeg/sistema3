<?php include '../config/sesion.php';
    $pagina=9;
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
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
                <h3>Modificar Movimiento</h3>
                <hr>
                <form action="formmodificar.php" method="POST" id="formmodificar"> 
                    <input type="hidden" name="idCuentaProveedor" value="<?php echo $_GET['idCuentaProveedor']?>">
                    <input type="hidden" name="idUsuario" value="<?php echo $_GET['idUsuario']?>">
                    <input type="hidden" name="proveedor" value="<?php echo $_GET['proveedor']?>">
                    <?php
                        include 'clase.php';
                        if(!isset($_POST['idCuentaProveedor'])){
                        $objetoDatos = new proveedores();
                        $objetoDatos->datosmodificar($_GET['idCuentaProveedor']);                        
                        }                  
                    ?>
                    <button id="guardar" type="submit" class="btn btn-primary">Modificar</button>
                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                    
                </form>
                <?php
                    if(isset($_POST['idCuentaProveedor'])){
                        $objetoModificar = new proveedores();
                        $objetoModificar->confirmarmodificacion($_POST['idCuentaProveedor'],$_POST['idUsuario'],$_POST['proveedor'],$_POST['detalle'],
                                                                $_POST['debe'],$_POST['haber']);
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
