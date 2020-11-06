<?php include '../config/sesion.php';
    $pagina=10;
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
</head>
<body class="theme-red">
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
                 <h2>Nueva Liquidación</h2>
            </div> 
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <form id="formnuevo" action="formnuevo.php" method="POST">
                                <input type="hidden" name="mesSueldo" value="<?php echo $_GET['mesSueldo'] ?>">
                                <input type="hidden" name="anioSueldo" value="<?php echo $_GET['anioSueldo'] ?>">
                                <input type="hidden" name="idUsuario" value="<?php echo $_GET['idUsuario'] ?>">
                                <div class="form-group">
                                    <label for="diasTrabajados">Cantidad de días trabajados</label>
                                    <input type="number" class="form-control" id="diasTrabajados" name="diasTrabajados" required="">
                                </div>
                                <div class="form-group">
                                    <label for="basico">Básico</label>
                                    <select class="form-control" id="basico" name="basico" required="">
                                        <option value="">Seleccionar</option>
                                        <option value="46790.08">Administrativo Cat. A</option>
                                        <option value="46925.50">Administrativo Cat. B</option>
                                        <option value="47400.06">Administrativo Cat. C</option>                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="obraSocial">Obra Social</label>
                                    <select class="form-control" id="obraSocial" name="obraSocial" required="">
                                        <option value="">Seleccionar</option>
                                        <option value="OSDE BINARIO">OSDE BINARIO</option>
                                        <option value="OSECAC">OSECAC</option> 
                                        <option value="PRENSA">PRENSA</option>
                                        <option value="SUBSIDIO DE SALUD">SUBSIDIO DE SALUD</option>   
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="antiguedad">Antigüedad</label>
                                    <input type="number" class="form-control" id="antiguedad" name="antiguedad" required="">
                                </div>
                                <div class="form-group">
                                    <label for="diasFeriados">Cantidad de días feriados</label>
                                    <input type="number" class="form-control" id="diasFeriados" name="diasFeriados" required="">
                                </div>
                                <div class="form-group">
                                    <label for="feriadosTrabajados">Cantidad de días feriados trabajados</label>
                                    <input type="number" class="form-control" id="feriadosTrabajados" name="feriadosTrabajados" required="">
                                </div>
                                <div class="form-group">
                                    <label for="feriadosNoTrabajados">Cantidad de días feriados no trabajados</label>
                                    <input type="number" class="form-control" id="feriadosNoTrabajados" name="feriadosNoTrabajados" required="">
                                </div>
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date("Y-m-d")?>">
                                </div>
                                <div class="form-group">                                
                                    <button class="btn btn-primary" type="submit">Registrar</button>
                                    <a class="btn btn-danger" href="index.php">Cancelar</a>
                                </div>
                            </form> 
                            <?php
                                include 'clase.php';
                                 $objetoNuevo= new Sueldo();
                                if(isset($_POST['mesSueldo'])){                                 
                                    $objetoNuevo->guardar($_POST['mesSueldo'],$_POST['anioSueldo'],$_POST['idUsuario'],$_POST['diasTrabajados'],
                                                          $_POST['basico'],$_POST['obraSocial'],$_POST['antiguedad'],$_POST['diasFeriados'],
                                                          $_POST['feriadosTrabajados'],$_POST['feriadosNoTrabajados'],$_POST['fecha']); 
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
