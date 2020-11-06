<?php
    session_start();
    if(isset($_SESSION['idusu']) && isset($_SESSION['usu']) && isset($_SESSION['rol'])){
        switch ($_SESSION['rol']){
        case 1: $rol='ADMINISTRADOR';
            break;
        case 2: $rol='USUARIO ESTANDAR';
            break;
        case 3: $rol='USUARIO LIMITADO';
            break;
        case 4: $rol='CLIENTE';
            break;
        case 5: $rol='PROVEEDOR';
        }
    }else {
        header("location:../index.php");
    }

?>