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
    }
?>