<?php
    include '../config/conexion.php';
    
    class ventas extends conexion {
        
        public $i;
        public $consulta;
        public $datos;
        public $idFactura;
        public $idFacturaDisponible;
        public $estado;
        public $buscar;
        public $idProducto;
        public $cantidadProducto;
        public $precio;
        public $subtotal;
        public $idRegistrante;
        public $consulta2;
        public $datos2;
        public $cantidad;
        public $cantidadDisponible;
        public $total;
        public $idDetalle;
        public $idCliente;
        public $idVendedor;
        public $totalVenta;
        public $condicionVenta;
        public $comprobanteTarjeta;
        public $fechaVenta;
        public $totalVentaNuevo;


        // metodo para iniciar una factura
        
        public function iniciarFactura() {
            $this->consulta= $this->con->query("SELECT * FROM facturas ORDER BY idFactura DESC LIMIT 1");
            while($this->datos = $this->consulta->fetch_array()){
                $this->idFactura = $this->datos['idFactura'];
                $this->idFacturaDisponible = $this->idFactura +1;
                $this->estado = $this->datos['estado'];
                
                if($this->estado==0) {
                    echo "<script>window.location.href='index.php?idFactura=$this->idFactura'</script>";
                }
                else{
                    $this->con->query("INSERT INTO facturas (idFactura, estado) VALUES ('$this->idFacturaDisponible','0')");
                    echo "<script>window.location.href='index.php?idFactura=$this->idFacturaDisponible';</script>";
                }
                
            }
        } 
        // metodo detalles
        
        public function detallesNuevaVenta($bus, $idreg, $idfac) {
            $this->buscar = $bus;
            $this->idRegistrante = $idreg;
            $this->idFactura = $idfac;
            $this->consulta = $this->con->query("SELECT * FROM productos WHERE codigo = '$this->buscar'");
            if($this->datos = $this->consulta->fetch_array()) {
                $this->idProducto = $this->datos['idProducto'];
                $this->cantidad = $this->datos['cantidad'];
                $this->precio = $this->datos['precioVenta'];
                
                if($this->cantidad==0) {
                    echo "<script>alert('El producto no tiene stock disponible'); window.location.href='index.php?idFactura=$this->idFactura'</script>";
                }
                else {
                    $this->cantidadProducto=1;
                    $this->subtotal = $this->precio * $this->cantidadProducto;
                    $this->con->query("INSERT INTO detallesfacturas (idFactura, idProducto, cantidadProducto, precio, subtotal,
                             idRegistrante) VALUES ('$this->idFactura','$this->idProducto','$this->cantidadProducto',
                             '$this->precio','$this->subtotal','$this->idRegistrante')");
                    $this->cantidadDisponible = $this->cantidad - $this->cantidadProducto;
                    $this->con->query("UPDATE productos SET cantidad ='$this->cantidadDisponible' WHERE idProducto='$this->idProducto'");
                    echo "<script>window.location.href='index.php?idFactura=$this->idFactura';</script>";
                }
            }
           
        }
         // método para mostrar los detalles de las ventas
            public  function mostrarDetalles($idfac) {
                $this->idFactura = $idfac;
                $this->consulta = $this->con->query("SELECT df.*, p.* FROM detallesfacturas df 
                        INNER JOIN productos p on p.idProducto = df.idProducto
                        WHERE df.idFactura = '$this->idFactura'
                        ORDER BY df.idDetalle ASC");
                $this->i=1;
                $this->total=0;
                while ($this->datos = $this->consulta -> fetch_array()) {
                    ?>
                    <tr>
                        <td><?php echo $this->i; ?></td>
                        <td><?php echo $this->datos['nombreProducto']; ?></td>
                        <td><?php echo $this->datos['cantidadProducto']; ?></td>
                        <td>$<?php echo $this->datos['precio']; ?></td>
                        <td>$<?php echo $this->subtotal=$this->datos['precio']*$this->datos['cantidadProducto']; ?></td>
                        <td><a 
                                class="btn btn-danger" 
                                onclick="return confirm('¿Desea eliminar este producto?')" 
                                href="quitar.php?idDetalle=<?php echo $this->datos['idDetalle'] ?>"
                            >Quitar</a></td>
                    </tr> 
                    <?php
                    $this->i++;
                    $this->total+= $this->subtotal;
                }
                ?>
                    <tr>
                        <td colspan="5" class="text-right"><b>Total</b></td>
                        <td colspan="2" class="text-left">$<?php echo $this->total; ?></td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-center">
                            <a class="btn btn-warning" onclick="return confirm('¿Desea terminar la venta?')" href="finalizar.php?idFactura=<?php echo $_GET['idFactura']?>&totalVenta=<?php echo $this->total;  ?>">Terminar Venta</a>
                        </td>
                    </tr>
                <?php
            }
            // método para quitar productos
            public function quitar($iddf){
                $this->idDetalle= $iddf;
                $this->consulta= $this->con->query("SELECT * FROM detallesfacturas WHERE idDetalle = '$this->idDetalle'");
                if($this->datos= $this->consulta->fetch_array()){
                    $this->idProducto = $this->datos['idProducto'];
                    $this->cantidadProducto = $this->datos['cantidadProducto'];
                    $this->idFactura= $this->datos['idFactura'];
                    
                    $this->consulta2 = $this->con->query("SELECT cantidad FROM productos WHERE idProducto = '$this->idProducto'");
                    if($this->datos2= $this->consulta2->fetch_array()){
                        $this->cantidad= $this->datos2['cantidad'];
                    }
                    $this->cantidadDisponible= $this->cantidadProducto + $this->cantidad;
                    $this->con->query("UPDATE productos SET cantidad ='$this->cantidadDisponible'  WHERE idProducto='$this->idProducto' ");
                    $this->con->query("DELETE FROM detallesfacturas WHERE idDetalle='$this->idDetalle'");
                    echo "<script>window.location.href='index.php?idFactura=$this->idFactura'</script>";
                    
                }
            }
            // método para cancelar toda la venta
            public function cancelar($idf){
                $this->idFactura= $idf;
                $this->consulta= $this->con->query("SELECT * FROM detallesfacturas WHERE idFactura = '$this->idFactura'");
                while ($this->datos= $this->consulta->fetch_array()){
                    $this->idProducto = $this->datos['idProducto'];
                    $this->cantidadProducto = $this->datos['cantidadProducto'];                    
                    
                    $this->consulta2 = $this->con->query("SELECT cantidad FROM productos WHERE idProducto = '$this->idProducto'");
                    if($this->datos2=$this->consulta2->fetch_array()){
                        $this->cantidad= $this->datos2['cantidad'];
                    }
                    $this->cantidadDisponible= $this->cantidadProducto + $this->cantidad;
                    $this->con->query("UPDATE productos SET cantidad ='$this->cantidadDisponible'  WHERE idProducto='$this->idProducto' ");
                    $this->con->query("DELETE FROM detallesfacturas WHERE idFactura='$this->idFactura'");
                    echo "<script>alert('Factura Cancelada');window.location.href='../acceso/plantilla.php'</script>";
                    
                }
            }
             // metodo para seleccionar categorias
        public function selectTarjetas() {
            $this->consulta2= $this->con->query("SELECT * FROM tarjetas ORDER BY nombreTarjeta ASC");
            while ($this->datos2= $this->consulta2->fetch_array()) {
                ?>
                    <option value="<?php echo $this->datos2['idTarjeta']; ?>"><?php echo $this->datos2['nombreTarjeta']; ?></option>
                <?php
            }
            $this->con->close();
        }
        // método para mostar vendedores en la carga de facturas
        public function vendedor() {
            $this->consulta= $this->con->query("SELECT * FROM usuarios WHERE privilegio = '6' ORDER BY apellido, nombre ASC");
            while ($this->datos= $this->consulta->fetch_array()) {
                ?>
                    <option value="<?php echo $this->datos['idUsuario']; ?>"><?php echo $this->datos['apellido'].", ".$this->datos['nombre']; ?></option>
                <?php    
            }
        }
        // método para buscar clientes
        public function cliente() {
            $this->consulta= $this->con->query("SELECT * FROM usuarios WHERE privilegio = '4' ORDER BY apellido, nombre ASC");
            while ($this->datos= $this->consulta->fetch_array()) {
                ?>
                    <option value="<?php echo $this->datos['idUsuario']; ?>"><?php echo $this->datos['apellido'].", ".$this->datos['nombre']; ?></option>
                <?php    
            }
        }
        //método para finalizar la venta
        public function finalizarVenta($idf,$idc,$idv,$cv,$ct,$tv,$idr){
            include '../config/horasistema.php';
            $this->idFactura=$idf;
            $this->idCliente=$idc;
            $this->idVendedor=$idv;
            $this->condicionVenta=$cv;
            $this->comprobanteTarjeta=$ct;         
            $this->totalVenta=$tv;            
            $this->fechaVenta=date("Y-m-d H:i:s");   
            $this->idRegistrante=$idr;
            $this->estado=2;
            
            $this->consulta2= $this->con->query("SELECT * FROM tarjetas WHERE idTarjeta ='$this->condicionVenta'");
            while($this->datos2=$this->consulta2->fetch_array()) {
                $this->totalVentaNuevo = $this->totalVenta + (($this->totalVenta/100)*$this->datos2['interes']);
            }
            
            $this->consulta=$this->con->query("UPDATE facturas SET idCliente ='$this->idCliente',idVendedor='$this->idVendedor',
                    condicionVenta='$this->condicionVenta',comprobanteTarjeta='$this->comprobanteTarjeta',
                    totalVenta='$this->totalVentaNuevo',fechaVenta='$this->fechaVenta',idRegistrante='$this->idRegistrante',estado='$this->estado'
                    WHERE idFactura='$this->idFactura'");
            
            echo "<script>alert('Factura terminada'); window.location.href='../acceso/plantilla.php'</script>";
            
        }
    }


?>

