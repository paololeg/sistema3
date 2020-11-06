<?php include '../config/sesion.php';
      include 'clase.php';
    $pagina=2;
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
                <h3>Cambiar clave</h3>             
            </div>
            <div class="body table-responsive">
                <form action="cambiarclave.php" method="POST">
                    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idusu']?>"
                    <div class="form-inline col-sm-3">
                        <input type="text" class="form-control" name="pass1" placeholder="Ingrese su contraseña actual" required="">                        
                    </div> 
                    <div class="form-inline col-sm-3">
                        <input type="text" class="form-control" name="pass2" placeholder="Ingrese su contraseña nueva" required="">                        
                    </div> 
                    <div class="form-inline col-sm-3">
                        <input type="text" class="form-control" name="pass3" placeholder="Repita su contraseña nueva" required="">                        
                    </div> 
                    <div class="form-inline col-sm-3">
                        <button type="submit" class="btn btn-success waves-effect">Modificar</button>
                    </div>
                </form>
                <?php
                if(isset($_POST['idUsuario'])){                    
                    $objetoclave = new usuarios();
                    $objetoclave->cambiarClave($_POST['idUsuario'],$_POST['pass1'],$_POST['pass2'],$_POST['pass3']); 
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
