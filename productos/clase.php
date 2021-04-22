<?php
    include '../config/conexion.php';
    
    class productos extends conexion {
        //atributos
        public $i;
        public $consulta;
        public $consulta2;
        public $datos;
        public $datos2;
        public $buscar;
        public $tipo;
        public $idProducto;
        public $nombreProducto;
        public $descripcion;
        public $codigo;
        public $cantidad;
        public $precioVenta;
        public $precioVompra;
        public $fechaIngresop;
        public $idCategoria;
        public $nombreCategoria;
        public $idUsuario;
        public $encontrados;
        public $cantidadMostrar;
        public $pagina;
        public $cantidadTotalRegistros;
        public $redondeoFinal;
        public $consultaMostrar;
        public $j;



        //metodos
        //metodo de mostrar usuarios
        public function mostrarProductos($pag) {
            $this->cantidadMostrar = 10;
            $this->pagina = $pag;
            $this->cantidadTotalRegistros = $this->con->query("SELECT * FROM productos");
            $this->redondeoFinal = ceil($this->cantidadTotalRegistros->num_rows/$this->cantidadMostrar);
            
            $this->consultaMostrar = "SELECT * FROM productos  p INNER JOIN categorias c on c.idCategoria=p.idCategoria ORDER BY idProducto DESC LIMIT ".(($this->pagina-1)*$this->cantidadMostrar).",".$this->cantidadMostrar;
            $this->consulta= $this->con->query($this->consultaMostrar);
            
            
            //$this->consulta=$this->con->query("SELECT p.*, c.nombreCategoria, u.apellido, u.nombre FROM productos p INNER JOIN categorias c ON c.idCategoria=p.idCategoria INNER JOIN usuarios u ON u.idUsuario=p.idUsuario ORDER BY P.nombreProducto ASC");
            $this->i=1;
            while($this->datos= $this->consulta->fetch_array()) {
                ?>
                    <tr>
                        <td>
                            <b><?php echo $this->i;?></b>
                            <img src="fotos/<?php echo $this->datos['codigo'];?>" width="50px">
                        </td>
                        <td><?php echo $this->datos['codigo'];?></td>
                        <td><?php echo $this->datos['nombreProducto'];?></td>
                        <td><?php echo $this->datos['descripcion'];?></td>                        
                        <td><?php echo $this->datos['cantidad'];?></td>
                        <td><?php echo $this->datos['precioVenta'];?></td>
                        <td><?php echo $this->datos['precioCompra'];?></td>
                        <td><?php echo $this->datos['nombreCategoria'];?></td>
                        <td>
                            <div class="row">
                                <a class="btn btn-success btn-sm" href="formmodificar.php?idProducto=<?php echo $this->datos['idProducto'];?>"><i class="material-icons">create</i></a>
                                <a class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este registro?')" href="formeliminar.php?idProducto=<?php echo $this->datos['idProducto'];?>"><i class="material-icons">delete</i></a>
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
        public function filtro($bus,$tip) {
            $this->buscar=$bus;
            $this->tipo=$tip;
            
            if($this->consulta = NULL) {
                
                $objetoMostrarTodo = new productos();
                $objetoMostrarTodo->mostrarProductos();
            }
            else {               
             
                switch ($this->tipo){
                    case 'nombre': $this->consulta=$this->con->query("SELECT p.*, c.nombreCategoria, u.apellido, u.nombre FROM productos p INNER JOIN categorias c ON c.idCategoria=p.idCategoria INNER JOIN usuarios u ON U.idUsuario=p.idUsuario WHERE p.nombreProducto LIKE '%$this->buscar%' ORDER BY P.nombreProducto ASC");
                        break;
                    case 'codigo': $this->consulta=$this->con->query("SELECT p.*, c.nombreCategoria, u.apellido, u.nombre FROM productos p INNER JOIN categorias c ON c.idCategoria=p.idCategoria INNER JOIN usuarios u ON U.idUsuario=p.idUsuario WHERE p.codigo LIKE '%$this->buscar%' ORDER BY P.nombreProducto ASC");
                        break;                    
                    case 'pocasunidades': $this->consulta=$this->con->query("SELECT p.*, c.nombreCategoria, u.apellido, u.nombre FROM productos p INNER JOIN categorias c ON c.idCategoria=p.idCategoria INNER JOIN usuarios u ON U.idUsuario=p.idUsuario WHERE p.cantidad BETWEEN 1 AND 10  ORDER BY P.nombreProducto ASC");
                        break;
                    case 'sinstock': $this->consulta=$this->con->query("SELECT p.*, c.nombreCategoria, u.apellido, u.nombre FROM productos p INNER JOIN categorias c ON c.idCategoria=p.idCategoria INNER JOIN usuarios u ON U.idUsuario=p.idUsuario WHERE p.cantidad = 0 ORDER BY P.nombreProducto ASC");
                        break;
                }
                $this->i=1;

                $this->encontrados= $this->consulta->num_rows;

                if($this->encontrados>0) {
                    while($this->datos= $this->consulta->fetch_array()) {
                        ?>
                            <tr>
                                <td>
                                    <b><?php echo $this->i;?></b>
                                    <img src="fotos/<?php echo $this->datos['codigo'];?>" width="50px">                            
                                </td>
                                <td><?php echo $this->datos['codigo'];?></td>
                                <td><?php echo $this->datos['nombreProducto'];?></td>
                                <td><?php echo $this->datos['descripcion'];?></td>
                                <td><?php echo $this->datos['cantidad'];?></td>
                                <td><?php echo $this->datos['precioVenta'];?></td>
                                <td><?php echo $this->datos['precioCompra'];?></td>
                                <td><?php echo $this->datos['nombreCategoria'];?></td>
                                <td>
                                    <div>
                                        <a class="btn btn-success btn-sm" href="formmodificar.php?idProducto=<?php echo $this->datos['idProducto'];?>"><i class="material-icons">create</i></a>
                                        <a class="btn btn-danger btn-sm" href="formeliminar.php?idProducto=<?php echo $this->datos['idProducto'];?>"><i class="material-icons">delete</i></a>
                                    </div>
                                </td>
                            </tr> 
                      <?php  
                        $this->i++;
                    }
                }
                else {
                    echo "<a class='btn btn-primary' href='formnuevo.php?codigo=$this->buscar' >¿Desea ingresar un nuevo producto con el código $this->buscar </a>";
                }

                $this->con->close();
            }
        }
               
        //metodo guardar
        public $consultaProducto;
        public $consultaCodigo;
        public $p;
        public $c;
        public function  guardar($nom, $des, $cod, $can, $pv, $pc,  $idcat, $idusu){
            include '../config/horasistema.php';
            
            
            $this->nombreProducto=$nom;
            $this->descripcion=$des;
            $this->codigo=$cod;
            $this->cantidad=$can;
            $this->precioVenta=$pv;
            $this->precioCompra=$pc;
            $this->idCategoria=$idcat;
            $this->idUsuario=$idusu;
            
            
            
            $this->consultaProducto=$this->con->query("SELECT nombreProducto FROM productos WHERE nombreProducto='$this->nombreProducto'");
            $this->p=$this->consultaProducto->num_rows;
            $this->consultaCodigo= $this->con->query("SELECT codigo FROM productos WHERE codigo='$this->codigo'");
            $this->c= $this->consultaCodigo->num_rows;
            
            if($this->p==1){
                echo "<script>alert('El producto ingresado ya existe');window.location.href='formnuevo.php';</script>";
            }
            elseif ($this->c==1) {
                echo "<script>alert('El codigo ingresado ya existe');window.location.href='formnuevo.php';</script>";
            }
            else {
                $this->consulta=$this->con->query("INSERT INTO productos (nombreProducto, descripcion, codigo, cantidad, precioVenta,
                          precioCompra, fechaIngresop, idCategoria, idUsuario) VALUES ('$this->nombreProducto','$this->descripcion',
                    '$this->codigo','$this->cantidad','$this->precioVenta','$this->precioCompra', NOW(),'$this->idCategoria',
                    '$this->idUsuario')");
                $this->con->close();
        
            }
        }
        // metodo mostrar datos a modificar      
        // si la categoria está eliminada no muestra resultados porque en la consulta utiliza la tabla categorias
        public function datosModificar($id) {
            $this->idProducto=$id;           
            $this->consulta= $this->con->query("SELECT * FROM productos WHERE idProducto ='$this->idProducto'");            
            if($this->datos=$this->consulta->fetch_array()){
                ?>
                    <div class="row clearfix">
                        <div class=" col-md-2">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $this->datos['codigo']?>" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombreProducto">Producto</label>
                                <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" value="<?php echo $this->datos['nombreProducto']?>" required="">
                            </div>
                        </div> 
                        <div class="col-md-3">
                            <label for="categoria">Categoría</label>
                            <select class="form-control show-tick" name="idCategoria" id="categoria" >                                
                               <option value="">--Categoría--</option>   
                               <?php 
                                $this->consulta2= $this->con->query("SELECT * FROM categorias ORDER BY nombreCategoria ASC");
                                    while ($this->datos2= $this->consulta2->fetch_array()) {
                                    ?>
                               <option value="<?php echo $this->datos2['idCategoria']; ?>" <?php if($this->datos2['idCategoria']== $this->datos['idCategoria']) { echo "selected='selected'"; } ?> ><?php echo $this->datos2['nombreCategoria']; ?></option>
                                    <?php
                                }
                               ?>  
                            </select>
                        </div>  
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea type="text" class="form-control" id="descripcion" name="descripcion"  required=""><?php echo $this->datos['descripcion']?></textarea>
                            </div>  
                        </div>   
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $this->datos['cantidad']?>" required="">
                            </div>
                        </div>   
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="foto">Imagen</label>
                            <input type="file" class="form-control" name="foto" id="foto" >
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="precioVenta">Precio Venta</label>
                                <input type="text" class="form-control" id="precioVenta" name="precioVenta" value="<?php echo $this->datos['precioVenta']?>" required="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="precioCompra">Precio Compra</label>
                                <input type="text" class="form-control" id="precioCompra" name="precioCompra" value="<?php echo $this->datos['precioCompra']?>" required="">                                
                            </div>  
                        </div>                                                  
                    </div>                    
                <?php                    
            }
            $this->con->close();
        }
        //metodo confirmar modificacion
        public function confirmarModificacion($id,$nom, $des, $cod, $can, $pv, $pc,$idcat){
            $this->idProducto=$id;
            $this->nombreProducto=$nom;
            $this->descripcion=$des;
            $this->codigo=$cod;
            $this->cantidad=$can;
            $this->precioVenta=$pv;
            $this->precioCompra=$pc;
            $this->idCategoria=$idcat;
            
            $this->consulta = $this->con->query("UPDATE productos SET nombreProducto='$this->nombreProducto', descripcion='$this->descripcion',
                                                                    codigo='$this->codigo', cantidad='$this->cantidad',
                                                                    precioVenta='$this->precioVenta', precioCompra='$this->precioCompra', idCategoria='$this->idCategoria'
                                                WHERE idProducto ='$this->idProducto'");
            $this->con->close();
             echo "<script>alert('Producto modificado');window.location.href='index.php?pagina=1'</script>";
        }
        // metodo eliminar usuario
        public function eliminarProducto($id){
            $this->idProducto=$id;
            $this->consulta= $this->con->query("DELETE FROM productos WHERE idProducto='$this->idProducto'");
            $this->con->close();
            echo "<script>alert('Producto eliminado');window.location.href='index.php?pagina=1'</script>";
        } 
        // metodo para seleccionar categorias
        public function selectCategorias() {
            $this->consulta2= $this->con->query("SELECT * FROM categorias ORDER BY nombreCategoria ASC");
            while ($this->datos2= $this->consulta2->fetch_array()) {
                ?>
                    <option value="<?php echo $this->datos2['idCategoria']; ?>"><?php echo $this->datos2['nombreCategoria']; ?></option>
                <?php
            }
            $this->con->close();
        }
        
    }
?>