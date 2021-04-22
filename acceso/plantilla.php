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
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" <?php if($_SESSION['rol']==3) { echo 'style="display:none;"';} ?>>
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
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" <?php if($_SESSION['rol']==3) { echo 'style="display:none;"';} ?>>
                    <div class="info-box">
                        <div class="icon bg-orange">
                            <span class="chart chart-line">9,4,6,5,6,4,7,3</span>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL VENTAS</div>
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
            </div>
            <!-- #END# Counter Examples -->
            <!-- Hover Zoom Effect -->            
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" <?php if($_SESSION['rol']==6) { echo 'style="display:none;"';} ?>>
                    <div class="info-box hover-expand-effect">
                        <div class="icon bg-teal">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="content" >
                            <div class="text">TOTAL COBRADO</div>
                            <div class="number">$<?php 
                                                $objetoMostrarIngresos = new dashboard();     
                                                $objetoMostrarIngresos->totalingresos();
                                            ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"  <?php if($_SESSION['rol']==6) { echo 'style="display:none;"';} ?>>
                    <div class="info-box hover-expand-effect">
                        <div class="icon bg-green">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL PAGADO</div>
                            <div class="number">$<?php 
                                                $objetoMostrarEgresos = new dashboard();     
                                                $objetoMostrarEgresos->totalegresos();
                                            ?></div>
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
                <!-- Bar Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-9">
                                <h2>VENTAS POR DESTINO</h2>
                            </div>
                            <div class="col-lg-3">
                                <button class="btn btn-primary" onclick="cargarDatosGraficoBar()">Mostrar</button>
                            </div>  
                        </div>
                        <div class="body">
                            <canvas id="myChart" width="200" height="80"  ></canvas>
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
    <script>
       
        function cargarDatosGraficoBar(){
            $.ajax({
                url:'controladorgrafico.php',
                type:'POST'
            }).done(function(resp){
                var titulo = [];
                var cantidad = [];
                var data = JSON.parse(resp);
                for(var i=0;i<data.length;i++){
                   titulo.push(data[i][1]);
                   cantidad.push(data[i][0]);
                } 
                var ctx = document.getElementById('myChart')
                var myChart = new Chart(ctx,{
                    type: 'bar',
                    data: {
                        labels: titulo,
                        datasets: [{
                            label: "Cantidad de pax",
                            data: cantidad,
                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 206, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(255, 159, 64, 0.2)',
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 206, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                            ],
                                            borderColor: [
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)',
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                            ],
                                            borderWidth: 1
                                        
                                    
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                })
               
                })
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
    <script  src="../js/admin.js"></script>    
    <script src="../js/pages/widgets/infobox/infobox-1.js"></script>
    <!--<script src="../js/pages/charts/chartjs.js"></script> -->

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
    <!-- FIN ARCHIVOS JS -->
</body>

</html>
