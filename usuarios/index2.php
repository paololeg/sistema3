<?php include '../config/sesion.php';
    $pagina=2;
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
</head>
<body class="theme-red">
    <!-- Loader -->
    <?php //include '../config/loader.php'; ?>
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
                <h2></h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <b>LISTADO DE USUARIOS</b>                         
                        </div>
                        <div class="body table-responsive">
                            <!-- ajax con php y mysql-->
                            <!-- apertura y cierre de script para usar javascript-->
                            <script>
                                function buscadorautomatico(valor){
                                    $.ajax({
                                        type: 'GET',
                                        url:'mostrarbusqueda.php',
                                        data:'busqueda='+valor,
                                        success:function(respuesta){
                                            $('#mostrar').html(respuesta);
                                        }
                                    });
                                }
                            </script>
                            <input type="text" placeholder="buscar" onkeyup="buscadorautomatico(this.value);">
                            <hr>
                            <div id="mostrar"></div>       
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
