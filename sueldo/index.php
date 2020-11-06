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
<body class="theme-red">
    <!-- Loader -->
    <?php  include '../config/loader.php'; ?>
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
                 <h2>Liquidación de Sueldo</h2>
            </div> 
            <div class="row clearfix" >
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="card">
                        <div class="header">
                            <form action="index.php" method="GET" style="height: 500px">
                                <div class="form-inline">
                                    <label for="mesSueldo">Mes</label>
                                    <input type="text" class="form-control" id="mesSueldo" name="mesSueldo" required="">
                                </div>
                                <div class="form-inline">
                                    <label for="anioSueldo">Año</label>
                                    <input type="text" class="form-control" id="anioSueldo" name="anioSueldo" required="">
                                </div>
                                <div class="form-inline">
                                    <label for="idUsuario">Empleado</label>
                                    <select class="form-control" id="idUsuario" name="idUsuario" required="">
                                        <option>Seleccionar empleado</option>
                                        <?php
                                            $objetoempleado = new Sueldo();
                                            $objetoempleado->empleados();
                                        ?>                                        
                                    </select>
                                </div>
                                <div class="form-inline">
                                    <input class="btn btn-primary" type="submit" value="Consultar">
                                </div>
                            </form> 
                            <?php
                                if(isset($_GET['mesSueldo'])) {
                                    $objetoliquidacion=new Sueldo();
                                    $objetoliquidacion->liquidacion($_GET['mesSueldo'], $_GET['anioSueldo'], $_GET['idUsuario']);                            
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
