<?php include '../config/sesion.php';
    $pagina=9;
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
</head>
<body class="theme-red">
    <!-- Loader -->
    <?php //include '../config/loader.php'; ?>
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
                <h2>CUENTA DE PROVEEDOR - <?php echo $_GET['proveedor'];?></h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>                                
                                <a href="formnuevo.php?idUsuario=<?php echo $_GET['idUsuario'];?>&proveedor=<?php echo $_GET['proveedor']; ?>" class="btn btn-primary  ">Nuevo Registro</a> 
                                <a href="index.php" class="btn btn-success m-r--30">Atrás</a> 
                            </h2>                           
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>FECHA</th>
                                        <th>DETALLE</th>
                                        <th>DEBE</th>
                                        <th>HABER</th>
                                        <th>SALDO</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        include 'clase.php'; 
                                        $objetoMostrar = new proveedores();                                          
                                        $objetoMostrar->mostrarCuentaProveedor($_GET['idUsuario']); 
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
