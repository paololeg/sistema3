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
                <h2>LISTADO DE FACTURAS</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>                                
                                <a href="../ventas/iniciarfactura.php" class="btn btn-primary  float-left">Nuevo Registro</a> 
                            </h2>                           
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nº Factura</th>
                                        <th>Cliente</th>
                                        <th>Vendedor</th>
                                        <th>Condición Venta</th>
                                        <th>Fecha</th>
                                        <th>Total</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        include 'clase.php'; 
                                        $objetoMostrar = new facturas();
                                        if(isset($_GET['buscar'])){
                                            $objetoMostrar->filtro($_GET['buscar'],$_GET['tipo']);
                                        }else{                                            
                                            $objetoMostrar->mostrarFacturas();
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
