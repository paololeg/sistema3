<?php include '../config/sesion.php';
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
                <h3>Modificar Usuario</h3>
                <hr>
                <form action="formmodificar.php" method="POST" id="formmodificar"> 
                    <input type="hidden" name="idusuario" value="<?php echo $_GET['idUsuario']?>">
                    <?php
                        include 'clase.php';
                        if(!isset($_POST['usuario'])){
                        $objetoDatos = new usuarios();
                        $objetoDatos->datosmodificar($_GET['idUsuario']);                        
                        }                  
                    ?>
                    <button id="guardar" type="submit" class="btn btn-primary">Modificar</button>
                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                    
                </form>
                <?php
                    if(isset($_POST['usuario'])){
                        $objetoModificar = new usuarios();
                        $objetoModificar->confirmarmodificacion($_POST['usuario'],$_POST['apellido'],$_POST['nombre'],
                                                                $_POST['dni'],$_POST['email'],$_POST['nacimiento'],
                                                                $_POST['domicilio'],$_POST['localidad'],$_POST['provincia'],
                                                                $_POST['nacionalidad'],$_POST['telefono'],$_POST['sexo'],
                                                                $_POST['privilegio'],$_POST['idusuario'],$_POST['edad']);
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
