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
                <h3>Modificar Ingreso</h3>
                
                    <input type="text" name="idIngreso" value="<?php echo $_GET['idIngreso']?>">
                <hr>
                <form action="formmodificaringreso.php" method="POST" id="formmodificar"> 
                    <?php
                        
                        if(isset($_GET['idIngreso'])){
                           $objetoMostrar = new Caja();
                           $objetoMostrar->mostrarIngresos($_GET['idIngreso']); 
                        }                       
                                        
                    ?>
                    <button id="guardar" type="submit" class="btn btn-primary">Modificar</button>
                    <a href="ultimacaja.php" class="btn btn-danger">Cancelar</a>                    
                </form>
               
            </div>
        </div>
    </section>
    <!-- Fin Entorno de Trabajo -->
    
    <!-- ARCHIVOS JS -->
    <?php include '../config/js.php'; ?>
    <!-- FIN ARCHIVOS JS -->
</body>

</html>
