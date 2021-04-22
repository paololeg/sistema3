<?php include '../config/sesion.php';
    $pagina=6;
    include 'clase.php';
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
                <h3>Nuevo Ingreso</h3>
                
                <hr>
                <form action="formnuevoingreso.php" method="POST"> 
                    <input type="hidden" name="idRegistrante" value="<?php echo $_SESSION['idusu']; ?>"> 
                    <input type="hidden" name="idCaja" value="<?php echo $_GET['idCaja']  ;?>">
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
                            <div class="form-group">
                                <label for="numeroComprobante">Nº Comprobante</label>
                                <input type="number" step="any" class="form-control" id="numeroComprobante" name="numeroComprobante">
                            </div>
                        </div>
                        <div class=" col-lg-4">
                            <div class="form-group">
                                <label for="descripcionIngreso">Descripción</label>
                                <input type="text" class="form-control" id="descripcionIngreso" name="descripcionIngreso" required="">
                            </div>
                            <div class="form-group">
                                <label for="moneda">Moneda</label>
                                <select name="moneda" class="form-control">
                                    <option value="pesos">Pesos</option>
                                    <option value="dolares">Dólares</option>
                                </select>
                            </div>
                        </div>
                        <div class=" col-lg-4">
                            <div class="form-group">
                                <label for="idOperacion">Nº Operación</label>
                                <input type="number" step="any" class="form-control" id="idOperacion" name="idOperacion" style="width: 30%">
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo Valor</label>
                                <select name="tipoValor" class="form-control">
                                    <option value="efectivo">EFECTIVO</option>
                                    <option value="tarjetacredito">TARJETA DE CRÉDITO</option>
                                    <option value="tarjetadebito">TARJETA DE DÉBITO</option>
                                    <option value="transferencia">TRANSFERENCIA</option>
                                </select>
                            </div>
                        </div>  
                    </div> 
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="index.php?idCaja=<?php echo $_GET['idCaja'] ?>" class="btn btn-danger">Cancelar</a>
                </form>
                <?php
                
                $objetoNuevo= new Caja();
                if(isset ($_POST['importeIngreso'])){
                    $objetoNuevo->guardarIngreso($_POST['idCaja'], $_POST['tipoIngreso'], $_POST['idOperacion'], $_POST['moneda'], $_POST['numeroComprobante']
                                         , $_POST['descripcionIngreso'], $_POST['importeIngreso'], $_POST['tipoValor'], $_POST['idRegistrante']);
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
