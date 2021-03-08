<?php 
    include '../config/sesion.php';
    include 'clase.php';
    $pagina=8;
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
                 <h2><b>CAJA - <?php echo $_GET['idCaja']?></b></h2>
                 <a class="btn btn-primary" href="iniciar.php">Iniciar Caja</a>
            </div> 
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="body table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="5">INGRESOS</th>
                                            <th class="text-center">
                                                <a class="btn btn-primary" href="formnuevoingreso.php?idCaja=<?php echo $_GET['idCaja']?>">Nuevo Ingreso</a>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Tipo</th>
                                            <th>Valor</th>
                                            <th>Detalle</th>
                                            <th>Importe</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $objetoMostrarIngresos = new Caja();
                                            $objetoMostrarIngresos->mostrarIngresos($_GET['idCaja']);
                                        ?>
                                        
                                        
                                    </tbody>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr><th colspan="6">EGRESOS</th></tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Valor</th>
                                            <th>Detalle</th>
                                            <th>Importe</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
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
