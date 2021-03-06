<?php 
    include '../config/sesion.php';
    include 'clase.php';
    $pagina=8;
    if($_SESSION['rol']==6) {
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
                 <h1><b>CAJA - <?php echo $_GET['idCaja']?></b></h1>
            </div> 
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="body table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-left">
                                                <a class="btn btn-primary" href="iniciar.php">Iniciar Caja</a>
                                                <br>
                                                <?php 
                                                    $objetoSaldoInicial= new Caja();
                                                    $objetoSaldoInicial->mostrarSaldoInicial($_GET['idCaja'])
                                                ?>
                                            </th>
                                            <th class="text-right">
                                                <a class="btn btn-warning" href="cerrarcaja.php?idCaja=<?php echo $_GET['idCaja']?>" >Cerrar caja</a>
                                                <br>
                                                <?php 
                                                    $objetoSaldoFinal= new Caja();
                                                    $objetoSaldoFinal->mostrarSaldoFinal($_GET['idCaja'])
                                                ?>
                                            </th>
                                       
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="6">INGRESOS</th>
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
                                        <tr>
                                            <th colspan="6">EGRESOS</th>
                                            <th class="text-center">
                                                <a class="btn btn-primary" href="formnuevoegreso.php?idCaja=<?php echo $_GET['idCaja']?>">Nuevo Egreso</a>
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
                                            $objetoMostrarEgresos = new Caja();
                                            $objetoMostrarEgresos->mostrarEgresos($_GET['idCaja']);
                                        ?>
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
