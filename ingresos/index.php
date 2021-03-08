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
    <?php // include  '../config/loader.php'; ?>
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
                <h2>INGRESOS</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <form action="index.php" method="GET">                                    
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control col-sm-3" name="fechaDesde" id="fechaDesde"  
                                            <?php
                                                if(isset($_GET['fechaDesde'])) {
                                                    ?> value="<?php echo $_GET['fechaDesde']; ?>"                                                     
                                            <?php        
                                                }
                                            ?>    
                                        >                                  
                                        
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control col-sm-3" name="fechaHasta" id="fechaHasta"
                                        
                                            <?php
                                                if(isset($_GET['fechaHasta'])) {
                                                    ?> value="<?php echo $_GET['fechaHasta']; ?>"                                                     
                                            <?php        
                                                }
                                            ?> 
                                        >
                                     </div> 
                                    <div class="col-sm-3">
                                        <button class="btn btn-success" type="submit">Buscar</button>
                                    </div>
                                </form>
                                <a href="formnuevo.php" class="btn btn-primary">Nuevo Registro</a>  
                            </h2>                           
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Descripción</th> 
                                        <th>Importe</th> 
                                        <th>Fecha</th> 
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        include 'clase.php'; 
                                        $objetoMostrar = new egresos();
                                        if(isset($_GET['fechaDesde'])){
                                            $objetoMostrar->filtro($_GET['fechaDesde'],$_GET['fechaHasta']);
                                        }else{                                            
                                            $objetoMostrar->mostrarEgresos($_GET['pagina']);
                                        }                                        
                                    ?>                                                                    
                                </tbody>
                            </table>
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
