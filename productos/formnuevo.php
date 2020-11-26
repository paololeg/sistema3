<?php include '../config/sesion.php';
    $pagina=4;
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
</head>
<body class="theme-red">
    <!-- Loader -->
  
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
                <h3>Nuevo Producto</h3>
                <hr>
                <form action="formnuevo.php" method="POST" id="formnuevo" enctype="multipart/form-data"> 
                    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idusu']?>">
                    <div class="row clearfix">
                        <div class=" col-md-2">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" required="">
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombreProducto">Producto</label>
                                <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required="">
                            </div>
                        </div>                         
                        <div class="col-md-3">
                            <label for="categoria">Categoría</label>
                            <select class="form-control show-tick" name="idCategoria" id="categoria" required="">                                
                               <option value="">--Categoría--</option> 
                               <?php 
                                include 'clase.php';
                                $objetoOption = new productos();
                                $objetoOption->selectCategorias();
                               ?>                               
                            </select>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea type="text" class="form-control" id="descripcion" name="descripcion" required=""></textarea>
                            </div>
                        </div> 
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" required="">
                            </div>  
                        </div>  
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="foto">Imagen</label>
                            <input type="file" class="form-control" name="foto" id="foto" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="precioVenta">Precio Venta</label>
                                <input type="number" step="any" class="form-control" id="precioVenta" name="precioVenta" required="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="precioCompra">Precio Compra</label>
                                <input type="number" step="any" class="form-control" id="precioCompra" name="precioCompra" required="">
                            </div>
                        </div>
                    </div>                                     
                    <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>
                    <a href="index.php?pagina=1" class="btn btn-danger">Cancelar</a>
                </form>
                <?php
               
                $objetoNuevo= new productos();
                if(isset ($_POST['nombreProducto'])){
                    $objetoNuevo->guardar($_POST['nombreProducto'],$_POST['descripcion'],$_POST['codigo'],$_POST['cantidad'],
                            $_POST['precioVenta'],$_POST['precioCompra'],$_POST['idCategoria'],$_POST['idUsuario']);
                    
                    $ubicaciontemporal = $_FILES['foto'] ['tmp_name'];
                    if(move_uploaded_file($ubicaciontemporal,'fotos/'.$_POST['codigo'])){
                       echo "<script>alert('Producto Registrado');window.location.href='index.php?pagina=1';</script>"; 
                    }    
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
