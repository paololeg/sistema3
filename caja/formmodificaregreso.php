<?php include '../config/sesion.php';
    $pagina=8;
    include 'clase.php';
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
</head>
<body class="theme-red">
    <!-- Loader -->
    <?php// include '../config/loader.php'; ?>
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
                <h3>Modificar Egreso</h3>
                
                <hr>
                <form action="formmodificaregreso.php" method="POST" id="formmodificar"> 
                    <input type="hidden" name="idEgreso" value="<?php echo $_GET['idEgreso']?>">
                    <?php
                        
                        if(isset($_GET['idEgreso'])){
                           $objetoMostrar = new Caja();
                           $objetoMostrar->modificarEgreso($_GET['idEgreso']); 
                        }                       
                                        
                    ?>
                    <button id="guardar" type="submit" class="btn btn-primary">Modificar</button>
                    <a href="ultimacaja.php" class="btn btn-danger">Cancelar</a>                    
                </form>
                <?php
                    if(isset($_POST['importeEgreso'])){
                        $objetoModificar = new Caja();
                        $objetoModificar->confirmarModificacionEgreso($_POST['idEgreso'],$_POST['tipoEgreso'],
                                $_POST['importeEgreso'],$_POST['descripcionEgreso']
                                ,$_POST['moneda'],$_POST['tipoValor']);
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
