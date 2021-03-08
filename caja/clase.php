<?php
    include '../config/conexion.php';
    
    class Caja extends conexion{
        public $idCaja;
        public $ultimacaja;
        public $idUsuario;
        public $importeCaja;
        public $fechaCaja;
        public $horaCaja;
        public $consulta;
        public $consulta2;
        public $datos;
        public $datos2;
        public $sumar;
        public $i;
        public $buscar;
        public $descripcionIngreso;
        public $importeIngreso;
        public $fechaIngreso;
        public $horaIngreso;
        public $fechaDesde;
        public $fechaHasta;
        public $cantidadMostrar;
        public $pagina;
        public $cantidadTotalRegistros;
        public $redondeoFinal;
        public $consultaMostrar;
        public $j;
        public $idOperacion;
        public $tipoIngreso;
        public $idRegistrante;
        public $tipoValor;
        public $moneda;
        public $numeroComprobante;
        public $anulado;
        public $idIngreso;


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
        //metodo para mostrar última caja
        public function ultimaCaja(){
            $this->consulta=$this->con->query("SELECT * FROM caja ORDER BY idCaja DESC LIMIT 1");
            $this->datos= $this->consulta->fetch_array();
            $this->ultimaCaja = $this->datos['idCaja'];
            echo "<script>window.location.href='index.php?idCaja=$this->ultimaCaja'</script>";
            $this->con->close();
        }
        //metodo para mostrar ingresos
       public function mostrarIngresos($idc) {
            $this->idCaja = $idc;
            $this->consulta= $this->con->query("SELECT * 
                                                FROM ingresos
                                                WHERE idCaja='$this->idCaja' 
                                                ORDER BY idIngreso ASC");
            
            $this->i=1;
            while($this->datos= $this->consulta->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $this->i;?></td>
                        <td><?php echo $this->datos['fechaIngreso'];?></td>
                        <td><?php echo $this->datos['tipoIngreso'];?></td>
                        <td><?php echo $this->datos['tipoValor'];?></td> 
                        <td><?php echo $this->datos['descripcionIngreso'];?></td> 
                        <td><?php echo $this->datos['importeIngreso'];?></td> 
                        <td>
                            <div class="row">
                                <a class="btn btn-success btn-sm" href="formmodificaringreso.php?idIngreso=<?php echo $this->datos['idIngreso'];?>"><i class="material-icons">create</i></a>
                                <a class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este registro?')" href="formeliminaringreso.php?idIngreso=<?php echo $this->datos['idIngreso'];?>"><i class="material-icons">delete</i></a>
                                <a class="btn btn-primary btn-sm" href="imprimiringreso.php?idIngreso=<?php echo $this->datos['idIngreso'];?>"><i class="material-icons">print</i></a>
                            </div>
                        </td>
                    </tr> 
              <?php  
                $this->i++;
            }
            $this->con->close();
        }
        // metodo guardar ingreso
        public function  guardarIngreso($idcaja, $tipin, $idop, $mon, $numcom, $desc, $imp,$tipo, $idreg ){
            include '../config/horasistema.php';
            date_default_timezone_set("america/argentina/tucuman");  
            $this->idCaja=$idcaja; 
            $this->tipoIngreso = $tipin;
            $this->idOperacion=$idop;
            $this->moneda = $mon;
            $this->numeroComprobante = $numcom;
            $this->descripcionIngreso = $desc;
            $this->importeIngreso = $imp;
            $this->tipoValor = $tipo;
            $this->idRegistrante = $idreg;
            $this->fechaIngreso;
            $this->horaIngreso=date("H:i:s");
            $this->anulado=0;
           
            $this->consulta=$this->con->query("INSERT INTO ingresos (idCaja,tipoIngreso,idOperacion,moneda,numeroComprobante,
                                                descripcionIngreso,importeIngreso,tipoValor,fechaIngreso, horaIngreso, anulado,idRegistrante) 
                                               VALUES ('$this->idCaja','$this->tipoIngreso','$this->idOperacion','$this->moneda','$this->numeroComprobante',
                                                '$this->descripcionIngreso','$this->importeIngreso','$this->tipoValor',NOW(),'$this->horaIngreso',
                                             '$this->anulado','$this->idRegistrante')");
            
            echo "<script>alert('Ingreso Registrado');window.location.href='ultimacaja.php';</script>";
            
        }
        // metodo modificar ingreso
        public function modificarIngreso($id) {
            $this->idIngreso=$id;
            $this->consulta= $this->con->query("SELECT * FROM ingresos WHERE idIngreso ='$this->idIngreso'");            
            if($this->datos=$this->consulta->fetch_array()){
                ?>
                    <div class="row clearfix">
                        <div class=" col-md-3">
                            <div class="form-group">
                                <label for="tipoIngreso">Tipo</label>
                                    <option value="recibo"<?php if($this->datos['tipoIngreso']=='recibo'){echo "selected='selected'";} ?>>Recibo</option>
                                    <option value="manual"<?php if($this->datos['tipoIngreso']=='manual'){echo "selected='selected'";} ?>>Ingreso Manual</option
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="importeIngreso">Importe</label>
                                <input type="number" step="any" value="<?php echo $this->datos['importeIngreso']; ?>" class="form-control" id="importeIngreso" name="importeIngreso"  required="">
                            </div>
                            <div class="form-group">
                                <label for="numeroComprobante">Nº Comprobante</label>
                                <input type="number" step="any" value="<?php echo $this->datos['numeroComprobante']; ?>" class="form-control" id="numeroComprobante" name="numeroComprobante">
                            </div>
                        </div>
                        <div class=" col-lg-4">
                            <div class="form-group">
                                <label for="descripcionIngreso">Descripción</label>
                                <input type="text" class="form-control" value="<?php echo $this->datos['descripcionIngreso']; ?>" id="descripcionIngreso" name="descripcionIngreso" required="">
                            </div>
                            <div class="form-group">
                                <label for="moneda">Moneda</label>
                                <select name="moneda"  class="form-control">
                                    <option value="pesos" <?php if($this->datos['moneda']=='pesos'){echo "selected='selected'";} ?>>Pesos</option>
                                    <option value="dolares" <?php if($this->datos['moneda']=='dolares'){echo "selected='selected'";} ?>>Dólares</option>
                                </select>
                            </div>
                        </div>
                        <div class=" col-lg-4">
                            <div class="form-group">
                                <label for="idOperacion">Nº Operación</label>
                                <input type="number" step="any" value="<?php echo $this->datos['idOperación']; ?>" class="form-control" id="idOperacion" name="idOperacion" style="width: 30%">
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo Valor</label>
                                <select name="tipoValor" class="form-control">
                                    <option value="efectivo" <?php if($this->datos['tipoValor']=='efectivo'){echo "selected='selected'";} ?>>EFECTIVO</option>
                                    <option value="tarjetacredito" <?php if($this->datos['tipoValor']=='tarjetacredito'){echo "selected='selected'";} ?>>TARJETA DE CRÉDITO</option>
                                    <option value="tarjetadebito" <?php if($this->datos['tipoValor']=='tarjetadebito'){echo "selected='selected'";} ?>>TARJETA DE DÉBITO</option>
                                    <option value="transferencia" <?php if($this->datos['tipoValor']=='transferencia'){echo "selected='selected'";} ?>>TRANSFERENCIA</option>
                                </select>
                            </div>
                        </div>  
                    </div>                 
                <?php                    
            }
            $this->con->close();
        }
        
    }
?>