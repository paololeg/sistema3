<?php  
    include '../config/sesion.php';
    include 'clase.php';
    $pagina=10;
 ?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
</head>
<body class="theme-blue">
    <!-- Loader -->
    <?php // include '../config/loader.php'; ?>
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <h1 class="bg-primary">INFORMES ESTADISTICOS</h1>
                            
                            
                            
                            <div class="card bg-brown" style="width: 300px; display: inline-table;">
                                <div class="header text-center">
                                    <h2>Cantidad de Productos</h2>
                                </div>
                                <div class="body">
                                    <h3 class="col-white text-center">
                                        <?php
                                        $objetoCantidadProductos = new dashboard();
                                        $objetoCantidadProductos->totalproductos();
                                        ?>
                                    </h3>
                                </div>
                                <div class="footer">
                                    <a class="btn btn-success btn-block" href="resultados.php?informe=2">Ver Resultados</a>
                                </div>
                            </div>
                            
                            <div class="card bg-deep-orange" style="width: 300px; display: inline-table;">
                                <div class="header text-center">
                                    <h2>Cantidad de Ventas</h2>
                                </div>
                                <div class="body">
                                    <h3 class="col-white text-center">
                                         <?php
                                        $objetoCantidadVentas = new dashboard();
                                        $objetoCantidadVentas->totalventas();
                                        ?>
                                    </h3>
                                </div>
                                <div class="footer">
                                    <a class="btn btn-success btn-block" href="resultados.php?informe=3">Ver Resultados</a>
                                </div>
                            </div>
                            
                            <div class="card bg-red" style="width: 300px; display: inline-table;">
                                <div class="header text-center">
                                    <h2>Cantidad de Productos Agotados</h2>
                                </div>
                                <div class="body">
                                    <h3 class="col-white text-center">
                                         <?php
                                        $objetoCantidadProductosA = new dashboard();
                                        $objetoCantidadProductosA->totalproductosagotados();
                                        ?>
                                    </h3>
                                </div>
                                <div class="footer">
                                    <a class="btn btn-success btn-block" href="resultados.php?informe=5">Ver Resultados</a>
                                </div>
                            </div>
                            
                            <div class="card bg-black" style="width: 300px; display: inline-table;">
                                <div class="header text-center">
                                    <h2>Cantidad de con Stok Bajo</h2>
                                </div>
                                <div class="body">
                                    <h3 class="col-white text-center">
                                         <?php
                                        $objetoCantidadProductosM = new dashboard();
                                        $objetoCantidadProductosM->totalproductosminimo();
                                        ?>
                                    </h3>
                                </div>
                                <div class="footer">
                                    <a class="btn btn-success btn-block" href="resultados.php?informe=6">Ver Resultados</a>
                                </div>
                            </div>
                            
                            <div class="card bg-blue" style="width: 300px; display: inline-table;">
                                <div class="header text-center">
                                    <h2>Productos mas vendidos</h2>
                                </div>
                                <div class="body">
                                    <h3 class="col-white text-center">
                                        55
                                    </h3>
                                </div>
                                <div class="footer">
                                    <a class="btn btn-success btn-block" href="resultados.php?informe=7">Ver Resultados</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Basic Example -->
            </div>
        </div>
    </section>
    <!-- Fin Entorno de Trabajo -->
    
    <!-- ARCHIVOS JS -->
    <?php include '../config/js.php'; ?>
    <!-- FIN ARCHIVOS JS -->
</body>

</html>
