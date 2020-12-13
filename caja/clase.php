<?php
    include '../config/conexion.php';
    
    class Caja extends conexion{
        public $idCaja;
        public $idUsuario;
        public $importeCaja;
        public $fechaCaja;
        public $horaCaja;
        public $consulta;
        public $datos;
        public $sumar;
        
        //Método para iniciar la caja
        public function iniciarCaja($imp,$idusu){
            date_default_timezone_set("america/argentina/tucuman");            
            $this->importeCaja=$imp;
            $this->fechaCaja=date("Y-m-d");
            $this->horaCaja=date("H:i:s");
            $this->idUsuario=$idusu;   
            
            $this->consulta= $this->con->query("INSERT INTO caja (idUsuario, importeCaja, fechaCaja, horaCaja)
                      VALUES ('$this->idUsuario','$this->importeCaja','$this->fechaCaja','$this->horaCaja')");
            $this->con->close();
            echo "<script>alert('Caja iniciada');window.location.href='index.php'</script>";
        }
        //metodo dinero inicial
        public function dineroInicial(){
            date_default_timezone_set("america/argentina/tucuman");
            $this->fechaCaja=date("Y-m-d");
            $this->sumar=0;
            $this->consulta= $this->con->query("SELECT importeCaja FROM caja WHERE fechaCaja='$this->fechaCaja'");
            while ($this->datos=$this->consulta->fetch_array()){
                $this->sumar+= round($this->datos['importeCaja'],2);
            }
            echo $this->sumar;
            $this->con->close();
        }
    }
?>