<?php
    include '../config/conexion.php';
    class informes extends conexion{
        public $consulta;
        public $datos;
        public $registrosencontrados;
        public $cantidad;
        
        //metodo cantidad de usuarios
        public function totalusuarios() {
            $this->consulta= $this->con->query("SELECT * FROM usuarios");
            $this->registrosencontrados= $this->consulta->num_rows;
            echo $this->registrosencontrados;
        }
        
        //metodo cantidad de productos
        public function totalproductos() {
            $this->consulta= $this->con->query("SELECT * FROM productos");
            $this->registrosencontrados= $this->consulta->num_rows;
            echo $this->registrosencontrados;
        }
        
        //metodo cantidad de ventas
        public function totalventas() {
            $this->consulta= $this->con->query("SELECT * FROM facturas");
            $this->registrosencontrados= $this->consulta->num_rows;
            echo $this->registrosencontrados;
        }
        
        //metodo cantidad de productos agotados
        public function totalproductosagotados() {
            $this->consulta= $this->con->query("SELECT * FROM productos WHERE cantidad=0");
            $this->registrosencontrados= $this->consulta->num_rows;
            echo $this->registrosencontrados;
        }
        
        //metodo cantidad de productos minino
        public function totalproductosminimo() {
            $this->consulta= $this->con->query("SELECT * FROM productos WHERE cantidad>=1 AND cantidad>=10");
            $this->registrosencontrados= $this->consulta->num_rows;
            echo $this->registrosencontrados;
        }
    }
?>