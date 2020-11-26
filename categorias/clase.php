<?php
    include '../config/conexion.php';
    
    class categorias extends conexion {
        //atributos
        public $i;
        public $consulta;
        public $datos;
        public $buscar;
        public $categoria;
        public $idcategoria;
        public $cantidadMostrar;
        public $pagina;
        public $cantidadTotalRegistros;
        public $redondeoFinal;
        public $consultaMostrar;
        public $j;

        //metodos
        //metodo de mostrar categorias
        public function mostrarCategorias($pag) {
            $this->cantidadMostrar = 10;
            $this->pagina = $pag;
            $this->cantidadTotalRegistros = $this->con->query("SELECT * FROM categorias");
            $this->redondeoFinal = ceil($this->cantidadTotalRegistros->num_rows/$this->cantidadMostrar);
            
            $this->consultaMostrar = "SELECT * FROM categorias ORDER BY idCategoria DESC LIMIT ".(($this->pagina-1)*$this->cantidadMostrar).",".$this->cantidadMostrar;
            $this->consulta= $this->con->query($this->consultaMostrar);
            
            //$this->consulta=$this->con->query("SELECT * FROM categorias ORDER BY nombreCategoria ASC");
            $this->i=1;
            while($this->datos= $this->consulta->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $this->i;?></td>
                        <td><?php echo $this->datos['nombreCategoria'];?></td>                        
                        <td>
                            <div class="row">
                                <a class="btn btn-success btn-sm" href="formmodificar.php?idCategoria=<?php echo $this->datos['idCategoria'];?>"><i class="material-icons">create</i></a>
                                <a class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este registro?')" href="formeliminar.php?idCategoria=<?php echo $this->datos['idCategoria'];?>"><i class="material-icons">delete</i></a>
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
        public function filtro($bus) {
            $this->buscar=$bus;
            
            if($this->consulta = NULL) {
                
                $objetoMostrarTodos = new categorias();
                $objetoMostrarTodos->mostrarCategorias();
            }
            else {
                $this->consulta=$this->con->query("SELECT * FROM categorias WHERE nombreCategoria LIKE '%$this->buscar%' ORDER BY nombreCategoria ASC");

                $this->i=1;
                while($this->datos= $this->consulta->fetch_array()) {
                    ?>
                        <tr>
                            <td><?php echo $this->i;?></td>
                            <td><?php echo $this->datos['nombreCategoria'];?></td>                        
                            <td>
                                <div>
                                    <a class="btn btn-success" href="formmodificar.php?idCategoria=<?php echo $this->datos['idCategoria'];?>">Modificar</a>
                                    <a class="btn btn-danger" href="formeliminar.php?idCategoria=<?php echo $this->datos['idCategoria'];?>">Eliminar</a>
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
        public $consultacategoria;
        public $n;
        
        public function  guardar($cat){
            include '../config/horasistema.php';
            $this->categoria=$cat;                       
            
            $this->consultacategoria=$this->con->query("SELECT nombreCategoria FROM categorias WHERE nombreCategoria='$this->categoria'");
            $this->n=$this->consultacategoria->num_rows;
            
            if($this->n==1){
                echo "<script>alert('La categoría ingresada ya existe');window.location.href='formnuevo.php';</script>";
            }
            else { 
                $this->consulta=$this->con->query("INSERT INTO categorias (nombreCategoria) VALUE ('$this->categoria')");
            echo "<script>alert('Categoría registrada');window.location.href='index.php?pagina=1';</script>";
            $this->con->close();        
            }
        }
        // metodo mostrar datos a modificar
        
        public function datosModificar($id) {
            $this->idcategoria=$id;
            $this->consulta= $this->con->query("SELECT * FROM categorias WHERE idCategoria ='$this->idcategoria'");            
            if($this->datos=$this->consulta->fetch_array()){
                ?>
                    <div class="row clearfix">
                        <div class=" col-md-3">
                            <div class="form-group">
                                <label for="categoria">Categoría</label>
                                <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $this->datos['nombreCategoria']?>" required="">
                            </div>
                        </div>                        
                    </div>                
                <?php                    
            }
            $this->con->close();
        }
        //metodo confirmar modificacion
        public function confirmarModificacion($id,$cat){
            $this->idcategoria=$id;
            $this->categoria=$cat;
                       
            $this->consulta = $this->con->query("UPDATE categorias SET nombreCategoria='$this->categoria' WHERE idCategoria='$this->idcategoria'");
             
            echo "<script>alert('Categoria Modificada');window.location.href='index.php?pagina=1'</script>";
            $this->con->close();
        }
        // metodo eliminar usuario
        public function eliminarCategoria($id){
            $this->idcategoria=$id;
            $this->consulta= $this->con->query("DELETE FROM categorias WHERE idCategoria='$this->idcategoria'");
            $this->con->close();
            echo "<script>alert('Categoria eliminada');window.location.href='index.php'</script>";
        }
       
    }
?>