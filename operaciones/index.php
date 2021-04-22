<?php 
    include '../config/sesion.php';
    $pagina=11;
    include 'clase.php';
    if($_SESSION['rol']==3) {
        header('location:../acceso/plantilla.php');   
    }
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
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
                <h2>OPERACIONES</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div>                                
                                <form action="index.php" method="POST">
                                    <div class="col-sm-3"> 
                                        <input type="text" class="form-control col-sm-3" name="buscar" placeholder="Ingresar número" autofocus="autofocus" required="">                                        
                                        <input type="hidden" name="idRegistrante" value="<?php echo $_SESSION['idusu']; ?>">      
                                    </div>                                      
                                    <div class="col-sm-3">
                                        <button class="btn btn-primary" type="submit">Buscar</button>
                                    </div>
                                </form>
                                <a class="btn btn-success"  href="iniciaroperacion.php">Nueva Operación</a>
                            </div>                           
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Operación</th>
                                        <th>Cliente</th> 
                                        <th>Pax</th> 
                                        <th>Salida</th> 
                                        <th>Venta</th> 
                                        <th>Costo</th>                                         
                                        <th>Estado</th>  
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $objetoMostrarOperaciones = new operaciones();
                                        $objetoMostrarOperaciones->mostrarOperaciones();
                                    ?>                                                                    
                                </tbody>
                            </table>
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
