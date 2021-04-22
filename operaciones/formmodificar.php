<?php 
    include '../config/sesion.php';
    $pagina=11;
    include'clase.php';  
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
</head>
<body class="theme-blue">
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
                <div class="body">
                    <div id="valreg" style="display: none" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <b>La fecha de regreso no puede ser menor que la fecha de salida</b>
                    </div>
                </div>
                <h2>MODIFICAR OPERACIÓN</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header"> 
                            <br>
                            <form class="form-horizontal" action="formmodificar.php" method="POST">  
                                <input type="hidden" name="idOperacion" value="<?php echo $_GET['idOperacion']; ?>">                                
                                <input type="hidden" name="idRegistrante" value="<?php echo $_SESSION['idusu']; ?>">    
                                <?php
                                    if(isset($_GET['idOperacion'])){
                                        $objetoDatos = new operaciones();
                                        $objetoDatos->datosmodificar($_GET['idOperacion']);  
                                    }
                                ?>
                                    <div class="col-lg-2 col-md-2 col-sm-8 col-xs-8">
                                        <button class="btn-lg btn-primary" id="guardar" type="submit">Guardar</button>
                                    </div>
                                    <div>
                                        <h2>
                                            Saldo $ <?php
                                                        $objetoMostrarSaldo= new operaciones();
                                                        $objetoMostrarSaldo->mostrarSaldo($_GET['idOperacion']);
                                                    ?>
                                        </h2>
                                    </div>
                                </div>
                            </form>
                            <?php
                                if(isset($_POST['idCliente'])){
                                    $objetoModificar = new operaciones();
                                    $objetoModificar->confirmarmodificacion($_POST['idOperacion'],$_POST['idRegistrante'],$_POST['idCliente'],
                                                                            $_POST['salida'],$_POST['regreso'],$_POST['cantidadPax'],
                                                                            $_POST['descripcion']);
                                }
                            ?>
                        </div>
                        <div class="header">
                            <div class="row clearfix">                                
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary waves-effect m-r-20" data-toggle="modal" data-target="#largeModal">Agregar Servicios</button>
                                </div>
                            </div> 
                            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="largeModalLabel">Modificar Servicios</h4>
                                        </div>
                                        <div class="modal-body" >
                                            <div class="header">
                                                <form action="agregardetalleoperacion.php" method="POST" >
                                                    <div>
                                                    <input type="hidden" name="idOperacion" value="<?php echo $_GET['idOperacion']; ?>">                                       
                                                    <input type="hidden" name="idRegistrante" value="<?php echo $_SESSION['idusu']; ?>">
                                                    </div>
                                                    
                                                    <div class="col-lg-3 col-md-3 col-sm-8 col-xs-8">
                                                        <!-- APERTURA Y CIERRE DE SCRIPT PARA SELECT DINAMICO-->
                                                        <script>
                                                            function productoporcategoria(valor){
                                                                $.ajax({
                                                                    type:  'POST',
                                                                    url: 'selectproductos.php',
                                                                    data: 'idCategoria='+valor,
                                                                    success: function(respuesta){
                                                                        $('#idProducto').html(respuesta);
                                                                    }
                                                                });
                                                            }
                                                        </script>
                                                        <select id="idCategoria" name="idCategoria" style="height: 28px" 
                                                                onchange="productoporcategoria(this.value);"
                                                        >
                                                            <option>--Categoría--</option>
                                                            <?php
                                                                $objetoMostrarCategorias = new operaciones();
                                                                $objetoMostrarCategorias->selectCategorias();                                            
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-8 col-xs-8">
                                                        <select id="idProducto" name="idProducto" style=" width: 100%; height: 28px">
                                                            <option>--Productos--</option>
                                                        </select>

                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-4 col-xs-5 " style="padding-left: 0 auto">
                                                        <label class="p-l-0" style="width: 30%;" for="pax">Pax</label>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="number" name="cantidadProducto" class="" style="width: 100%; height: 28px" value="1"  min="1" pattern="^[0-9]+" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                        <button class="btn btn-success" type="submit"><i class="material-icons">add</i> <span class="icon-name"></button>
                                                    </div>
                                                <br>
                                                </form>
                                            <br>   
                                            <div class="row" id="stockcero"></div>
                                            </div> 
                                            <div class="body table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Producto</th> 
                                                            <th>Cantidad</th> 
                                                            <th>Venta Unitaria</th> 
                                                            <th>Costo Unitario</th> 
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            if(isset($_GET['idOperacion'])){
                                                                $objetoMostrarDetalles = new operaciones();
                                                                $objetoMostrarDetalles->mostrarDetallesModal($_GET['idOperacion']);
                                                            }                                         
                                                        ?>                                                                     
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>                          
                        </div> 
                        <div class="body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Categoría</th> 
                                        <th>Producto</th> 
                                        <th>Cantidad</th> 
                                        <th>Venta Unitaria</th> 
                                        <th>Costo Unitario</th>
                                        <th>Subtotal Venta</th>  
                                        <th>Subtotal Costo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(isset($_GET['idOperacion'])){
                                            $objetoMostrarDetalles = new operaciones();
                                            $objetoMostrarDetalles->mostrarDetalles($_GET['idOperacion']);
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
    <script type="text/javascript">
        function validarFecha(){
            var salida=document.getElementById('salida').value;
            var regreso=document.getElementById('regreso').value;          
          
            if(regreso < salida){
                document.getElementById('valreg').style.display='block';
                document.getElementById('guardar').style.display='none';
            }
             else{
                document.getElementById('valreg').style.display='none';
                document.getElementById('guardar').style.display='block';                
            }
           
        }
    </script>
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>
    
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../plugins/jquery/jquery-3.6.0.min.js"></script>
        <!-- SweetAlert Plugin Js -->
    <script src="../plugins/sweetalert/sweetalert.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>
    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/ui/dialogs.js"></script>
    <script src="../js/demo.js"></script>
    <!-- FIN ARCHIVOS JS -->  
</body>

</html>
