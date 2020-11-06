<?php
    include '../config/conexion.php';
    
    class proveedores extends conexion {
        //atributos
        public $i;
        public $consulta;
        public $datos;
        public $buscar;
        public $tipo;
        public $usuario;
        public $password;
        public $encriptado;
        public $apellido;
        public $nombre;
        public $dni;
        public $email;
        public $nacimiento;
        public $domicilio;
        public $localidad;
        public $provincia;
        public $nacionalidad;
        public $telefono;
        public $sexo;
        public $privilegio;
        public $edad;
        public $idregistrante;

        //metodos
        //metodo de mostrar proveedores
        public function mostrarProveedores() {
            $this->consulta=$this->con->query("SELECT * FROM usuarios WHERE privilegio = 5 ORDER BY apellido ASC, nombre ASC");
            $this->i=1;
            while($this->datos= $this->consulta->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $this->i;?></td>
                        <td><?php echo $this->datos['apellido'].", ".$this->datos['nombre'];?></td>
                        <td><?php echo $this->datos['usuario'];?></td>
                        <td><?php echo $this->datos['dni'];?></td>
                        <td><?php echo $this->datos['edad'];?></td>
                        <td><?php echo $this->datos['domicilio'].", ".$this->datos['localidad'].", ".$this->datos['provincia'].", ".$this->datos['nacionalidad'];?></td>
                        <td><?php echo $this->datos['telefono'];?></td>
                        <td><?php echo $this->datos['email'];?></td>
                        <td>
                            <div class="row">
                                <a class="btn btn-primary btn-sm" href="vercuentaprov.php?idUsuario=<?php echo $this->datos['idUsuario'];?>&proveedor=<?php echo $this->datos['nombre'].", ".$this->datos['apellido']; ?>"><i class="material-icons">list</i></a>                                
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <a class="btn btn-success btn-sm" href="formmodificar.php?idUsuario=<?php echo $this->datos['idUsuario'];?>"><i class="material-icons">create</i></a>
                                <a class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este registro?')" href="formeliminar.php?idUsuario=<?php echo $this->datos['idUsuario'];?>"><i class="material-icons">delete</i></a>
                            </div>
                        </td>
                    </tr> 
              <?php  
                $this->i++;
            }
            $this->con->close();
        }
        // metodo de busqueda o filtro
        public function filtro($bus,$tip) {
            $this->buscar=$bus;
            $this->tipo=$tip;
            
            if($this->buscar == NULL) {    
                
                $objetoMostrarProveedores = new proveedores();
                $objetoMostrarProveedores->mostrarProveedores();
            }
            else {
                switch ($this->tipo){
                    case 'apellido': $this->consulta=$this->con->query("SELECT * FROM usuarios WHERE apellido LIKE '%$this->buscar%' ORDER BY apellido ASC, nombre ASC");
                        break;
                    case 'dni': $this->consulta=$this->con->query("SELECT * FROM usuarios WHERE dni = '$this->buscar'");
                        break;
                    case 'telefono': $this->consulta=$this->con->query("SELECT * FROM usuarios WHERE telefono = '$this->buscar' ORDER BY apellido ASC, nombre ASC");
                        break;
                }
                $this->i=1;
                while($this->datos= $this->consulta->fetch_array()) {
                    ?>
                        <tr>
                            <td><?php echo $this->i;?></td>
                            <td><?php echo $this->datos['apellido'].", ".$this->datos['nombre'];?></td>
                            <td><?php echo $this->datos['usuario'];?></td>
                            <td><?php echo $this->datos['dni'];?></td>
                            <td><?php echo $this->datos['edad'];?></td>
                            <td><?php echo $this->datos['domicilio'];?></td>
                            <td><?php echo $this->datos['telefono'];?></td>
                            <td><?php echo $this->datos['email'];?></td>
                            <td><?php echo $this->datos['sexo'];?></td>
                            <td><?php echo $this->datos['privilegio'];?></td>
                            <td>
                                <div class="row">
                                    <a class="btn btn-success btn-sm" href="formmodificar.php?idUsuario=<?php echo $this->datos['idUsuario'];?>"><i class="material-icons">create</i></a>
                                    <a class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este registro?')" href="formeliminar.php?idUsuario=<?php echo $this->datos['idUsuario'];?>"><i class="material-icons">delete</i></a>
                                </div>
                            </td>
                        </tr> 
                  <?php  
                    $this->i++;
                }
                $this->con->close();                
            }
        }
               
        //metodo guardar
        public $consultadni;
        public $consultausuario;
        public $consultaemail;
        public $d;
        public $cu;
        public $ce;
        public $detalle;
        public $debe;
        public $haber;
        public $proveedor;
        
        public function  guardar($idusu,$prov,$det,$deb,$hab){
            include '../config/horasistema.php';
            $this->idusuario=$idusu;
            $this->proveedor=$prov;
            $this->detalle=$det;
            $this->debe=$deb;
            $this->haber=$hab; 
            
                        
            $this->consulta=$this->con->query("INSERT INTO cuentaproveedor (idUsuario,fecha,detalle,debe,haber) VALUES ('$this->idusuario',NOW(),
               '$this->detalle','$this->debe','$this->haber')");
                echo "<script>alert('Movimiento Registrado');window.location.href='vercuentaprov.php?idUsuario=$this->idusuario&proveedor=$this->proveedor';</script>";
            $this->con->close();
        
        }
        // metodo mostrar datos a modificar
        public $idCuentaProveedor;
        public function datosmodificar($idcp) {
            $this->idCuentaProveedor=$idcp;           
            $this->consulta= $this->con->query("SELECT * FROM cuentaproveedor WHERE idCuentaProveedor ='$this->idCuentaProveedor'");            
            if($this->datos=$this->consulta->fetch_array()){
                ?>
                    <div class="row clearfix">
                        <div class="col-md-2">
                            <label for="tipomovimiento">Tipo Movimiento</label>
                            <select class="form-control show-tick" name="tipomovimiento" id="tipomovimiento" required="">                                
                                <option value="1" <?php if($this->datos['haber']==0){echo "selected='selected'";} ?>>Crédito</option>
                                <option value="2" <?php if($this->datos['debe']==0){echo "selected='selected'";} ?>>Pago</option>
                            </select>
                        </div>
                        <div class=" col-md-4">
                            <div class="form-group">
                                <label for="detalle">Detalle</label>
                                <input type="text" class="form-control" id="detalle" name="detalle" value="<?php echo $this->datos['detalle']?>" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="debe">Debe</label>
                                <input type="number" step="any" class="form-control" id="debe" name="debe" value="<?php echo $this->datos['debe']?>" <?php if ($this->datos['debe']==0){echo "disabled='true'";}?> required="">
                            </div>  
                        </div>   
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="haber">Haber</label>
                                <input type="number" step="any" class="form-control" id="haber" name="haber" value="<?php echo $this->datos['haber']?>" <?php if ($this->datos['haber']==0){echo "disabled='true'";}?> required="">
                            </div>
                        </div>                      
                    </div>                    
                <?php       
            }
            $this->con->close();
        }
        //metodo confirmar modificacion
        public function confirmarmodificacion($idcp,$idusu,$prov,$det,$deb,$hab){
            $this->idCuentaProveedor=$idcp;
            $this->idUsuario=$idusu;
            $this->proveedor=$prov;
            $this->detalle=$det;
            $this->debe=$deb;
            $this->haber=$hab;                    
            
            $this->consulta = $this->con->query("UPDATE cuentaproveedor SET detalle='$this->detalle', debe='$this->debe',
                                                                            haber='$this->haber'
                                                WHERE idCuentaProveedor ='$this->idCuentaProveedor'");
             
            echo "<script>alert('Movimiento Modificado');window.location.href='vercuentaprov.php?idUsuario=$this->idUsuario&proveedor=$this->proveedor'</script>";
            $this->con->close();
        }
        // metodo eliminar usuario
        public function eliminarMovimiento($idcp,$idusu,$prov){
            $this->idCuentaProveedor=$idcp;
            $this->idUsuario=$idusu;
            $this->proveedor=$prov;
            $this->consulta= $this->con->query("DELETE FROM cuentaproveedor WHERE idCuentaProveedor='$this->idCuentaProveedor'");
            $this->con->close();
            echo "<script>alert('Movimiento eliminado');window.location.href='vercuentaprov.php?idUsuario=$this->idUsuario&proveedor=$this->proveedor'</script>";
        }
        //  metodo para mostrar la cuenta del proveedor
        public $sumaDebe;
        public $sumaHaber;
        public function mostrarCuentaProveedor($idusu){
            $this->idusuario = $idusu ;
            $this->consulta = $this->con->query("SELECT * FROM cuentaproveedor WHERE idUsuario = $this->idusuario");
            $this->i=1;
            $this->sumaDebe=0;
            $this->sumaHaber=0;
            while ($this->datos= $this->consulta->fetch_array()) {
                $this->sumaDebe += $this->datos['debe'];
                $this->sumaHaber += $this->datos['haber'];
                ?>
                    <tr>
                        <td><?php echo $this->i; ?></td>
                        <td><?php echo $this->datos['fecha']; ?></td>
                        <td><?php echo $this->datos['detalle']; ?></td>
                        <td><?php echo $this->datos['debe']; ?></td>
                        <td><?php echo $this->datos['haber']; ?></td>
                        <td><?php echo $this->sumaDebe - $this->sumaHaber; ?></td>                        
                        <td>
                            <div class="row">
                                <a class="btn btn-success btn-sm" href="formmodificar.php?idCuentaProveedor=<?php echo $this->datos['idCuentaProveedor'];?>&idUsuario=<?php echo $_GET['idUsuario'];?>&proveedor=<?php echo$_GET['proveedor'];?>"><i class="material-icons">create</i></a>
                                <a class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este registro?')" href="formeliminar.php?idCuentaProveedor=<?php echo $this->datos['idCuentaProveedor'];?>&idUsuario=<?php echo $_GET['idUsuario'];?>&proveedor=<?php echo$_GET['proveedor'];?>"><i class="material-icons">delete</i></a>
                            </div>
                        </td>
                    </tr>      
                        
                        
                <?php    
                $this->i ++;
            }
        }
    }
?>