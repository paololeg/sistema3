<?php 
    include '../config/sesion.php';
    include 'clase.php';
    $pagina=12;
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
                 <h1><b>Envío de email</b></h1>
            </div> 
            <form action="enviarcorreo.php" method="POST" id="formnuevo"> 
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control email " id="email" name="email" required="" multiple="">
                        </div>
                        <div class="form-group">
                            <label for="asunto">Asunto</label>
                            <input type="text" step="any" class="form-control" id="asunto" name="asunto" required="">
                        </div>
                        <div class="form-group">
                            <label for="mensaje">Mensaje</label>
                            <textarea rows="4" id="mensaje" name="mensaje"class="form-control no-resize" placeholder="Escriba aquí su mensaje" ></textarea>
                        </div>
                    </div>                         
                </div> 
                <button id="guardar" type="submit" class="btn btn-primary">Enviar</button>
                <a href="../acceso/plantilla.php" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </section>
    <!-- Fin Entorno de Trabajo -->
    <link rel="stylesheet" href="css/jquery.multi-emails.css" />
    <script src="/path/to/cdn/jquery.slim.min.js"></script>
    <script src="/path/to/js/jquery.multi-emails.js"></script>
    <!-- ARCHIVOS JS -->
    <?php include '../config/js.php'; ?>
    <!-- FIN ARCHIVOS JS -->
</body>

</html>
