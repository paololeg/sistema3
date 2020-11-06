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
                <h3>Nueva Tarjeta</h3>
                <hr>
                <form action="formnuevo.php" method="POST" id="formnuevo"> 
                    <div class="row clearfix">
                        <div class=" col-md-3">
                            <div class="form-group">
                                <label for="nombreTarjeta">Tarjeta</label>
                                <input type="text" class="form-control" id="nombreTarjeta" name="nombreTarjeta" required="">
                            </div>
                            <div class="form-group">
                                <label for="cuotas">Cuotas</label>
                                <input type="number" class="form-control" id="cuotas" name="cuotas" required="">
                            </div>
                            <div class="form-group">
                                <label for="cuotas">Interes</label>
                                <input type="number" class="form-control" id="interes" name="interes" required="">
                            </div>
                        </div>                         
                    </div> 
                    <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>
                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                </form>
                <?php
                include 'clase.php';
                $objetoNuevo= new tarjetas();
                if(isset ($_POST['nombreTarjeta'])){
                    $objetoNuevo->guardar($_POST['nombreTarjeta'], $_POST['cuotas'], $_POST['interes']);
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
