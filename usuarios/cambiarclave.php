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
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Cambiar clave
                            </h2>                            
                        </div>
                        <div class="body">
                            <form action="cambiarclave.php" method="POST">
                                <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idusu']?>"
                                <br>
                                <label for="pass1">Clave actual</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="pass1" name="pass1" class="form-control" placeholder="Ingrese su clave actual" required="">
                                    </div>
                                </div>
                                <br>
                                 <label for="pass2">Clave nueva</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="pass2" name="pass2" class="form-control" placeholder="Ingrese su clave nueva" required="">
                                    </div>
                                </div>
                                <br>
                                 <label for="pass3">Confirmar clave nueva</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="pass3" name="pass3" class="form-control" placeholder="Repita su clave nueva" required="">
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-success m-t-15 waves-effect">Modificar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
           
                <?php
                    if(isset($_POST['idUsuario'])){                    
                        $objetoclave = new usuarios();
                        $objetoclave->cambiarClave($_POST['idUsuario'],$_POST['pass1'],$_POST['pass2'],$_POST['pass3']); 
                    }
                ?>   
        </div>
    </section>
    <!-- Fin Entorno de Trabajo -->
    
    <!-- ARCHIVOS JS -->
    <?php include '../config/js.php'; ?>
    <!-- FIN ARCHIVOS JS -->
</body>

</html>
