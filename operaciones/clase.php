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
        public $salida;
        public $regreso;
        public $cantidadPax;
        public $descripcion;
        public $idCategoria;


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
        
        public function agregarDetalle($idprod, $cantprod, $idreg, $idop) {
            $this->idProducto = $idprod;
            $this->cantidadProducto = $cantprod;
            $this->idRegistrante = $idreg;
            $this->idOperacion = $idop;
            $this->consulta = $this->con->query("SELECT * FROM productos WHERE idProducto = '$this->idProducto'");
                
                if($this->datos = $this->consulta->fetch_array()) {
                    $this->idProducto = $this->datos['idProducto'];
                    $this->cantidad = $this->datos['cantidad'];
                    $this->venta = $this->datos['precioVenta'];
                    $this->compra = $this->datos['precioCompra'];

                    if($this->cantidad==0) {
                      echo"<script>alert('Producto sin stock');window.location.href='formmodificar.php?idOperacion=$this->idOperacion';</script>";
                    }
                    elseif ($this->cantidad<$this->cantidadProducto) {
                      echo"<script>alert('Producto sin stock suficiente - DISPONIBLE: $this->cantidad');window.location.href='formmodificar.php?idOperacion=$this->idOperacion';</script>";

                    }
                    else {
                        $this->subtotalventa = $this->venta * $this->cantidadProducto;
                        $this->subtotalcosto = $this->compra * $this->cantidadProducto;
                        $this->con->query("INSERT INTO detallesoperaciones (idOperacion, idProducto, cantidadPax, subVenta, subCosto,
                                 idRegistrante) VALUES ('$this->idOperacion','$this->idProducto','$this->cantidadProducto',
                                 '$this->subtotalventa','$this->subtotalcosto','$this->idRegistrante')");
                        $this->cantidadDisponible = $this->cantidad - $this->cantidadProducto;
                        $this->con->query("UPDATE productos SET cantidad ='$this->cantidadDisponible' WHERE idProducto='$this->idProducto'");
                        echo "<script>window.location.href='formmodificar.php?idOperacion=$this->idOperacion';</script>";

                    }
                }
        }
         // método para mostrar los detalles de las ventas
            public  function mostrarOperaciones() {
                $this->consulta = $this->con->query("SELECT * FROM operaciones o
                                                    INNER JOIN usuarios u on u.idUsuario = o.idCliente
                                                    WHERE estado <> 0
                                                    ORDER BY idOperacion DESC
                                                    LIMIT 10");
                //$this->i=1;
                //$this->totalVenta=0;
                //$this->totalCosto=0;
                while ($this->datos = $this->consulta ->fetch_array()) {
                    ?>
                    <tr>
                        <td><?php echo $this->datos['idOperacion']; ?></td>
                        <td><?php echo $this->datos['apellido'].", ".$this->datos['nombre']; ?></td>
                        <td><?php echo $this->datos['cantidadPax']; ?></td>
                        <td><?php echo $this->datos['salida']; ?></td>
                        <td>$<?php echo $this->datos['venta']; ?></td>
                        <td>$<?php echo $this->datos['costo']; ?></td>
                        <td><?php echo $this->datos['estado']; ?></td>
                        <td>
                            <div class="row">
                                <a class="btn btn-success btn-sm" href="formmodificar.php?idOperacion=<?php echo $this->datos['idOperacion']; ?>"><i class="material-icons">create</i></a>
                                <a class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este registro?')" href="formeliminar.php?idOperacion=<?php echo $this->datos['idOperacion'];?>"><i class="material-icons">delete</i></a>
                            </div>
                        </td>
                    </tr> 
                    <?php
                    $this->i++;
                    $this->totalVenta+= $this->subtotalventa;
                    $this->totalCosto+= $this->subtotalcosto;
                }                
            }
         // método para mostrar los detalles de servicios asociados a la operación
            public  function mostrarDetalles($idop) {
                $this->idOperacion= $idop;
                $this->consulta2 = $this->con->query("SELECT do.*, p.*, c.* 
                                                        FROM detallesoperaciones do 
                                                        INNER JOIN productos p on p.idProducto = do.idProducto
                                                        INNER JOIN categorias c on c.idCategoria = p.idCategoria
                                                        WHERE do.idOperacion = '$this->idOperacion'
                                                        ORDER BY do.idDetalle ASC");
                $this->i=1;
                $this->totalVenta=0;
                $this->totalCosto=0;
                while ($this->datos2 = $this->consulta2 -> fetch_array()) {
                    ?>                    
                    <tr>
                        <td><?php echo $this->i; ?></td>
                        <td><?php echo $this->datos2['nombreCategoria']; ?></td>
                        <td><?php echo $this->datos2['nombreProducto']; ?></td>
                        <td><?php echo $this->datos2['cantidadPax']; ?></td>
                        <td>$<?php echo $this->datos2['precioVenta']; ?></td>
                        <td>$<?php echo $this->datos2['precioCompra']; ?></td>
                        <td>$<?php echo $this->subtotalventa = $this->datos2['subVenta'] ;?></td>                        
                        <td>$<?php echo $this->subtotalcosto = $this->datos2['subCosto'] ;?></td>
                        <td></td>
                    </tr> 
                    <?php
                    $this->i++;
                    $this->totalVenta+= $this->subtotalventa;
                    $this->totalCosto+= $this->subtotalcosto;
                }         
                ?>
                    <tr>
                        <td colspan="6" class="text-right"><b>Total</b></td>
                        <td  class="text-left">$<?php echo $this->totalVenta; ?></td>
                        <td  class="text-left">$<?php echo $this->totalCosto; ?></td>
                    </tr>
                <?php
            }
            // muestra detalles en el modal de edición de servicios
            public  function mostrarDetallesModal($idop) {
                $this->idOperacion= $idop;
                $this->consulta2 = $this->con->query("SELECT do.*, p.* FROM detallesoperaciones do 
                        INNER JOIN productos p on p.idProducto = do.idProducto
                        WHERE do.idOperacion = '$this->idOperacion'
                        ORDER BY do.idDetalle ASC");
                $this->i=1;
                $this->totalVenta=0;
                $this->totalCosto=0;
                while ($this->datos2 = $this->consulta2 -> fetch_array()) {
                    ?>                    
                    <tr>
                        <td><?php echo $this->i; ?></td>
                        <td><?php echo $this->datos2['nombreProducto']; ?></td>
                        <td><?php echo $this->datos2['cantidadPax']; ?></td>
                        <td>$<?php echo $this->datos2['precioVenta']; ?></td>
                        <td>$<?php echo $this->datos2['precioCompra']; ?></td>
                        <?php  $this->subtotalventa = $this->datos2['subVenta'] ;?>                       
                        <?php  $this->subtotalcosto = $this->datos2['subCosto'] ;?>
                        <td><a 
                                class="btn btn-danger" 
                                onclick="return confirm('¿Desea eliminar este producto?')" 
                                href="quitar.php?idDetalle=<?php echo $this->datos2['idDetalle'] ?>"
                            >Quitar</a></td>
                    </tr> 
                    <?php
                    $this->i++;
                    $this->totalVenta+= $this->subtotalventa;
                    $this->totalCosto+= $this->subtotalcosto;
                }
                
                $this->con->query("UPDATE operaciones SET venta='$this->totalVenta', costo='$this->totalCosto' WHERE idOperacion = '$this->idOperacion'");
            }
            // método para guardar operacion
            public function  guardar($idop,$idreg,$idcli,$sal,$reg,$cantpax,$desc){
            include '../config/horasistema.php';
            $this->idOperacion = $idop;
            $this->idRegistrante = $idreg;
            $this->idCliente = $idcli;
            $this->salida = $sal;
            $this->regreso = $reg;
            $this->cantidadPax = $cantpax;
            $this->descripcion = $desc;
            $this->estado= 1;
            
                                    
            $this->consulta=$this->con->query("UPDATE operaciones SET idCliente='$this->idCliente',
                                                descripcion='$this->descripcion',idRegistrante='$this->idRegistrante',
                                                salida='$this->salida',regreso='$this->regreso',cantidadPax='$this->cantidadPax', 
                                                estado='$this->estado',fechaCarga=NOW(),fechaActualizacion=NOW() 
                                                WHERE idOperacion = '$this->idOperacion'");
                echo "<script>alert('Operación Guardada');window.location.href='formmodificar.php?idOperacion=$this->idOperacion';</script>";
            $this->con->close();
        
            }
            // metodo para modificar operacion
            public function datosmodificar($idop) {
            $this->idOperacion=$idop;           
            $this->consulta= $this->con->query("SELECT * FROM operaciones o 
                                                INNER JOIN usuarios u on u.idUsuario = o.idCliente
                                                WHERE idOperacion ='$this->idOperacion'");            
            if($this->datos=$this->consulta->fetch_array()){
                ?>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 p-r-5">
                        <label>Cliente</label>
                        <select name="idCliente" style="height: 28px">
                            <option value="<?php echo $this->datos['idCliente'] ;?>" selected='selected'><?php echo $this->datos['apellido'].", ".$this->datos['nombre'];?></option> 
                            <?php                                      
                             $objetoOption = new operaciones();
                             $objetoOption->selectCliente();
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-8 col-xs-8">
                        <label for="salida">Salida</label>
                        <input type="date" id="salida" name="salida" class="text-center" value="<?php echo $this->datos['salida'];?>" onchange="validarFecha()" required="" >
                    </div> 
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <label for="regreso">Regreso</label>
                        <input type="date" id="regreso" name="regreso" class="text-center"value="<?php echo $this->datos['regreso'];?>" onchange="validarFecha()" required="">  
                    </div>
                </div>
                <br>
                <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label" style="padding-left: 0 auto">
                        <label class="p-l-0" for="pax">Cantidad Pax</label>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="cantidadPax" class="form-control" value="<?php echo $this->datos['cantidadPax'] ;?>"  min="1" pattern="^[0-9]+" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label ">
                        <label for="descripcion">Descripción</label>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-8 col-xs-8">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="descripcion" class="form-control" value="<?php echo $this->datos['descripcion'];?>" >
                            </div>
                        </div>
                    </div>
                <?php                    
            }
            $this->con->close();
            }
            public function confirmarmodificacion($idop,$idreg,$idcli,$sal,$reg,$cantpax,$desc){
            include '../config/horasistema.php';
            $this->idOperacion = $idop;
            $this->idRegistrante = $idreg;
            $this->idCliente = $idcli;
            $this->salida = $sal;
            $this->regreso = $reg;
            $this->cantidadPax = $cantpax;
            $this->descripcion = $desc;
                                    
            $this->consulta=$this->con->query("UPDATE operaciones SET idCliente='$this->idCliente',
                                                descripcion='$this->descripcion',idRegistrante='$this->idRegistrante',
                                                salida='$this->salida',regreso='$this->regreso',cantidadPax='$this->cantidadPax', 
                                                fechaActualizacion=NOW() 
                                                WHERE idOperacion = '$this->idOperacion'");
            
            echo "<script>alert('Operación Modificada');window.location.href='index.php'</script>"; 
            $this->con->close();
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
                    echo "<script>window.location.href='formmodificar.php?idOperacion=$this->idOperacion'</script>";
                    
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
        // metodo para seleccionar categorias        
        public function selectCategorias() {
            $this->consulta2= $this->con->query("SELECT * FROM categorias ORDER BY nombreCategoria ASC");
            while ($this->datos2= $this->consulta2->fetch_array()) {
                ?>
                    <option id="idCategoria" name="idCategoria" value="<?php echo $this->datos2['idCategoria']; ?>"><?php echo $this->datos2['nombreCategoria']; ?></option>
                <?php
            }
            $this->con->close();
        }
        // metodo para mostrar option productos
        public function mostrarProductos($idcat) {
            $this->idCategoria = $idcat;
            $this->consulta= $this->con->query("SELECT * FROM productos WHERE idCategoria='$this->idCategoria'  ORDER BY nombreProducto ASC");
            ?>
                 <option>--Productos--</option>   
            <?php
            while ($this->datos= $this->consulta->fetch_array()) {
                ?>
                    <option value="<?php echo $this->datos['idProducto']; ?>"><?php echo $this->datos['nombreProducto']; ?></option>
                <?php
            }
        }
        // metodo para mostrar alert stock cero
        public function stockcero($cant){
            $this->cantidad = $cant;
            if($this->cantidad==0){
                ?>
                    <div class="alert bg-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        PRODUCTO SIN STOCK
                    </div>
                <?php   
            }
            
        }
        // metodo para mostrar saldo de operacion
        public $acumPago;
        public $saldoOperacion;
        public function mostrarSaldo($id){
            $this->idOperacion = $id;
            $this->acumPago = 0;
            
            $this->consulta= $this->con->query("SELECT importeIngreso FROM ingresos WHERE idOperacion='$this->idOperacion'")  ;
            
            while ($this->datos = $this->consulta->fetch_array()) {
             $this->acumPago += $this->datos['importeIngreso'];
                
            }
            $this->consulta2= $this->con->query("SELECT venta FROM operaciones WHERE idOperacion = '$this->idOperacion'");
            $this->datos2 = $this->consulta2->fetch_array();
            $this->saldoOperacion = $this->datos2['venta'] - $this->acumPago;
                
                            
            echo $this->saldoOperacion;
        }
    }


?>

