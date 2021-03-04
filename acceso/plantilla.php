<?php include '../config/sesion.php';
    $pagina=1;
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
   
</head>
<body class="theme-blue">
    <!-- Loader -->
    <?php //include '../config/loader.php'; ?>
    <!-- Fin Loader -->
    <!-- Menu Superior -->
    <?php include '../config/menusuperior.php'; ?>
    <!-- Fin Menu Supeior -->
    <!-- Menu Principal -->
    <?php include '../config/menuprincipal.php'; ?>
    <!-- Fin Menu Principal -->
    <?php include '../dashboard/clase.php'; ?>
    <!-- Entorno de Trabajo -->
        <!-- COMIENZO INFOBOX -->
        <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    DASHBOARD
                </h2>
            </div>
            <!-- Counter Examples -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <div class="icon bg-red">
                            <i class="material-icons">shopping_cart</i>
                        </div>
                        <div class="content">
                            <div class="text">VENTAS DEL MES</div>
                            <div class="number count-to" 
                                 data-from="0" 
                                 data-to="<?php 
                                            $objetoMostrar = new dashboard();     
                                            $objetoMostrar->totalventasnum();                                           
                                            ?>" 
                                 data-speed="1000" 
                                 data-fresh-interval="20"
                            >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <div class="icon bg-orange">
                            <span class="chart chart-line">9,4,6,5,6,4,7,3</span>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL VENTAS MES</div>
                            <div class="number count-to" 
                                 data-from="0" 
                                 data-to="<?php 
                                                $objetoMostrar = new dashboard();     
                                                $objetoMostrar->totalventas();
                                            ?>" 
                                 data-speed="1000" 
                                 data-fresh-interval="20"
                            ><span>$</span> <?php 
                                  // $objetoMostrar->totalventas() ;  NO PUEDO MOSTRAR SIGNO PESOS                                        
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <div class="icon bg-purple">
                            <i class="material-icons">bookmark</i>
                        </div>
                        <div class="content">
                            <div class="text">PRÓXIMAS SALIDAS</div>
                            <div class="number count-to" data-from="0" data-to="117" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-cyan">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="content">
                            <div class="text">DESTINOS MÁS VENDIDOS</div>
                            <div class="number"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Counter Examples -->
            <!-- Hover Zoom Effect -->            
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box hover-expand-effect">
                        <div class="icon bg-teal">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL COBRADO</div>
                            <div class="number">$125 543</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box hover-expand-effect">
                        <div class="icon bg-green">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL PAGADO</div>
                            <div class="number">$125 543</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-light-blue">
                            <i class="material-icons">access_alarm</i>
                        </div>
                        <div class="content">
                            <div class="text">PRÓXIMOS VENCIMIENTOS</div>
                            <div class="number"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Hover Zoom Effect -->
        </div>
    </section>
        <!-- FIN INFOBOX -->
        <!-- COMIENZO CHARTS -->
        <section class="content" style="margin-top: 0px">
        <div class="container-fluid">           
            <div class="row clearfix">
                <!-- Line Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>VENTAS POR DESTINO</h2>
                        </div>
                        <div class="body">
                            <canvas id="line_chart" height="130"></canvas>
                        </div>
                    </div>
                </div>
                <!-- #END# Line Chart -->
                <!-- Bar Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>VENTAS POR MES</h2>
                        </div>
                        <div class="body">
                            <canvas id="bar_chart" height="130"></canvas>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar Chart -->
            </div> 
        </div>
    </section>    
        <!-- FIN CHARTS -->
    <!-- Fin Entorno de Trabajo -->
    
    <!-- ARCHIVOS JS -->
    <?php include '../config/js.php'; ?>  
    <script>
        function cargar_contenido(contenedor,contenido){
            $("#"+contenedor).load(contenido);
        }
    </script>
    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Chart Plugins Js -->
    <script src="../plugins/chartjs/Chart.bundle.js"></script>    
    
    <!-- Jquery CountTo Plugin Js -->
    <script src="../plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="../plugins/jquery-sparkline/jquery.sparkline.js"></script>


    <!-- Custom Js -->
    <script src="../js/admin.js"></script>    
    <script src="../js/pages/widgets/infobox/infobox-1.js"></script>
    <script src="../js/pages/charts/chartjs.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
    <!-- FIN ARCHIVOS JS -->
</body>

</html>
