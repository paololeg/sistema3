<?php include '../config/sesion.php';
    $pagina=6;
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
                <h3>Modificar Tarjeta</h3>
                <hr>
                <form action="formmodificar.php" method="POST" id="formmodificar"> 
                    <input type="hidden" name="idTarjeta" value="<?php echo $_GET['idTarjeta']?>">
                    <?php
                        include 'clase.php';
                        if(!isset($_POST['nombreTarjeta'])){
                            $objetoDatos = new tarjetas();
                            $objetoDatos->datosModificar($_GET['idTarjeta']);                        
                        }                  
                    ?>
                    <button id="guardar" type="submit" class="btn btn-primary">Modificar</button>
                    <a href="index.php" class="btn btn-danger">Cancelar</a>                    
                </form>
                <?php
                    if(isset($_POST['nombreTarjeta'])){
                        $objetoModificar = new tarjetas();
                        $objetoModificar->confirmarModificacion($_POST['idTarjeta'],$_POST['nombreTarjeta'],$_POST['cuotas'],$_POST['interes']);
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
