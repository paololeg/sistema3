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
        public $cantidadMostrar;
        public $pagina;
        public $cantidadTotalRegistros;
        public $redondeoFinal;
        public $consultaMostrar;
        public $j;

        //metodos
        //metodo de mostrar factras
        public function mostrarFacturas($pag) {
            $this->cantidadMostrar = 10;
            $this->pagina = $pag;
            $this->cantidadTotalRegistros = $this->con->query("SELECT * FROM facturas");
            $this->redondeoFinal = ceil($this->cantidadTotalRegistros->num_rows/$this->cantidadMostrar);
            
            $this->consultaMostrar = "SELECT f.*, u.nombre as clientenom, u.apellido as clienteap, uu.nombre
                                                as vendedornom, uu.apellido as vendedorap,  t.* 
                                                FROM facturas f 
                                                INNER JOIN usuarios u on u.idUsuario  = f.idCliente
                                                INNER JOIN usuarios uu on uu.idUsuario = f.idVendedor
                                                INNER JOIN tarjetas t on t.idTarjeta  = f.condicionVenta ORDER BY idFactura DESC LIMIT ".(($this->pagina-1)*$this->cantidadMostrar).",".$this->cantidadMostrar;
            $this->consulta= $this->con->query($this->consultaMostrar);
            
           /* $this->consulta=$this->con->query("SELECT f.*, u.nombre as clientenom, u.apellido as clienteap, uu.nombre
                                                as vendedornom, uu.apellido as vendedorap,  t.* 
                                                FROM facturas f 
                                                INNER JOIN usuarios u on u.idUsuario  = f.idCliente
                                                INNER JOIN usuarios uu on uu.idUsuario = f.idVendedor
                                                INNER JOIN tarjetas t on t.idTarjeta  = f.condicionVenta 
                                                ORDER BY f.idFactura ASC");*/
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
            ?>
                <tr>
                    <td colspan="12" class="text-center">
                        <nav>
                            <ul class="pagination">
                                <li <?php if($this->pagina==1) {echo "class='disabled'";} ?> ><a href="index.php?pagina=1"><i class="material-icons">chevron_left</i></a></li>
                                <?php 
                                    for($this->j=1; $this->j<= $this->redondeoFinal; $this->j++) {
                                    ?>
                                        <li <?php if($this->pagina== $this->j){echo "class='active'";} ?>>
                                            <a class="waves-effect" href="index.php?pagina=<?php echo $this->j; ?>"><?php echo $this->j; ?></a>
                                        </li>
                                    <?php
                                    }                                    
                                ?>
                                <li <?php if($this->pagina==($this->j-1)) {echo "class='disabled'";} ?> >
                                    <a href="index.php?<?php echo $this->j-1 ;?>"><i class="material-icons">chevron_right</i></a>
                                </li>       
                            </ul>
                        </nav>
                    </td>
                </tr>  
            <?php
            $this->con->close();
        }
                 
    }
?>