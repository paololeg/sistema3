<?php
    include '../config/conexion.php';
    
    class egresos extends conexion {
        //atributos
        public $i;
        public $consulta;
        public $datos;
        public $buscar;
        public $descripcionEgreso;
        public $importeEgreso;
        public $fechaEgreso;
        public $horaEgreso;
        public $fechaDesde;
        public $fechaHasta;
        public $cantidadMostrar;
        public $pagina;
        public $cantidadTotalRegistros;
        public $redondeoFinal;
        public $consultaMostrar;
        public $j;

        //metodos
        //metodo de mostrar egresos
        public function mostrarEgresos($pag) {
            $this->cantidadMostrar = 10;
            $this->pagina = $pag;
            $this->cantidadTotalRegistros = $this->con->query("SELECT * FROM egresos");
            $this->redondeoFinal = ceil($this->cantidadTotalRegistros->num_rows/$this->cantidadMostrar);
            
            $this->consultaMostrar = "SELECT * FROM egresos ORDER BY idEgreso DESC LIMIT ".(($this->pagina-1)*$this->cantidadMostrar).",".$this->cantidadMostrar;
            $this->consulta= $this->con->query($this->consultaMostrar);            
            
            //$this->consulta=$this->con->query("SELECT * FROM egresos ORDER BY fechaEgreso ASC");
            $this->i=1;
            while($this->datos= $this->consulta->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $this->i;?></td>
                        <td><?php echo $this->datos['descripcionEgreso'];?></td> 
                        <td><?php echo $this->datos['importeEgreso'];?></td> 
                        <td><?php echo $this->datos['fechaEgreso'].' '.$this->datos['horaEgreso'];?></td> 
                        <td>
                            <div class="row">
                                <a class="btn btn-success btn-sm" href="formmodificar.php?idEgreso=<?php echo $this->datos['idEgreso'];?>"><i class="material-icons">create</i></a>
                                <a class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este registro?')" href="formeliminar.php?idEgreso=<?php echo $this->datos['idEgreso'];?>"><i class="material-icons">delete</i></a>
                                <a class="btn btn-primary btn-sm" href="imprimir.php?idEgreso=<?php echo $this->datos['idEgreso'];?>"><i class="material-icons">print</i></a>
                            </div>
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
        // metodo de busqueda o filtro
        // no funciona cuando tiene una sola fecha
        public function filtro($des,$has) {
            $this->fechaDesde=$des;
            $this->fechaHasta=$has;
            
            if($this->fechaHasta == NULL) {
                
                $objetoMostrarTodos = new egresos();
                $objetoMostrarTodos->mostrarEgresos();
            }
            else {
                $this->consulta=$this->con->query("SELECT * FROM egresos WHERE fechaEgreso BETWEEN '$this->fechaDesde' AND '$this->fechaHasta' ORDER BY fechaEgreso ASC");

                $this->i=1;
                while($this->datos= $this->consulta->fetch_array()) {
                    ?>
                        <tr>
                            <td><?php echo $this->i;?></td>
                            <td><?php echo $this->datos['descripcionEgreso'];?></td> 
                            <td><?php echo $this->datos['importeEgreso'];?></td> 
                            <td><?php echo $this->datos['fechaEgreso'].' '.$this->datos['horaEgreso'];?></td> 
                            <td>
                                <div class="row">
                                    <a class="btn btn-success btn-sm" href="formmodificar.php?idEgreso=<?php echo $this->datos['idEgreso'];?>"><i class="material-icons">create</i></a>
                                    <a class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este registro?')" href="formeliminar.php?idEgreso=<?php echo $this->datos['idEgreso'];?>"><i class="material-icons">delete</i></a>
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
        
        public function  guardar($des,$imp,$fec){
            include '../config/horasistema.php';
            date_default_timezone_set("america/argentina/tucuman");  
            $this->descripcionEgreso=$des; 
            $this->importeEgreso=$imp;
            $this->fechaEgreso=$fec;
            $this->horaEgreso=date("H:i:s");
            
           
            $this->consulta=$this->con->query("INSERT INTO egresos (descripcionEgreso,importeEgreso,fechaEgreso,horaEgreso) VALUES ('$this->descripcionEgreso','$this->importeEgreso','$this->fechaEgreso','$this->horaEgreso')");
            echo "<script>alert('Egreso Registrado');window.location.href='index.php?pagina=1';</script>";
            $this->con->close();
        }
        // metodo mostrar datos a modificar
        
        public function datosModificar($id) {
            $this->idEgreso=$id;
            $this->consulta= $this->con->query("SELECT * FROM egresos WHERE idEgreso ='$this->idEgreso'");            
            if($this->datos=$this->consulta->fetch_array()){
                ?>
                    <div class="row clearfix">
                        <div class=" col-md-3">
                            <div class="form-group">
                                <label for="descripcionEgreso">Descripción</label>
                                <input type="text" class="form-control" id="descripcionEgreso" name="descripcionEgreso" value="<?php echo $this->datos['descripcionEgreso']?>" required="">
                            </div>
                            <div class="form-group">
                                <label for="importeEgreso">Importe</label>
                                <input type="number" step="any" class="form-control" id="importeEgreso" name="importeEgreso" value="<?php echo $this->datos['importeEgreso']?>" required="">
                            </div>
                            <div class="form-group">
                                <label for="fechaEgreso">Fecha</label>
                                <input type="date" class="form-control" id="fechaEgreso" name="fechaEgreso" value="<?php echo $this->datos['fechaEgreso']?>" required="">
                            </div>
                        </div>                        
                    </div>                
                <?php                    
            }
            $this->con->close();
        }
        //metodo confirmar modificacion
        public function confirmarModificacion($id,$des,$imp,$fec){
            $this->idEgreso=$id;
            $this->descripcionEgreso=$des;
            $this->importeEgreso=$imp;
            $this->fechaEgreso=$fec;
                       
            $this->consulta = $this->con->query("UPDATE egresos SET descripcionEgreso='$this->descripcionEgreso', importeEgreso='$this->importeEgreso', fechaEgreso='$this->fechaEgreso' WHERE idEgreso='$this->idEgreso'");
             
            echo "<script>alert('Egreso Modificado');window.location.href='index.php?pagina=1'</script>";
            $this->con->close();
        }
        // metodo eliminar usuario
        public function eliminarEgreso($id){
            $this->idEgreso=$id;
            $this->consulta= $this->con->query("DELETE FROM egresos WHERE idEgreso='$this->idEgreso'");
            $this->con->close();
            echo "<script>alert('Egreso eliminado');window.location.href='index.php?pagina=1'</script>";
        }
        //metodo para mostrar egreso a imprimir
        public function datosImprimir($id){
            $this->idEgreso=$id;
            $this->consulta= $this->con->query("SELECT * FROM egresos WHERE idEgreso ='$this->idEgreso'");            
            if($this->datos=$this->consulta->fetch_array()){
                ?>
                    <tr>
                        <td style="text-align: left;"><span style="font-size: medium;"><strong>ASIENTO N&deg;: <?php echo $this->datos['idEgreso']?></strong></td>
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
                        <td style="width: 30%; text-align: center;"><strong>Importe</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><?php echo $this->datos['descripcionEgreso']?></td>
                        <td style="text-align: center;"><?php echo $this->datos['importeEgreso']?></td>
                    </tr>            
                <?php                    
            }
            $this->con->close();
        }
       
    }
?>

