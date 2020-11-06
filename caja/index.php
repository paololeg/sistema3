<?php include '../config/sesion.php';
    $pagina=8;
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
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
                 <h2>CAJA</h2>
                 <a class="btn btn-primary" href="iniciar.php">Iniciar Caja</a>
            </div> 
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <form id="formnuevo" action="index.php" method="GET">
                                <div class="form-group">
                                    <label for="importeCaja">Saldo Inicial</label>
                                    <input type="number" class="form-control" id="importeCaja" name="importeCaja" required="">
                                </div>
                                <div class="form-group">
                                    <label for="ventas">Ingresos por Ventas</label>
                                    <input type="number" class="form-control" id="ventas" name="ventas" required="">
                                </div>
                                <div class="form-group">
                                    <label for="egresos">Egresos</label>
                                    <input type="number" class="form-control" id="egresos" name="egresos" required="">
                                </div>
                                <div class="form-group">
                                    <label for="total">TOTAL</label>
                                    <input type="number" class="form-control" id="total" name="total" required="">
                                </div>
                            </form> 
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
