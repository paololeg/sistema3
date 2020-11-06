<?php
    include '../config/conexion.php';
    
    class facturas extends conexion {
        //atributos
        public $i;
        public $consulta;
        public $datos;
        public $buscar;
        public $tipo;
        public $idUsuario;
        public $idFactura;
        public $idDetalle;
        public $idCliente;
        public $idVendedor;
        public $totalVenta;
        public $condicionVenta;
        public $comprobanteTarjeta;
        public $fechaVenta;
        public $idregistrante;

        //metodos
        //metodo de mostrar factras
        public function mostrarFacturas() {
            $this->consulta=$this->con->query("SELECT f.*, u.nombre as clientenom, u.apellido as clienteap, uu.nombre
                                                as vendedornom, uu.apellido as vendedorap,  t.* 
                                                FROM facturas f 
                                                INNER JOIN usuarios u on u.idUsuario  = f.idCliente
                                                INNER JOIN usuarios uu on uu.idUsuario = f.idVendedor
                                                INNER JOIN tarjetas t on t.idTarjeta  = f.condicionVenta 
                                                ORDER BY f.idFactura ASC");
            $this->i=1;
            while($this->datos= $this->consulta->fetch_array()) {
                ?>
                    <tr>
                        <td></td>
                        <td><?php echo $this->datos['idFactura'];?></td>
                        <td><?php echo $this->datos['clienteap'].", ".$this->datos['clientenom'];?></td>
                        <td><?php echo $this->datos['vendedorap'].", ".$this->datos['vendedornom'];?></td>
                        <td><?php echo $this->datos['nombreTarjeta'];?></td>
                        <td><?php echo $this->datos['fechaVenta'];?></td>
                        <td><?php echo $this->datos['totalVenta'];?></td>
                        <td>
                            
                        </td>
                    </tr> 
              <?php  
                $this->i++;
            }
            $this->con->close();
        }
                 
    }
?>