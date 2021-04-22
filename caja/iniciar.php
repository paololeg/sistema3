<?php include '../config/sesion.php';
    $pagina=8;
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
</head>
<body class="theme-blue">
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
                 <h2>INICIAR CAJA</h2>
            </div> 
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <form id="formnuevo" action="iniciar.php" method="GET">
                                <div class="form-group">
                                    <label for="importeCaja">Saldo Inicial</label>
                                    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idusu'];?>">
                                    <input type="number" step="any" class="form-control" id="importeCaja" name="importeCaja" required="">
                                </div>
                                <div class="form-group">                                
                                    <button class="btn btn-primary" type="submit">Registrar</button>
                                    <a class="btn btn-danger" href="ultimacaja.php">Cancelar</a>
                                </div>
                            </form> 
                            <?php
                                include 'clase.php';
                                if(isset($_GET['importeCaja'])){                                 
                                    $objetoIniciar= new Caja();
                                    $objetoIniciar->iniciarCaja($_GET['importeCaja'], $_GET['idUsuario']);   
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
