<?php
    include '../config/conexion.php';
    
    class usuarios extends conexion {
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
        public $cantidadMostrar;
        public $pagina;
        public $cantidadTotalRegistros;
        public $redondeoFinal;
        public $consultaMostrar;
        public $j;
        public $busqueda;

        //metodos
        //metodo de mostrar usuarios
        public function mostrarUsuarios($pag) {
            $this->cantidadMostrar = 10;
            $this->pagina = $pag;
            $this->cantidadTotalRegistros = $this->con->query("SELECT * FROM usuarios");
            $this->redondeoFinal = ceil($this->cantidadTotalRegistros->num_rows/$this->cantidadMostrar);
            
            $this->consultaMostrar = "SELECT * FROM usuarios ORDER BY idUsuario DESC LIMIT ".(($this->pagina-1)*$this->cantidadMostrar).",".$this->cantidadMostrar;
            $this->consulta= $this->con->query($this->consultaMostrar);
            
            //$this->consulta=$this->con->query("SELECT * FROM usuarios ORDER BY apellido ASC, nombre ASC");
            $this->i=1;
            while($this->datos= $this->consulta->fetch_array()) {
                ?>
                    <tr>
                        <td>
                            <b><?php echo $this->i;?></b>
                            <img src="fotos/<?php echo $this->datos['idUsuario'];?>" width="50px">                            
                        </td>
                        <td><?php echo $this->datos['apellido'].", ".$this->datos['nombre'];?></td>
                        <td><?php echo $this->datos['usuario'];?></td>
                        <td><?php echo $this->datos['dni'];?></td>
                        <td><?php echo $this->datos['edad'];?></td>
                        <td><?php echo $this->datos['domicilio'].", ".$this->datos['localidad'].", ".$this->datos['provincia'].", ".$this->datos['nacionalidad'];?></td>
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
                       
                switch ($this->tipo){
                    case 'apellido': $this->consulta=$this->con->query("SELECT * FROM usuarios WHERE apellido LIKE '%$this->buscar%' ORDER BY apellido ASC, nombre ASC");
                        break;
                    case 'dni': $this->consulta=$this->con->query("SELECT * FROM usuarios WHERE dni = '$this->buscar'");
                        break;
                    case 'telefono': $this->consulta=$this->con->query("SELECT * FROM usuarios WHERE telefono = '$this->buscar' ORDER BY apellido ASC, nombre ASC");
                }
                $this->i=1;
                while($this->datos= $this->consulta->fetch_array()) {
                    ?>
                        <tr>
                            <td>
                                <b><?php echo $this->i;?></b>
                                <img src="fotos/<?php echo $this->datos['idUsuario'];?>" width="50px">                            
                            </td>
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
                       
        //metodo guardar
        public $consultadni;
        public $consultausuario;
        public $consultaemail;
        public $d;
        public $cu;
        public $ce;
        
        public function  guardar($usu,$pas,$ape,$nom,$dn,$em,$nac,$dom,$loc,$pro,$na,$tel,$sex,$pri,$idreg){
            include '../config/horasistema.php';
            $this->usuario=$usu;
            $this->password=$pas;
            $this->encriptado=sha1($this->password);
            $this->apellido=$ape;
            $this->nombre=$nom;
            $this->dni=$dn;
            $this->email=$em;
            $this->nacimiento=$nac;
            $this->domicilio=$dom;
            $this->localidad=$loc;
            $this->provincia=$pro;
            $this->nacionalidad=$na;
            $this->telefono=$tel;
            $this->sexo=$sex;
            $this->privilegio=$pri;
            $this->idregistrante=$idreg;
            
            
            
            $this->consultausuario=$this->con->query("SELECT usuario FROM usuarios WHERE usuario='$this->usuario'");
            $this->cu=$this->consultausuario->num_rows;
            $this->consultadni= $this->con->query("SELECT dni FROM usuarios WHERE dni='$this->dni'");
            $this->d= $this->consultadni->num_rows;
            $this->consultaemail=$this->con->query("SELECT email FROM usuarios WHERE email='$this->email'");
            $this->ce= $this->consultaemail->num_rows;
            
            if($this->cu==1){
                echo "<script>alert('El usuario ingresado ya existe');window.location.href='formnuevo.php';</script>";
            }
            elseif ($this->d==1) {
                echo "<script>alert('El dni ingresado ya existe');window.location.href='formnuevo.php';</script>";
            }
            elseif ($this->ce==1) {
                echo "<script>alert('El email ingresado ya existe');window.location.href='formnuevo.php';</script>";
            }
            else { 
            $this->consulta=$this->con->query("INSERT INTO usuarios (usuario,password,apellido,nombre,dni,email,nacimiento,
                domicilio,localidad,provincia,nacionalidad,telefono,sexo,privilegio,fechaUsuario,idRegistrante) VALUES ('$this->usuario','$this->encriptado',
                '$this->apellido','$this->nombre','$this->dni',$this->email','$this->nacimiento','$this->domicilio',
                '$this->localidad','$this->provincia','$this->nacionalidad','$this->telefono','$this->sexo','$this->privilegio',NOW(),'$this->idregistrante')");
                //echo "<script>alert('Usuario Registrado');window.location.href='index.php?pagina=1';</script>";
            $this->con->close();
        
            }
        }
        // metodo mostrar datos a modificar
        public $idusuario;
        public function datosmodificar($id) {
            $this->idusuario=$id;           
            $this->consulta= $this->con->query("SELECT * FROM usuarios WHERE idUsuario ='$this->idusuario'");            
            if($this->datos=$this->consulta->fetch_array()){
                ?>
                    <div class="row clearfix">
                        <div class=" col-md-3">
                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $this->datos['usuario']?>" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $this->datos['email']?>" required="">
                            </div>
                        </div> 
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $this->datos['nombre']?>" required="">
                            </div>  
                        </div>   
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $this->datos['apellido']?>" required="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input type="number" class="form-control" id="dni" name="dni" value="<?php echo $this->datos['dni']?>" required="">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="edad">Edad</label>
                                <input type="number" class="form-control" id="edad" name="edad" value="<?php echo $this->datos['edad']?>" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nacimiento">Nacimiento</label>
                                <input type="date" class="form-control" id="nacimiento" name="nacimiento" value="<?php echo $this->datos['nacimiento']?>" required="">                                
                            </div>  
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="domicilio">Domicilio</label>
                                <input type="text" class="form-control" id="domicilio" name="domicilio" value="<?php echo $this->datos['domicilio']?>" required="">
                            </div>  
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="localidad">Localidad</label>
                                <input type="text" class="form-control" id="localidad" name="localidad" value="<?php echo $this->datos['localidad']?>" required="">
                            </div>  
                        </div>  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="provincia">Provincia</label>
                                <input type="text" class="form-control" id="provincia" name="provincia" value="<?php echo $this->datos['provincia']?>" required="">
                            </div>  
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nacionalidad">Nacionalidad</label>
                                <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" value="<?php echo $this->datos['nacionalidad']?>" required="">
                            </div>  
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $this->datos['telefono']?>" required="">
                            </div>  
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sexo">Género</label>
                                <select class="form-control show-tick" name="sexo" id="sexo">                                
                                    <option value="F" <?php if($this->datos['sexo']=='F'){echo "selected='selected'";} ?>>Femenino</option>
                                    <option value="M" <?php if($this->datos['sexo']=='M'){echo "selected='selected'";} ?>>Masculino</option>
                                    <option value="O" <?php if($this->datos['sexo']=='O'){echo "selected='selected'";} ?>>Otro</option>
                            </select>
                            </div>  
                        </div>
                        <div class="col-md-3">
                            <label for="privilegio">Privilegio</label>
                            <select class="form-control show-tick" name="privilegio" id="privilegio" required="">                                
                                <option value="1" <?php if($this->datos['privilegio']==1){echo "selected='selected'";} ?>>Administrador</option>
                                <option value="2" <?php if($this->datos['privilegio']==2){echo "selected='selected'";} ?>>Usuario Estándar</option>
                                <option value="3" <?php if($this->datos['privilegio']==3){echo "selected='selected'";} ?>>Usuario Limitado</option>
                                <option value="4" <?php if($this->datos['privilegio']==4){echo "selected='selected'";} ?>>Cliente</option>
                                <option value="5" <?php if($this->datos['privilegio']==5){echo "selected='selected'";} ?>>Proveedor</option>
                                <option value="6" <?php if($this->datos['privilegio']==6){echo "selected='selected'";} ?>>Vendedor</option>
                            </select>
                        </div>                            
                    </div>   
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="foto">Imagen</label>
                        <input type="file" class="form-control" name="foto" id="foto">
                        </div>
                    </div>
                <?php                    
            }
            $this->con->close();
        }
        //metodo confirmar modificacion
        public function confirmarmodificacion($usu,$ape,$nom,$dn,$em,$nac,$dom,$loc,$pro,$na,$tel,$sex,$pri,$id,$ed){
            $this->usuario=$usu;
            $this->apellido=$ape;
            $this->nombre=$nom;
            $this->dni=$dn;
            $this->email=$em;
            $this->nacimiento=$nac;
            $this->domicilio=$dom;
            $this->localidad=$loc;
            $this->provincia=$pro;
            $this->nacionalidad=$na;
            $this->telefono=$tel;
            $this->sexo=$sex;
            $this->privilegio=$pri;
            $this->idusuario=$id;
            $this->edad=$ed;
            
            $this->consulta = $this->con->query("UPDATE usuarios SET usuario='$this->usuario', apellido='$this->apellido',
                                                                    nombre='$this->nombre', dni='$this->dni',
                                                                    email='$this->email', nacimiento='$this->nacimiento',
                                                                    domicilio='$this->domicilio', localidad='$this->localidad',
                                                                    provincia='$this->provincia', nacionalidad='$this->nacionalidad',
                                                                    telefono='$this->telefono', sexo='$this->sexo',
                                                                    privilegio='$this->privilegio',edad='$this->edad'
                                                WHERE idUsuario ='$this->idusuario'");
            if($_SESSION['idusu']== $this->idusuario){
                 $_SESSION['usu']=$this->apellido.", ".$this->nombre;
            }            
            
            echo "<script>alert('Usuario Modificado');window.location.href='index.php?pagina=1'</script>";
            $this->con->close();
        }
        // metodo eliminar usuario
        public function eliminarUsuario($id){
            $this->idusuario=$id;
            $this->consulta= $this->con->query("DELETE FROM usuarios WHERE idUsuario='$this->idusuario'");
            $this->con->close();
            echo "<script>alert('Usuario eliminado');window.location.href='index.php?pagina=1'</script>";
        }
        // metodo para cambiar la clave
        public $pass1;
        public $pass2;
        public $pass3;
        public function cambiarClave($idusu,$p1,$p2,$p3){
            $this->idusuario=$idusu;
            $this->pass1=$p1;
            $this->pass2=$p2;
            $this->pass3=$p3;
            
            $this->consulta=$this->con->query("SELECT password FROM usuarios WHERE idUsuario ='$this->idusuario'");
            if($this->datos = $this->consulta->fetch_array()){
                $this->password= $this->datos['password'];
            }
            if($this->pass1== $this->password){
                if($this->pass1==$this->pass2){
                    echo "<script>alert('La clave nueva no debe ser igual a la actual')</script>";
                } else if ($this->pass2== $this->pass3){
                    $this->con->query("UPDATE usuarios SET password='$this->pass2'  WHERE idUsuario ='$this->idusuario'");
                    echo "<script>alert('La clave se modificó exitosamente')</script>";
                }else{
                    echo "<script>alert('Las nuevas claves no coinciden')</script>";
                }
            }else{
                echo "<script>alert('La clave actual es incorrecta')</script>";
            }
        }
        //metodos para procesar la busqueda de ajax
        public function resultados($bus){
            $this->busqueda=$bus;
            $this->consulta= $this->con->query("SELECT * FROM usuarios WHERE apellido like '%$this->busqueda%'");
            if($this->busqueda==''){
                
            }else{
                
            
            ?>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="bg-blue">
                            <th>APELLIDO Y NOMBRE</th>
                            <th>DNI</th>
                            <th>EDAD</th>
                            <th>DIRECCIÓN</th>
                            <th>CONTACTO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($this->datos= $this->consulta->fetch_array()){
                               ?>
                                <tr>
                                    <td><?php echo $this->datos['apellido'].', '.$this->datos['nombre'] ?></td>
                                    <td><?php echo $this->datos['dni']?></td>
                                    <td><?php echo $this->datos['edad'] ?></td>
                                    <td><?php echo $this->datos['domicilio'] ?></td>
                                    <td><?php echo $this->datos['email']?></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table> 
            <?php            
            }            
        }
         
    }
?>