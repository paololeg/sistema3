<?php
    include '../config/conexion.php';
    
    class Caja extends conexion{
        public $idCaja;
        public $ultimacaja;
        public $idUsuario;
        public $saldoInicial;
        public $saldoFinal;
        public $fechaCaja;
        public $horaCaja;
        public $estadoCaja;
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
        public $tipoEgreso;
        public $descripcionEgreso;
        public $importeEgreso;
        public $fechaEgreso;
        public $horaEgreso;


        //Método para iniciar la caja
        public function iniciarCaja($salini,$idusu){
            date_default_timezone_set("america/argentina/tucuman");            
            $this->saldoInicial=$salini;
            $this->fechaCaja=date("Y-m-d");
            $this->horaCaja=date("H:i:s");
            $this->idUsuario=$idusu;   
            
            //echo "<script>confirm('Esta acción cerrará la caja actual');window.location.href='ultimacaja.php'</script>";
            
            $this->consulta= $this->con->query("INSERT INTO caja (idUsuario, saldoInicial, fechaCaja, horaCaja)
                      VALUES ('$this->idUsuario','$this->saldoInicial','$this->fechaCaja','$this->horaCaja')");
            $this->con->close();
            echo "<script>confirm('Caja iniciada');window.location.href='ultimacaja.php'</script>";
        }
        //metodo dinero inicial
        public function mostrarSaldoInicial($id){
            $this->idCaja=$id;
            $this->consulta= $this->con->query("SELECT saldoInicial FROM caja WHERE idCaja='$this->idCaja'");
            $this->datos= $this->consulta->fetch_array();
            $this->saldoInicial= $this->datos['saldoInicial'];
            ?>  
                <br>
                <h2>Saldo inicial: $<?php echo $this->saldoInicial ;?></h2>
            <?php           
            
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
       public $totalIngresos; 
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
                            <div class="row text-center">
                                <a class="btn btn-success btn-sm" href="formmodificaringreso.php?idIngreso=<?php echo $this->datos['idIngreso'];?>"><i class="material-icons">create</i></a>
                                <a class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este registro?')" href="formeliminaringreso.php?idIngreso=<?php echo $this->datos['idIngreso'];?>"><i class="material-icons">delete</i></a>
                                <a class="btn btn-primary btn-sm" href="imprimiringreso.php?idIngreso=<?php echo $this->datos['idIngreso'];?>"><i class="material-icons">print</i></a>
                            </div>
                        </td>
                    </tr> 
              <?php  
                $this->i++;
                $this->totalIngresos += $this->datos['importeIngreso'];
            }
            ?>
                    <tr>
                        <th colspan="5" class="text-right">Total Ingresos</th>
                        <th><?php echo $this->totalIngresos ?></th>
                    </tr>
             <?php       
            $this->con->close();
        }
        //metodo para mostrar ingresos
       public $totalEgresos;
       public function mostrarEgresos($idc) {
            $this->idCaja = $idc;
            $this->consulta= $this->con->query("SELECT * 
                                                FROM egresos
                                                WHERE idCaja='$this->idCaja' 
                                                ORDER BY idEgreso ASC");
            
            $this->i=1;
            while($this->datos= $this->consulta->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $this->i;?></td>
                        <td><?php echo $this->datos['fechaEgreso'];?></td>
                        <td><?php echo $this->datos['tipoEgreso'];?></td>
                        <td><?php echo $this->datos['tipoValor'];?></td> 
                        <td><?php echo $this->datos['descripcionEgreso'];?></td> 
                        <td><?php echo $this->datos['importeEgreso'];?></td> 
                        <td>
                            <div class="row text-center">
                                <a class="btn btn-success btn-sm" href="formmodificaregreso.php?idEgreso=<?php echo $this->datos['idEgreso'];?>"><i class="material-icons">create</i></a>
                                <a class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este registro?')" href="formeliminaregreso.php?idEgreso=<?php echo $this->datos['idEgreso'];?>"><i class="material-icons">delete</i></a>
                                <a class="btn btn-primary btn-sm" href="imprimiregreso.php?idEgreso=<?php echo $this->datos['idEgreso'];?>"><i class="material-icons">print</i></a>
                            </div>
                        </td>
                    </tr> 
              <?php  
                $this->i++;
                $this->totalEgresos += $this->datos['importeEgreso'];
            }
            ?>
                    <tr>
                        <th colspan="5" class="text-right">Total Egresos</th>
                        <th><?php echo $this->totalEgresos ?></th>
                    </tr>
             <?php  
            $this->con->close();
        }
        //metodo dinero final
        public function mostrarSaldoFinal($id){
            $this->idCaja=$id;
            
            $this->consulta= $this->con->query("SELECT saldoInicial FROM caja WHERE idCaja='$this->idCaja'");
            $this->datos= $this->consulta->fetch_array();
            
            $this->saldoInicial = $this->datos['saldoInicial'];
            
            $this->consulta= $this->con->query("SELECT importeIngreso FROM ingresos WHERE idCaja='$this->idCaja' AND tipoValor='efectivo'");
            while($this->datos= $this->consulta->fetch_array()){
                $this->totalIngresos += $this->datos['importeIngreso'];
            }
            $this->consulta2= $this->con->query("SELECT importeEgreso FROM egresos WHERE idCaja='$this->idCaja' AND tipoValor='efectivo'");
            while($this->datos2= $this->consulta2->fetch_array()){
                $this->totalEgresos += $this->datos2['importeEgreso'];
            }
            
            $this->saldoFinal= $this->saldoInicial + $this->totalIngresos - $this->totalEgresos;
            ?>  
                <br>
                <h2>Saldo final: $<?php echo $this->saldoFinal ;?></h2>
            <?php  
            $this->consulta2= $this->con->query("UPDATE caja SET saldoFinal='$this->saldoFinal' WHERE idCaja='$this->idCaja'");
            
            $this->con->close();
        }
        // metodo guardar ingreso
        public function  guardarIngreso($idcaja, $tipin, $idop, $mon, $numcom, $desc, $imp,$tipoval, $idreg ){
            include '../config/horasistema.php';
            date_default_timezone_set("america/argentina/tucuman");  
            $this->idCaja=$idcaja; 
            $this->tipoIngreso = $tipin;
            $this->idOperacion=$idop;
            $this->moneda = $mon;
            $this->numeroComprobante = $numcom;
            $this->descripcionIngreso = $desc;
            $this->importeIngreso = $imp;
            $this->tipoValor = $tipoval;
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
        // metodo guardar ingreso
        public function  guardarEgreso($idcaja, $tipeg, $mon, $desc, $imp,$tipoval, $idreg ){
            include '../config/horasistema.php';
            date_default_timezone_set("america/argentina/tucuman");  
            $this->idCaja=$idcaja; 
            $this->tipoEgreso = $tipeg;
            $this->moneda = $mon;
            $this->descripcionEgreso = $desc;
            $this->importeEgreso = $imp;
            $this->tipoValor = $tipoval;
            $this->idRegistrante = $idreg;
            $this->horaEgreso=date("H:i:s");
            $this->anulado=0;
           
            $this->consulta=$this->con->query("INSERT INTO egresos (idCaja,tipoEgreso,moneda,
                                                descripcionEgreso,importeEgreso,tipoValor,fechaEgreso, horaEgreso, anulado,idRegistrante) 
                                               VALUES ('$this->idCaja','$this->tipoEgreso','$this->moneda',
                                                '$this->descripcionEgreso','$this->importeEgreso','$this->tipoValor',NOW(),'$this->horaEgreso',
                                             '$this->anulado','$this->idRegistrante')");
            
            echo "<script>alert('Egreso Registrado');window.location.href='ultimacaja.php';</script>";
            
        }
        // metodo modificar ingreso
        public function modificarIngreso($id) {
            $this->idIngreso = $id;
            $this->consulta= $this->con->query("SELECT * FROM ingresos WHERE idIngreso='$this->idIngreso'");
            if($this->datos= $this->consulta->fetch_array()){
                ?>
                    <div class="row clearfix">
                        <div class=" col-md-3">
                            <div class="form-group">
                                <label for="tipoIngreso">Tipo</label>
                                <select name="tipoIngreso" class="form-control">
                                    <option value="recibo"<?php if($this->datos['tipoIngreso']=='recibo'){echo "selected='selected'";} ?>>Recibo</option>
                                    <option value="manual"<?php if($this->datos['tipoIngreso']=='manual'){echo "selected='selected'";} ?>>Ingreso Manual</option>
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
        }
        // metodo modificar ingreso
        public function modificarEgreso($id) {
            $this->idEgreso = $id;
            $this->consulta= $this->con->query("SELECT * FROM egresos WHERE idEgreso='$this->idEgreso'");
            if($this->datos= $this->consulta->fetch_array()){
                ?>
                    <div class="row clearfix">
                        <div class=" col-md-3">
                            <div class="form-group">
                                <label for="tipoEgreso">Tipo</label>
                                <select name="tipoEgreso" class="form-control">
                                    <option value="pago"<?php if($this->datos['tipoEgreso']=='recibo'){echo "selected='selected'";} ?>>Pago Proveedor</option>
                                    <option value="manual"<?php if($this->datos['tipoEgreso']=='manual'){echo "selected='selected'";} ?>>Egreso Manual</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="importeEgreso">Importe</label>
                                <input type="number" step="any" value="<?php echo $this->datos['importeEgreso']; ?>" class="form-control" id="importeEgreso" name="importeEgreso"  required="">
                            </div>
                        </div>
                        <div class=" col-lg-4">
                            <div class="form-group">
                                <label for="descripcionEgreso">Descripción</label>
                                <input type="text" class="form-control" value="<?php echo $this->datos['descripcionEgreso']; ?>" id="descripcionEgreso" name="descripcionEgreso" required="">
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
        }
        //metodo confirmar modificacion
        public function confirmarModificacionIngreso($id,$tiping,$imp,$numcom,$desc,$mon,$idop,$tipoval){
            $this->idIngreso=$id;
            $this->tipoIngreso=$tiping;
            $this->importeIngreso=$imp;
            $this->numeroComprobante=$numcom;
            $this->descripcionIngreso=$desc;
            $this->moneda=$mon;
            $this->idOperacion=$idop;
            $this->tipoValor=$tipoval;
                       
            $this->consulta = $this->con->query("UPDATE ingresos SET tipoIngreso='$this->tipoIngreso', importeIngreso='$this->importeIngreso',
                                                numeroComprobante='$this->numeroComprobante',descripcionIngreso='$this->descripcionIngreso',
                                                moneda='$this->moneda',idOperacion='$this->idOperacion',tipoValor='$this->tipoValor'
                                                WHERE idIngreso='$this->idIngreso'");
             
            echo "<script>alert('Ingreso Modificado');window.location.href='ultimacaja.php'</script>";
            $this->con->close();
        }
        //metodo confirmar modificacion
        public function confirmarModificacionEgreso($id,$tipeg,$imp,$desc,$mon,$tipoval){
            $this->idEgreso=$id;
            $this->tipoEgreso=$tipeg;
            $this->importeEgreso=$imp;
            $this->descripcionEgreso=$desc;
            $this->moneda=$mon;
            $this->tipoValor=$tipoval;
                       
            $this->consulta = $this->con->query("UPDATE egresos SET tipoEgreso='$this->tipoEgreso', importeEgreso='$this->importeEgreso',
                                                descripcionEgreso='$this->descripcionEgreso',
                                                moneda='$this->moneda',tipoValor='$this->tipoValor'
                                                WHERE idEgreso='$this->idEgreso'");
             
            echo "<script>alert('Egreso Modificado');window.location.href='ultimacaja.php'</script>";
            $this->con->close();
        }
        // metodo eliminar ingreso
        public function eliminarIngreso($id){
            $this->idIngreso=$id;
            $this->consulta= $this->con->query("DELETE FROM ingresos  WHERE idIngreso='$this->idIngreso'");
            $this->con->close();
            echo "<script>alert('Ingreso eliminado');window.location.href='ultimacaja.php'</script>";
        }
        // metodo eliminar ingreso
        public function eliminarEgreso($id){
            $this->idEgreso=$id;
            $this->consulta= $this->con->query("DELETE FROM egresos  WHERE idEgreso='$this->idEgreso'");
            $this->con->close();
            echo "<script>alert('Egreso eliminado');window.location.href='ultimacaja.php'</script>";
        }
        //metodo para mostrar ingreso a imprimir
        public function ingresoImprimir($id){
            $this->idIngreso=$id;
            $this->consulta= $this->con->query("SELECT * FROM ingresos WHERE idIngreso ='$this->idIngreso'");            
            if($this->datos=$this->consulta->fetch_array()){
                ?>
                    <tr>
                        <td style="text-align: left;"><span style="font-size: medium;"><strong>INGRESO N&deg;: <?php echo $this->datos['idIngreso']?></strong></td>
                        <td style="text-align: right;">FECHA <?php echo $this->datos['fechaIngreso']?>- HORA <?php echo $this->datos['horaIngreso']?></td>
                    </tr>                   
                </tbody>
                </table>
                <table style="width: 80%; background-color: #ffffff;" border="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td style="width: 100%;" colspan="3"></td>
                    </tr>
                    <tr>
                        <td style="width: 30%; text-align: center;"><strong>Detalle&nbsp;</strong></td>
                        <td style="width: 30%; text-align: center;"><strong>Valor</strong></td>
                        <td style="width: 30%; text-align: center;"><strong>Importe</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><?php echo $this->datos['descripcionIngreso']?></td>
                        <td style="text-align: center;"><?php echo $this->datos['tipoValor']?></td>
                        <td style="text-align: center;"><?php echo $this->datos['importeIngreso']?></td>
                    </tr>            
                <?php                    
            }
            $this->con->close();
        }
        //metodo para mostrar egreso a imprimir
        public function egresoImprimir($id){
            $this->idEgreso=$id;
            $this->consulta= $this->con->query("SELECT * FROM egresos WHERE idEgreso ='$this->idEgreso'");            
            if($this->datos=$this->consulta->fetch_array()){
                ?>
                    <tr>
                        <td style="text-align: left;"><span style="font-size: medium;"><strong>EGRESO N&deg;: <?php echo $this->datos['idEgreso']?></strong></td>
                        <td style="text-align: right;">FECHA <?php echo $this->datos['fechaEgreso']?>- HORA <?php echo $this->datos['horaEgreso']?></td>
                    </tr>                   
                </tbody>
                </table>
                <table style="width: 80%; background-color: #ffffff;" border="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td style="width: 100%;" colspan="3"></td>
                    </tr>
                    <tr>
                        <td style="width: 30%; text-align: center;"><strong>Detalle&nbsp;</strong></td>
                        <td style="width: 30%; text-align: center;"><strong>Valor</strong></td>
                        <td style="width: 30%; text-align: center;"><strong>Importe</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><?php echo $this->datos['descripcionEgreso']?></td>
                        <td style="text-align: center;"><?php echo $this->datos['tipoValor']?></td>
                        <td style="text-align: center;"><?php echo $this->datos['importeEgreso']?></td>
                    </tr>            
                <?php                    
            }
            $this->con->close();
        }
        //Método para cerrar la caja
        public function cerrarCaja($id){
            $this->idCaja=$id; 
            
            $this->consulta= $this->con->query("UPDATE caja SET estadoCaja='1' WHERE idCaja ='$this->idCaja' ");
            $this->con->close();
            echo "<script>alert('Caja Cerrada');window.location.href='iniciar.php'</script>";
            
        }
        
    }
?>