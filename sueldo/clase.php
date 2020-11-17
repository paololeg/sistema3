<?php
    include '../config/conexion.php';
   
    
    class Sueldo extends conexion{
        public $idSueldo;
        public $idUsuario;
        public $anioSueldo;
        public $mesSueldo;
        public $diasTrabajados;
        public $basico;
        public $obraSocial;
        public $antiguedad;
        public $diasFeriados;
        public $feriadosTrabajados;
        public $feriadosNoTrabajados;
        public $netoSueldo;
        public $fecha;
        public $consulta;
        public $datos;
        public $encontrados;
        
        // metodo para mostrar los empleados
        public function empleados() {
            $this->consulta= $this->con->query("SELECT * FROM usuarios where privilegio in (1,2,3,6) ORDER BY apellido, nombre ASC");
            while($this->datos= $this->consulta->fetch_array()){
                ?>
                    <option 
                        value="<?php echo $this->datos['idUsuario'];?>"
                    >
                        <?php echo $this->datos['apellido'].", ".$this->datos['nombre'];?>                    
                    </option>
                <?php
            }
            $this->con->close;
        }
        //metodo para consultar la liquidación
        public function liquidacion($mes, $anio, $idusu){
            $this->mesSueldo=$mes;
            $this->anioSueldo=$anio;
            $this->idUsuario=$idusu;
            
            $this->consulta= $this->con->query("SELECT * FROM sueldo WHERE mesSueldo='$this->mesSueldo' AND anioSueldo='$this->anioSueldo' AND idUsuario='$this->idUsuario'");
            $this->encontrados= $this->consulta->num_rows;
            if($this->encontrados==0){
                echo "
                    <script>
                        if(window.confirm('No existe liquidación, desea agregar una nueva liquidación para el empleado seleccionado en este periodo?')){
                            window.location.href='formnuevo.php?mesSueldo=$this->mesSueldo&anioSueldo=$this->anioSueldo&idUsuario=$this->idUsuario';
                        }
                    </script>
                     ";
            } else {
                if($this->datos= $this->consulta->fetch_array()){
                   $this->idSueldo= $this->datos['idSueldo']; 
                   echo "<a class=' btn btn-success' href='formmodificar.php?idSueldo=$this->idSueldo'>Modificar boleta de sueldo</a>";
                   echo "<h1>Se encontró boleta de sueldo</h1>"; 
                }
                
            }    
        }
        //metodo para guardar sueldo
        public function guardar($mes,$anio,$idusu,$dt,$bas,$os,$ant,$df,$ft,$fnt,$fec){
            $this->mesSueldo=$mes;
            $this->anioSueldo=$anio;
            $this->idUsuario=$idusu;
            $this->diasTrabajados=$dt;
            $this->basico=$bas;
            $this->obraSocial=$os;
            $this->antiguedad=$ant;
            $this->diasFeriados=$df;
            $this->feriadosTrabajados=$ft;
            $this->feriadosNoTrabajados=$fnt;
            $this->fecha=$fec;
            
            $this->consulta= $this->con->query("INSERT INTO sueldo (idUsuario,anioSueldo,mesSueldo,diasTrabajados,basico,
                                                obraSocial,antiguedad,diasFeriados,feriadosTrabajados,feriadosNoTrabajados,fecha)
                                                VALUES ('$this->idUsuario','$this->anioSueldo','$this->mesSueldo','$this->diasTrabajados',
                                                '$this->basico','$this->obraSocial','$this->antiguedad','$this->diasFeriados',
                                                '$this->feriadosTrabajados','$this->feriadosNoTrabajados','$this->fecha')");
            echo "<script>alert('Sueldo Registrado');window.location.href='index.php';</script>";
            $this->con->close();            
        }
        //modificación de liquidación
        public function datosModificar($ids){
            $this->idSueldo = $ids;
            $this->consulta= $this->con->query("SELECT * FROM sueldo WHERE idSueldo = '$this->idSueldo'");
            if($this->datos= $this->consulta->fetch_array()){
                ?>
                        <input type="text" id="mesSueldo" name="mesSueldo" value="<?php echo $this->datos['mesSueldo'] ?>" required="">
                        <input type="text" id="idSueldo" name="idSueldo" value="<?php echo $this->datos['idSueldo'] ?>" required="">
                        <div class="form-group">
                            <label for="diasTrabajados">Cantidad de días trabajados</label>
                            <input type="number" class="form-control" id="diasTrabajados" name="diasTrabajados" value="<?php echo $this->datos['diasTrabajados'] ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="basico">Básico</label>
                            <select class="form-control" id="basico" name="basico" required="">
                                <option value="">Seleccionar</option>
                                <option value="46790.08" <?php if($this->datos['basico']=="46790.08") {echo "selected='selected'";} ?>>Administrativo Cat. A</option>
                                <option value="46925.50" <?php if($this->datos['basico']=="46925.50") {echo "selected='selected'";} ?>>Administrativo Cat. B</option>
                                <option value="47400.06" <?php if($this->datos['basico']=="47400.06") {echo "selected='selected'";} ?>>Administrativo Cat. C</option>                                        
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="obraSocial">Obra Social</label>
                            <select class="form-control" id="obraSocial" name="obraSocial" required="">
                                <option value="">Seleccionar</option>
                                <option value="OSDE BINARIO" <?php if($this->datos['obraSocial']=="OSDE BINARIO") {echo "selected='selected'";} ?>>OSDE BINARIO</option>
                                <option value="OSECAC" <?php if($this->datos['obraSocial']=="OSECAC") {echo "selected='selected'";} ?>>OSECAC</option> 
                                <option value="PRENSA" <?php if($this->datos['obraSocial']=="PRENSA") {echo "selected='selected'";} ?>>PRENSA</option>
                                <option value="SUBSIDIO DE SALUD" <?php if($this->datos['obraSocial']=="SUBSIDIO DE SALUD") {echo "selected='selected'";} ?>>SUBSIDIO DE SALUD</option>   
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="antiguedad">Antigüedad</label>
                            <input type="number" class="form-control" id="antiguedad" name="antiguedad" value="<?php echo $this->datos['antiguedad'] ?>" required="" >
                        </div>
                        <div class="form-group">
                            <label for="diasFeriados">Cantidad de días feriados</label>
                            <input type="number" class="form-control" id="diasFeriados" name="diasFeriados" value="<?php echo $this->datos['diasFeriados'] ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="feriadosTrabajados">Cantidad de días feriados trabajados</label>
                            <input type="number" class="form-control" id="feriadosTrabajados" name="feriadosTrabajados" value="<?php echo $this->datos['feriadosTrabajados'] ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="feriadosNoTrabajados">Cantidad de días feriados no trabajados</label>
                            <input type="number" class="form-control" id="feriadosNoTrabajados" name="feriadosNoTrabajados" value="<?php echo $this->datos['feriadosNoTrabajados'] ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $this->datos['fecha'] ?>">
                        </div>                    
                    
                <?php    
            }
        }
        // confirmar modificación de boleta de sueldo
        public function confirmarModificacion($ids,$dt,$bas,$os,$ant,$df,$ft,$fnt,$fec){
            $this->idSueldo=$ids;
            $this->diasTrabajados=$dt;
            $this->basico=$bas;
            $this->obraSocial=$os;
            $this->antiguedad=$ant;
            $this->diasFeriados=$df;
            $this->feriadosTrabajados=$ft;
            $this->feriadosNoTrabajados=$fnt;
            $this->fecha=$fec;
            
            $this->consulta = $this->con->query("UPDATE sueldo SET diasTrabajados='$this->diasTrabajados',basico='$this->basico',"
                    . "obraSocial='$this->obraSocial', antiguedad='$this->antiguedad', diasFeriados='$this->diasFeriados', "
                    . "feriadosTrabajados='$this->feriadosTrabajados', feriadosNoTrabajados='$this->feriadosNoTrabajados',"
                    . " fecha='$this->fecha' WHERE idSueldo='$this->idSueldo'");
            echo "<script>alert('Sueldo modificado');window.location.href='index.php'</script>";
            $this->con->close();            
        }
    }
?>