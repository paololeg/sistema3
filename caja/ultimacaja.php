
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
        <?php
            include 'clase.php';
            $objetoMostrarUltima = new Caja();
            $objetoMostrarUltima->ultimaCaja($_GET[idCaja]);
            echo "<script>window.location.href='ultimacaja.php'</script>";
            
            
            //echo "<script>confirm('Esta acción cerrará la caja actual');window.location.href='ultimacaja.php'</script>";
        ?>

    </section>
    <!-- Fin Entorno de Trabajo -->
    
    <!-- ARCHIVOS JS -->
    <?php include '../config/js.php'; ?>
    <!-- FIN ARCHIVOS JS -->
</body>

</html>
