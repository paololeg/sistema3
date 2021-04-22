<?php include '../config/sesion.php';
    $pagina=4;
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
</head>
<body class="theme-blue">
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
                <h3>Modificar Producto</h3>
                <hr>
                <form action="formmodificar.php" method="POST" id="formmodificar" enctype="multipart/form-data"> 
                    <input type="hidden" name="idProducto" value="<?php echo $_GET['idProducto']?>">
                    <?php
                        include 'clase.php';
                        if(!isset($_POST['nombreProducto'])){
                        $objetoDatos = new productos();
                        $objetoDatos->datosModificar($_GET['idProducto']);                        
                        }                  
                    ?>
                    <button id="guardar" type="submit" class="btn btn-primary">Modificar</button>
                    <a href="index.php?pagina=1" class="btn btn-danger">Cancelar</a>
                    
                </form>
                <?php
                    if(isset($_POST['nombreProducto'])){
                        $objetoModificar = new productos();
                        $objetoModificar->confirmarModificacion($_POST['idProducto'],$_POST['nombreProducto'],$_POST['descripcion'],$_POST['codigo'],
                                                                $_POST['cantidad'],$_POST['precioVenta'],$_POST['precioCompra'],$_POST['idCategoria']);
                        $ubicaciontemporal = $_FILES['foto']['tmp_name'];
                        if(move_uploaded_file($ubicaciontemporal,'fotos/'.$_POST['codigo'])){
                            echo "<script>alert('Producto Modificado');window.location.href='index.php?pagina=1'</script>";
                        }
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- Fin Entorno de Trabajo -->
    
    <!-- ARCHIVOS JS -->
    <?php include '../config/js.php'; ?>
    <!-- FIN ARCHIVOS JS -->
</body>

</html>
