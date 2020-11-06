<?php include '../config/sesion.php';
    $pagina=6;
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
                <h3>Nuevo Egreso</h3>
                <hr>
                <form action="formnuevo.php" method="POST" id="formnuevo"> 
                    <div class="row clearfix">
                        <div class=" col-md-3">
                            <div class="form-group">
                                <label for="descripcionEgreso">Descripción</label>
                                <input type="text" class="form-control" id="descripcionEgreso" name="descripcionEgreso" required="">
                            </div>
                            <div class="form-group">
                                <label for="importeEgreso">Importe</label>
                                <input type="number" step="any" class="form-control" id="importeEgreso" name="importeEgreso" required="">
                            </div>
                            <div class="form-group">
                                <label for="fechaEgreso">Fecha</label>
                                <input type="date" class="form-control" id="fechaEgreso" name="fechaEgreso" required="">
                            </div>
                        </div>                         
                    </div> 
                    <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>
                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                </form>
                <?php
                include 'clase.php';
                $objetoNuevo= new egresos();
                if(isset ($_POST['descripcionEgreso'])){
                    $objetoNuevo->guardar($_POST['descripcionEgreso'], $_POST['importeEgreso'], $_POST['fechaEgreso']);
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Fin Entorno de Trabajo -->
    
    <!-- ARCHIVOS JS -->
    <?php include '../config/js.php'; ?>
    <!-- FIN ARCHIVOS JS -->
</body>

</html>
