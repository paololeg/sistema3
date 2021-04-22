<?php include '../config/sesion.php';
    $pagina=10;
   include 'clase.php';
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
                <h2>Modificar Liquidación</h2>
            </div> 
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header"> 
                            <form id="formmodificar" action="formmodificar.php" method="POST">                                              
                                <input type="hidden" name="idSueldo" value="<?php echo $_GET['idSueldo']?>">
                                <input type="hidden" id="anioSueldo" name="anioSueldo" value="<?php echo $_GET['anioSueldo']?>" required="">
                                <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $_GET['idUsuario']?>" required="" >
                                <?php        
                                    if(!isset($_POST['mesSueldo'])){
                                    $objetoDatos = new Sueldo();
                                    $objetoDatos->datosModificar($_GET['idSueldo']);
                                    }
                                ?>                            
                                
                            </form>
                             <?php       
                                if(isset($_POST['mesSueldo'])){  
                                $objetoModificar = new Sueldo();    
                                $objetoModificar->confirmarModificacion($_POST['idSueldo'],$_POST['diasTrabajados'],$_POST['basico'],$_POST['obraSocial'],
                                                                                    $_POST['antiguedad'],$_POST['diasFeriados'],$_POST['feriadosTrabajados'],
                                                                                    $_POST['feriadosNoTrabajados'],$_POST['fecha'],$_POST['mesSueldo'],
                                                                                    $_POST['anioSueldo'],$_POST['idUsuario']); 
                               }
                            ?>
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
