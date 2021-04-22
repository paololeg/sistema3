<?php
    include '../config/conexion.php';
    class dashboard extends conexion{
        public $consulta;
        public $consulta2;
        public $datos;
        public $registrosencontradosventasnum;
        public $totalVentas;
        public $acumTotalVentas;
        public $cantidad;
        
        //metodo muestra total de ventas
        public function totalventasnum() {
            $this->consulta= $this->con->query("SELECT * FROM operaciones WHERE venta > 0 ");
            $this->registrosencontradosventasnum= $this->consulta->num_rows;
            echo $this->registrosencontradosventasnum;
        }
        
        //metodo cantidad de productos
        public function totalproductos() {
            $this->consulta= $this->con->query("SELECT * FROM productos");
            $this->registrosencontrados= $this->consulta->num_rows;
            echo $this->registrosencontrados;
        }
        
        //metodo muestra importe total de ventas
        public function totalventas() {
            $this->consulta= $this->con->query("SELECT venta FROM operaciones ");
            while($this->datos= $this->consulta->fetch_array()){
                $this->acumTotalVentas = $this->acumTotalVentas + $this->datos['venta'];
            }
            echo $this->acumTotalVentas;
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
        //metodo muestra importe total de ingresos
        public $acumTotalIngresos;
        public function totalingresos() {
            $this->consulta= $this->con->query("SELECT importeIngreso FROM ingresos ");
            while($this->datos= $this->consulta->fetch_array()){
                $this->acumTotalIngresos = $this->acumTotalIngresos + $this->datos['importeIngreso'];
            }
            echo $this->acumTotalIngresos;
        }
        
        //metodo muestra importe total de ingresos
        public $acumTotalEgresos;
        public function totalegresos() {
            $this->consulta= $this->con->query("SELECT importeEgreso FROM egresos ");
            while($this->datos= $this->consulta->fetch_array()){
                $this->acumTotalEgresos = $this->acumTotalEgresos + $this->datos['importeEgreso'];
            }
            echo $this->acumTotalEgresos;
        }
    }
?>