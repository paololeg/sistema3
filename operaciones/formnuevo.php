<?php 
    include '../config/sesion.php';
    $pagina=11;
    include 'clase.php';
    if(isset($_POST['buscar'])) {
        $objetoCargar = new operaciones();
        $objetoCargar->detallesNuevaOperacion($_POST['buscar'], $_POST['idRegistrante'], $_POST['idOperacion']);
    }
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
                <h2>NUEVA OPERACIÓN</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            
                            <br>
                            <form class="form-horizontal" action="formnuevo.php" method="POST">  
                                <input type="hidden" name="idOperacion" value="<?php echo $_GET['idOperacion']; ?>">                                    
                                <input type="hidden" name="idRegistrante" value="<?php echo $_SESSION['idusu']; ?>">    
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 p-r-5">
                                        <label>Cliente</label>
                                        <select name="idCliente">
                                            <option value="">Seleccione cliente</option> 
                                            <?php                                      
                                             $objetoOption = new operaciones();
                                             $objetoOption->selectCliente();
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-8 col-xs-8">
                                        <label for="salida">Salida</label>
                                        <input type="date" id="salida" name="salida" class="text-center" onchange="validarFecha()" required="" >
                                    </div> 
                                         
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <label for="regreso">Regreso</label>
                                        <input type="date" id="regreso" name="regreso" class="text-center" onchange="validarFecha()" required="">  
                                    </div>
                                </div>
                                <br>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" style="padding-left: 0 auto">
                                        <label class="p-l-0" for="pax">Cantidad Pax</label>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" name="cantidadPax" class="form-control" value="1" min="1" pattern="^[0-9]+" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label ">
                                        <label for="descripcion">Descripción</label>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="descripcion" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-8 col-xs-8">
                                        <button id="guardar" class="btn btn-primary" type="submit">Guardar</button>
                                    </div>
                                </div>
                            </form>   
                            <?php
                                
                                $objetoNuevaOperacion = new operaciones();
                                if(isset ($_POST['idCliente'])){
                                    $objetoNuevaOperacion->guardar($_POST['idOperacion'],$_POST['idRegistrante'],$_POST['idCliente'],$_POST['salida'],
                                            $_POST['regreso'],$_POST['cantidadPax'], $_POST['descripcion']);   
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
    <?php include '../config/js.php'; ?>
    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>


    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/ui/dialogs.js"></script>
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
    <!-- FIN ARCHIVOS JS -->  
</body>

</html>
