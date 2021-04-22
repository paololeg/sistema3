<?php include '../config/sesion.php';
    $pagina=2;
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../config/head.php'; ?>
</head>
<body class="theme-blue">
    <!-- Loader -->
    <?php // include '../config/loader.php'; ?>
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
                <h3>Nuevo Usuario</h3>
                <hr>
                <form action="formnuevo.php" method="POST" id="formnuevo" enctype="multipart/form-data"> 
                    <input type="hidden" name="idregistrante" value="<?php echo $_SESSION['idusu']?>">
                    <div class="row clearfix">
                        <div class=" col-md-3">
                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required="">
                            </div>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required="">
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required="">
                            </div>
                        </div> 
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required="">
                            </div>  
                        </div>   
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input type="number" class="form-control" id="dni" name="dni" required="">
                            </div>
                        </div>                        
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nacimiento">Nacimiento</label>
                                <input type="date" class="form-control" id="nacimiento" name="nacimiento" required="">                                
                            </div>  
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="domicilio">Domicilio</label>
                                <input type="text" class="form-control" id="domicilio" name="domicilio" required="">
                            </div>  
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="localidad">Localidad</label>
                                <input type="text" class="form-control" id="localidad" name="localidad" required="">
                            </div>  
                        </div>  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="provincia">Provincia</label>
                                <input type="text" class="form-control" id="provincia" name="provincia" required="">
                            </div>  
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nacionalidad">Nacionalidad</label>
                                <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" required="">
                            </div>  
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required="">
                            </div>  
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sexo">Género</label>
                                <select class="form-control show-tick" name="sexo" id="sexo">
                                <option value="">-- Género --</option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                                <option value="O">Otro</option>
                            </select>
                            </div>  
                        </div>
                        <div class="col-md-3">
                            <label for="privilegio">Privilegio</label>
                            <select class="form-control show-tick" name="privilegio" id="privilegio" required="">
                                <option value="">-- Privilegio --</option>
                                <option value="1">Administrador</option>
                                <option value="2">Usuario Estándar</option>
                                <option value="3">Usuario Limitado</option>
                                <option value="4">Cliente</option>
                                <option value="5">Proveedor</option>
                                <option value="6">Vendedor</option>
                            </select>
                        </div>                            
                    </div>
                    <div style="width: 400px">
                        <div class="form-group">
                            <label for="foto">Imagen</label>
                            <input type="file" class="form-control" name="foto" id="foto" required="">
                        </div>
                    </div>
                    <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>
                    <a href="index.php?pagina=1" class="btn btn-danger">Cancelar</a>
                </form>
                <?php
                include 'clase.php';
                $objetoNuevo= new usuarios();
                if(isset ($_POST['usuario'])){
                    $objetoNuevo->guardar($_POST['usuario'],$_POST['password'],$_POST['apellido'],$_POST['nombre'],
                            $_POST['dni'],$_POST['email'],$_POST['nacimiento'],$_POST['domicilio'],$_POST['localidad'],
                            $_POST['provincia'],$_POST['nacionalidad'],$_POST['telefono'],$_POST['sexo'],$_POST['privilegio'],$_POST['idregistrante']);
                    
                    $ubicaciontemporal = $_FILES['foto'] ['tmp_name'];
                    if(move_uploaded_file($ubicaciontemporal,'fotos/'.$_POST['dni'])){
                      echo "<script>alert('Usuario Registrado');window.location.href='index.php?pagina=1';</script>"; 
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
