<?php
    include '../config/conexion.php';
    
    class tarjetas extends conexion {
        //atributos
        public $i;
        public $consulta;
        public $datos;
        public $buscar;
        public $nombreTarjeta;
        public $cuotas;
        public $interes;
        public $idTarjeta;

        //metodos
        //metodo de mostrar tarjetas
        public function mostrarTarjetas() {
            $this->consulta=$this->con->query("SELECT * FROM tarjetas ORDER BY nombreTarjeta ASC");
            $this->i=1;
            while($this->datos= $this->consulta->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $this->i;?></td>
                        <td><?php echo $this->datos['nombreTarjeta'];?></td> 
                        <td><?php echo $this->datos['cuotas'];?></td> 
                        <td><?php echo $this->datos['interes'];?></td> 
                        <td>
                            <div class="row">
                                <a class="btn btn-success btn-sm" href="formmodificar.php?idTarjeta=<?php echo $this->datos['idTarjeta'];?>"><i class="material-icons">create</i></a>
                                <a class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este registro?')" href="formeliminar.php?idTarjeta=<?php echo $this->datos['idTarjeta'];?>"><i class="material-icons">delete</i></a>
                            </div>
                        </td>
                    </tr> 
              <?php  
                $this->i++;
            }
            $this->con->close();
        }
        // metodo de busqueda o filtro
        public function filtro($bus) {
            $this->buscar=$bus;
            
            if($this->consulta = NULL) {
                
                $objetoMostrarTodos = new tarjetas();
                $objetoMostrarTodos->mostrarTarjeta();
            }
            else {
                $this->consulta=$this->con->query("SELECT * FROM tarjetas WHERE nombreTarjeta LIKE '%$this->buscar%' ORDER BY nombreTarjeta ASC");

                $this->i=1;
                while($this->datos= $this->consulta->fetch_array()) {
                    ?>
                        <tr>
                            <td><?php echo $this->i;?></td>
                            <td><?php echo $this->datos['nombreTarjeta'];?></td> 
                            <td><?php echo $this->datos['cuotas'];?></td>
                            <td><?php echo $this->datos['interes'];?></td> 
                            <td>
                                <div>
                                    <a class="btn btn-success" href="formmodificar.php?idTarjeta=<?php echo $this->datos['idTarjeta'];?>">Modificar</a>
                                    <a class="btn btn-danger" href="formeliminar.php?idTarjeta=<?php echo $this->datos['idTarjeta'];?>">Eliminar</a>
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
        public $consultatarjeta;
        public $n;
        
        public function  guardar($tar,$cuo,$int){
            include '../config/horasistema.php';
            $this->nombreTarjeta=$tar; 
            $this->cuotas=$cuo;
            $this->interes=$int;
            
            $this->consultatarjeta=$this->con->query("SELECT nombreTarjeta FROM tarjetas WHERE nombreTarjeta='$this->nombreTarjeta'");
            $this->n=$this->consultatarjeta->num_rows;
            
            if($this->n==1){
                echo "<script>alert('La tarjeta ingresada ya existe');window.location.href='formnuevo.php';</script>";
            }
            else { 
                $this->consulta=$this->con->query("INSERT INTO tarjetas (nombreTarjeta,cuotas,interes) VALUES ('$this->nombreTarjeta','$this->cuotas','$this->interes')");
            echo "<script>alert('Tarjeta registrada');window.location.href='index.php';</script>";
            $this->con->close();        
            }
        }
        // metodo mostrar datos a modificar
        
        public function datosModificar($id) {
            $this->idTarjeta=$id;
            $this->consulta= $this->con->query("SELECT * FROM tarjetas WHERE idTarjeta ='$this->idTarjeta'");            
            if($this->datos=$this->consulta->fetch_array()){
                ?>
                    <div class="row clearfix">
                        <div class=" col-md-3">
                            <div class="form-group">
                                <label for="nombreTarjeta">Tarjeta</label>
                                <input type="text" class="form-control" id="nombreTarjeta" name="nombreTarjeta" value="<?php echo $this->datos['nombreTarjeta']?>" required="">
                            </div>
                            <div class="form-group">
                                <label for="cuotas">Cuotas</label>
                                <input type="number" class="form-control" id="cuotas" name="cuotas" value="<?php echo $this->datos['cuotas']?>" required="">
                            </div>
                            <div class="form-group">
                                <label for="cuotas">Interés</label>
                                <input type="number" class="form-control" id="interes" name="interes" value="<?php echo $this->datos['interes']?>" required="">
                            </div>
                        </div>                        
                    </div>                
                <?php                    
            }
            $this->con->close();
        }
        //metodo confirmar modificacion
        public function confirmarModificacion($id,$tar,$cuo,$int){
            $this->idTarjeta=$id;
            $this->nombreTarjeta=$tar;
            $this->cuotas=$cuo;
            $this->interes=$int;
                       
            $this->consulta = $this->con->query("UPDATE tarjetas SET nombreTarjeta='$this->nombreTarjeta', cuotas='$this->cuotas', interes='$this->interes' WHERE idTarjeta='$this->idTarjeta'");
             
            echo "<script>alert('Tarjeta Modificada');window.location.href='index.php'</script>";
            $this->con->close();
        }
        // metodo eliminar usuario
        public function eliminarTarjeta($id){
            $this->idTarjeta=$id;
            $this->consulta= $this->con->query("DELETE FROM tarjetas WHERE idTarjeta='$this->idTarjeta'");
            $this->con->close();
            echo "<script>alert('Tarjeta eliminada');window.location.href='index.php'</script>";
        }
       
    }
?>