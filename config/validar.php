<?php
    session_start();
    include 'conexion.php';
    
    class seguridad extends conexion {
        //atributos
        public $usuario;
        public $password;
        public $consulta;
        public $valide;
        public $encriptado;
        
        public function acceder($usu,$pass) {
            $this->usuario=$usu;
            $this->password=$pass;
            $this->encriptado= $this->password;
            
            $this->consulta=$this->con->query("SELECT * FROM usuarios WHERE usuario='$this->usuario' AND password='$this->encriptado'");
            if($this->valide=$this->consulta->fetch_array()) {
                $_SESSION['idusu']= $this->valide['idUsuario'];
                $_SESSION['usu']=$this->valide['apellido'].", ".$this->valide['nombre'];
                $_SESSION['rol']= $this->valide['privilegio'];
                header("location:../acceso/plantilla.php");
            } else {
                echo"<script>alert(`USUARIO Y CLAVE NO EXISTEN`);window.location.href='../index.html';</script>";
            }
        }
    }
    
    $objetoValidar = new seguridad();
    $objetoValidar->acceder($_POST['usuario'],$_POST['password']);
?>
