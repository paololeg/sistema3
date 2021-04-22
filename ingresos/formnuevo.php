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
                <h3>Nuevo Ingreso</h3>
                <hr>
                <form action="formnuevo.php" method="POST" id="formnuevo"> 
                    <div class="row clearfix">
                        <div class=" col-md-3">
                            <div class="form-group">
                                <label for="tipoIngreso">Tipo</label>
                                <select name="tipoIngreso" class="form-control">
                                    <option>--Seleccione---</option>
                                    <option value="recibo">Recibo</option>
                                    <option value="manual">Ingreso Manual</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="importeIngreso">Importe</label>
                                <input type="number" step="any" class="form-control" id="importeIngreso" name="importeIngreso" required="">
                            </div>
                        </div>
                        <div class=" col-lg-4">
                            <div class="form-group">
                                <label for="descripcionEgreso">Descripción</label>
                                <input type="text" class="form-control" id="descripcionEgreso" name="descripcionEgreso" required="">
                            </div>
                            <div class="form-group">
                                <label for="idOperacion">Nº Operación</label>
                                <input type="number" step="any" class="form-control" id="idOperacion" name="idOperacion" required="" style="width: 30%">
                            </div>
                        </div>  
                    </div> 
                    <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>
                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                </form>
                <?php
                include 'clase.php';
                $objetoNuevo= new ingresos();
                if(isset ($_POST['descripcionIngreso'])){
                    $objetoNuevo->guardar($_POST['iCaja'], $_POST['tipoIngreso'], $_POST['idOperacion']
                                         , $_POST['descripcionIngreso'], $_POST['importeIngreso'], $_POST['idRegistrante']);
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
