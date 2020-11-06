<?php
    class conexion {
        //atributos
        public $con;
        
        //metodos
        public function __construct() {
            $this->con = new mysqli("localhost","root","","programacion3");
            
            if($this->con->connect_errno) {//si existe un error en la conexión enotnces larga mensaje
                echo "ERROR!!! corregir los datos";
            }
            $this->con->query("SET NAMES 'UTF8");
        }
    }

?>