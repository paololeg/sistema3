<?php
    include '../config/conexion.php';
    
    class operaciones extends conexion {
        
        public $i;
        public $consulta;
        public $datos;
        public $idOperacion;
        public $idOperacionDisponible;
        public $estado;
        public $buscar;
        public $idProducto;
        public $cantidadProducto;
        public $precio;
        public $venta;
        public $compra;
        public $subtotalventa;
        public $subtotalcosto;
        public $idRegistrante;
        public $consulta2;
        public $datos2;
        public $cantidad;
        public $cantidadDisponible;
        public $totalCosto;
        public $idDetalle;
        public $idCliente;
        public $idVendedor;
        public $totalVenta;
        public $condicionVenta;
        public $comprobanteTarjeta;
        public $fechaVenta;
        public $totalVentaNuevo;


        // metodo para iniciar una operacion
        
        public function iniciarOperacion() {
            $this->consulta= $this->con->query("SELECT * FROM operaciones ORDER BY idOperacion DESC LIMIT 1");
            while($this->datos = $this->consulta->fetch_array()){
                $this->idOperacion = $this->datos['idOperacion'];
                $this->idOperacionDisponible = $this->idOperacion +1;
                $this->estado = $this->datos['estado'];
                
                if($this->estado==0) {
                    echo "<script>window.location.href='formnuevo.php?idOperacion=$this->idOperacion'</script>";
                }
                else{
                    $this->con->query("INSERT INTO operaciones (idOperacion, estado) VALUES ('$this->idOperacionDisponible','0')");
                    echo "<script>window.location.href='formnuevo.php?idOperacion=$this->idOperacionDisponible';</script>";
                }
                
            }
        } 
        // metodo detalles
        
        public function detallesNuevaOperacion($bus, $idreg, $idop) {
            $this->buscar = $bus;
            $this->idRegistrante = $idreg;
            $this->idOperacion = $idop;
            $this->consulta = $this->con->query("SELECT * FROM productos WHERE codigo = '$this->buscar'");
            if(!isset($this->datos['idProducto'])) {
                echo "<script>alert('Código no encontrado'); window.location.href='formnuevo.php?idOperacion=$this->idOperacion'</script>";
            }
            else {
            if($this->datos = $this->consulta->fetch_array()) {
                $this->idProducto = $this->datos['idProducto'];
                $this->cantidad = $this->datos['cantidad'];
                $this->venta = $this->datos['precioVenta'];
                $this->compra = $this->datos['precioCompra'];
                
                if($this->cantidad==0) {
                    echo "<script>alert('El producto no tiene stock disponible'); window.location.href='formnuevo.php?idOperacion=$this->idOperacion'</script>";
                }
                else {
                    $this->cantidadProducto=1;
                    $this->subtotalventa = $this->venta * $this->cantidadProducto;
                    $this->subtotalcosto = $this->compra * $this->cantidadProducto;
                    $this->con->query("INSERT INTO detallesoperaciones (idOperacion, idProducto, cantidadPax, venta, costo,
                             idRegistrante) VALUES ('$this->idOperacion','$this->idProducto','$this->cantidadProducto',
                             '$this->subtotalventa','$this->subtotalcosto','$this->idRegistrante')");
                    $this->cantidadDisponible = $this->cantidad - $this->cantidadProducto;
                    $this->con->query("UPDATE productos SET cantidad ='$this->cantidadDisponible' WHERE idProducto='$this->idProducto'");
                    echo "<script>window.location.href='formnuevo.php?idOperacion=$this->idOperacion';</script>";
                    
                }
            }
            }
           
        }
         // método para mostrar los detalles de las ventas
            public  function mostrarOperaciones() {
                $this->consulta = $this->con->query("SELECT * FROM operaciones o
                                                    INNER JOIN usuarios u on u.idUsuario = o.idCliente
                                                    ORDER BY idOperacion DESC
                                                    LIMIT 10");
                $this->i=1;
                $this->totalVenta=0;
                $this->totalCosto=0;
                while ($this->datos = $this->consulta -> fetch_array()) {
                    ?>
                    <tr>
                        <td><?php echo $this->datos['idOperacion']; ?></td>
                        <td><?php echo $this->datos['u.apellido'].", ".$this->datos['u.nombre']; ?></td>
                        <td><?php echo $this->datos['cantidadPax']; ?></td>
                        <td><?php echo $this->datos['fechaSalida']; ?></td>
                        <td>$<?php echo $this->datos['venta']; ?></td>
                        <td>$<?php echo $this->datos['costo']; ?></td>
                        <td>$<?php echo $this->datos=$this->datos['estado']; ?></td>
                        <td><a 
                                class="btn btn-danger" 
                                onclick="return confirm('¿Desea eliminar este producto?')" 
                                href="quitar.php?idDetalle=<?php echo $this->datos['idDetalle'] ?>"
                            >Quitar</a></td>
                    </tr> 
                    <?php
                    $this->i++;
                    $this->totalVenta+= $this->subtotalventa;
                    $this->totalCosto+= $this->subtotalcosto;
                }                
            }
         // método para mostrar los detalles de las ventas
            public  function mostrarDetalles($idop) {
                $this->idOperacion= $idop;
                $this->consulta = $this->con->query("SELECT do.*, p.* FROM detallesoperaciones do 
                        INNER JOIN productos p on p.idProducto = do.idProducto
                        WHERE do.idOperacion = '$this->idOperacion'
                        ORDER BY do.idDetalle ASC");
                $this->i=1;
                $this->totalVenta=0;
                $this->totalCosto=0;
                while ($this->datos = $this->consulta -> fetch_array()) {
                    ?>
                    <tr>
                        <td><?php echo $this->i; ?></td>
                        <td><?php echo $this->datos['nombreProducto']; ?></td>
                        <td><?php echo $this->datos['cantidadPax']; ?></td>
                        <td>$<?php echo $this->datos['venta']; ?></td>
                        <td>$<?php echo $this->datos['costo']; ?></td>
                        <td>$<?php echo $this->subtotalventa=$this->datos['venta']*$this->datos['cantidadPax']; ?></td>                        
                        <td>$<?php echo $this->subtotalcosto=$this->datos['costo']*$this->datos['cantidadPax']; ?></td>
                        <td><a 
                                class="btn btn-danger" 
                                onclick="return confirm('¿Desea eliminar este producto?')" 
                                href="quitar.php?idDetalle=<?php echo $this->datos['idDetalle'] ?>"
                            >Quitar</a></td>
                    </tr> 
                    <?php
                    $this->i++;
                    $this->totalVenta+= $this->subtotalventa;
                    $this->totalCosto+= $this->subtotalcosto;
                }
                ?>
                    <tr>
                        <td colspan="5" class="text-right"><b>Total</b></td>
                        <td  class="text-left">$<?php echo $this->totalVenta; ?></td>
                        <td  class="text-left">$<?php echo $this->totalCosto; ?></td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-center">
                            <!-- AQUÍ PODRÍA DIRECCIONAR A LA EMISIÓN DE FACTURA PERO DEBERÍA AGREGAR UN IF POR SI ESTÁ FACTURADO -->
                            <a class="btn btn-warning" onclick="return confirm('¿Desea terminar la venta?')" href="finalizar.php?idOperacion=<?php echo $_GET['idOperacion']?>&totalVenta=<?php echo $this->total;  ?>">Terminar Venta</a>
                        </td>
                    </tr>
                <?php
            }
            // método para quitar productos
            public function quitar($iddo){
                $this->idDetalle= $iddo;
                $this->consulta= $this->con->query("SELECT * FROM detallesoperaciones WHERE idDetalle = '$this->idDetalle'");
                if($this->datos= $this->consulta->fetch_array()){
                    $this->idProducto = $this->datos['idProducto'];
                    $this->cantidadProducto = $this->datos['cantidadPax'];
                    $this->idOperacion= $this->datos['idOperacion'];
                    
                    $this->consulta2 = $this->con->query("SELECT cantidad FROM productos WHERE idProducto = '$this->idProducto'");
                    if($this->datos2= $this->consulta2->fetch_array()){
                        $this->cantidad= $this->datos2['cantidad'];
                    }
                    $this->cantidadDisponible= $this->cantidadProducto + $this->cantidad;
                    $this->con->query("UPDATE productos SET cantidad ='$this->cantidadDisponible'  WHERE idProducto='$this->idProducto' ");
                    $this->con->query("DELETE FROM detallesoperaciones WHERE idDetalle='$this->idDetalle'");
                    echo "<script>window.location.href='formnuevo.php?idoperacion=$this->idOperacion'</script>";
                    
                }
            }
            // método para cancelar toda la venta
            public function cancelar($ido){
                $this->idOperacion= $ido;
                $this->consulta= $this->con->query("SELECT * FROM detallesoperaciones WHERE idOperacion = '$this->idOperacion'");
                while ($this->datos= $this->consulta->fetch_array()){
                    $this->idProducto = $this->datos['idProducto'];
                    $this->cantidadProducto = $this->datos['cantidadPax'];                    
                    
                    $this->consulta2 = $this->con->query("SELECT cantidad FROM productos WHERE idProducto = '$this->idProducto'");
                    if($this->datos2=$this->consulta2->fetch_array()){
                        $this->cantidad= $this->datos2['cantidad'];
                    }
                    $this->cantidadDisponible= $this->cantidadProducto + $this->cantidad;
                    $this->con->query("UPDATE productos SET cantidad ='$this->cantidadDisponible'  WHERE idProducto='$this->idProducto' ");
                    $this->con->query("DELETE FROM detallesoperaciones WHERE idOperacion='$this->idOperacion'");
                    echo "<script>alert('Operación Cancelada');window.location.href='index.php'</script>";
                    
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
        //método para finalizar la venta ESTO PUEDO USAR PARA MANDAR A FACTURAR
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
        // metodo para seleccionar cliente
        public function selectCliente() {
            $this->consulta2= $this->con->query("SELECT * FROM usuarios WHERE privilegio = 4 ORDER BY apellido,nombre ASC");
            while ($this->datos2= $this->consulta2->fetch_array()) {
                ?>
                    <option value="<?php echo $this->datos2['idUsuario']; ?>"><?php echo $this->datos2['apellido'].", ".$this->datos2['nombre']; ?></option>
                <?php
            }
            $this->con->close();
        }
    }


?>

