<?php include '../config/sesion.php';
    $pagina=3;
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
                <h3>Modificar Categoría</h3>
                <hr>
                <form action="formmodificar.php" method="POST" id="formmodificar"> 
                    <input type="hidden" name="idCategoria" value="<?php echo $_GET['idCategoria']?>">
                    <?php
                        include 'clase.php';
                        if(!isset($_POST['categoria'])){
                            $objetoDatos = new categorias();
                            $objetoDatos->datosModificar($_GET['idCategoria']);                        
                        }                  
                    ?>
                    <button id="guardar" type="submit" class="btn btn-primary">Modificar</button>
                    <a href="index.php?pagina=1" class="btn btn-danger">Cancelar</a>                    
                </form>
                <?php
                    if(isset($_POST['categoria'])){
                        $objetoModificar = new categorias();
                        $objetoModificar->confirmarModificacion($_POST['idCategoria'],$_POST['categoria']);
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
