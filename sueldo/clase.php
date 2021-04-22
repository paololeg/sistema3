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
        public $presentismo;
        public $diaFeriado;
        public $diaNormal;
        public $sumaNoRemunerativa;
        public $antiguedadNoRemunerativa;
        public $presentismoNoRemunerativo;
        public $totalRemunerativo;
        public $totalNoRemunerativo;
        public $totalDescuento;
        public $jubilacion;
        public $ley;
        public $aporteos;
        public $secart100;
        public $faecysart100;
        public $secart101;
        public $aportefijo;


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
            
            $this->consulta= $this->con->query("SELECT * FROM sueldo s INNER JOIN usuarios u on u.idUsuario = s.idUsuario WHERE s.mesSueldo='$this->mesSueldo' AND s.anioSueldo='$this->anioSueldo' AND s.idUsuario='$this->idUsuario'");
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
                   ?>
                    <table style="height: 600px; width: 100%; " class="table-bordered">
                        <tr class="bg-blue">
                            <td colspan="5">Recibo de sueldo</td>
                        </tr>
                        <tr>
                            <td>Año: <?php echo $this->datos['anioSueldo']?> </td>
                            <td colspan="2">Jornada: <?php echo $this->datos['diasTrabajados']; ?></td>
                            <td colspan="2">Apellido: <?php echo $this->datos['apellido'] ?> </td>                           
                        </tr>
                        <tr>
                            <td>Mes: <?php echo $this->datos['mesSueldo'] ?></td>
                            <td colspan="2">Años de antiguedad: <?php echo $this->datos['antiguedad']?></td>
                            <td colspan="2">Nombre: <?php echo $this->datos['nombre'] ?></td>                           
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">DNI: <?php echo $this->datos['dni'] ?></td>                           
                        </tr>
                        <tr class="bg-blue">
                            <td>Conceptos</td>
                            <td>Unidades</td>
                            <td>Remunerativos</td>
                            <td>No Remunerativos</td>
                            <td>Descuentos</td>
                        </tr>
                        <tr>
                            <td>
                                Básico
                                <br>
                                Antiguedad
                                <br>
                                Presentismo
                                <br>
                                 
                                <br>
                                Días Feriados
                                <br>
                                Feriados trabajados
                                <br>
                                Feriados no trabajados
                                <br>
                                
                                <br>
                                Suma no remunerativa
                                <br>
                                Antiguedad no remunerativa
                                <br>
                                Presentismo no remunerativo
                                <br>
                                
                                <br>
                                Jubilación
                                <br>
                                Ley 19.032
                                <br>
                                Obra social
                                <br>
                                S.E.C Art.100 CCT 130/75
                                <br>
                                F.A.E.C y S. Art.100 CCT 130/75
                                <br>
                                S.E.C Art.101 CCT 130/75
                                <br>
                                Aporte fijo OSECAC
                                <br>
                               
                            </td>
                            <td>
                                <?php echo $this->datos['diasTrabajados'] ?>
                                <br>
                                <?php echo $this->datos['antiguedad'] ?> 
                                <br>
                                -
                                <br>
                                 
                                <br>
                                <?php echo $this->datos['diasFeriados'] ?>
                                <br>
                                <?php echo $this->datos['feriadosTrabajados'] ?>
                                <br>
                                <?php echo $this->datos['feriadosNoTrabajados'] ?>
                                <br>
                                 
                                <br>
                                -
                                <br>
                                - 
                                <br>
                                - 
                                <br>
                                 
                                <br>
                                11%
                                <br>
                                3%
                                <br>
                                3%
                                <br>
                                2%
                                <br>
                                0.5%
                                <br>
                                2%
                                <br>
                                -
                                <br>
                            </td>
                            <td>
                                $<?php echo $this->basico= round($this->datos['basico'],2) ?>
                                <br>
                                $<?php echo $this->antiguedad= round(($this->basico * $this->datos['antiguedad'])/100,2) ?>
                                <br>
                                $<?php echo $this->presentismo= round(($this->basico + $this->antiguedad)/100,2) ?>
                                <br>
                                 
                                <br>
                                $-<?php echo $this->diasFeriados= round((($this->basico + $this->antiguedad + $this->presentismo)/30) * $this->datos['diasFeriados'],2) ?>
                                <br>
                                $<?php 
                                    $this->diaNormal = round(($this->basico + $this->antiguedad + $this->presentismo)/30,2);
                                    $this->diaFeriado = round(($this->basico + $this->antiguedad + $this->presentismo)/25,2);
                                    echo $this->feriadosTrabajados= round(($this->diaFeriado + $this->diaNormal) * $this->datos['feriadosTrabajados'] ,2) 
                                ?>
                                <br>
                                $<?php echo $this->feriadosNoTrabajados= round((($this->basico + $this->antiguedad + $this->presentismo)/25) * $this->datos['feriadosNoTrabajados'],2) ?>
                                <br>
                                
                                <br>
                                -
                                <br>
                                - 
                                <br>
                                - 
                                <br>
                                
                                <br>
                                -
                                <br>
                                - 
                                <br>
                                <?php echo $this->datos['obraSocial'] ?>
                                <br>
                                -
                                <br>
                                -
                                <br>
                                - 
                                <br>
                                - 
                                <br>
                                
                            </td>
                            <td>
                                -
                                <br>
                                - 
                                <br>
                                - 
                                <br>
                                
                                <br>
                                -
                                <br>
                                - 
                                <br>
                                - 
                                <br>
                                
                                <br>
                                $<?php echo $this->sumaNoRemunerativa = round(($this->basico * 4.5)/100,2); ?>
                                <br>
                                $<?php echo $this->antiguedadNoRemunerativa = round(($this->sumaNoRemunerativa * $this->datos['antiguedad'])/100,2) ; ?>
                                <br>
                                $<?php echo $this->presentismoNoRemunerativo = round(($this->sumaNoRemunerativa + $this->antiguedadNoRemunerativa)/12,2) ?>
                                <br>
                                 
                                <br>
                                -
                                <br>
                                - 
                                <br>
                                - 
                                <br>
                                - 
                                <br>
                                -
                                <br>
                                -
                                <br>
                                -
                                <br>                            
                            </td>
                            <td>
                                 -
                                <br>
                                - 
                                <br>
                                - 
                                <br>
                                
                                <br>
                                -
                                <br>
                                - 
                                <br>
                                - 
                                <br>
                                
                                <br>
                                -
                                <br>
                                -
                                <br>
                                -
                                <br>
                                 
                                <br>
                                $<?php  
                                    $this->totalRemunerativo = $this->basico + $this->antiguedad + $this->presentismo - 
                                                               $this->diasFeriados + $this->feriadosTrabajados + 
                                                               $this->feriadosNoTrabajados;
                                    echo $this->jubilacion = round(($this->totalRemunerativo * 11)/100,2)
                                
                                ?>
                                <br>
                                $<?php echo $this->aporteos = round(($this->totalRemunerativo * 3)/100,2) ?> 
                                <br>
                                $<?php echo $this->ley = round(($this->totalRemunerativo * 3)/100,2) ?>
                                <br>
                                $<?php echo $this->secart100 = round(($this->totalRemunerativo * 2)/100,2) ?> 
                                <br>
                                $<?php echo $this->faecysart100 = round(($this->totalRemunerativo * 0.5)/100,2) ?>
                                <br>
                                $<?php echo $this->secart101 = round(($this->totalRemunerativo * 2)/100,2) ?>
                                <br>
                                $<?php echo $this->aportefijo = 100 ?>
                                <br>  
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="bg-blue">
                            <td colspan="2" class="text-left">Subtotales</td>
                            <td>$<?php echo $this->totalRemunerativo?></td>
                            <td>$<?php 
                                    $this->totalNoRemunerativo = $this->sumaNoRemunerativa + $this->antiguedadNoRemunerativa + 
                                                                 $this->presentismoNoRemunerativo;
                                    echo $this->totalNoRemunerativo                                            
                                ?>
                            </td>
                            <td>$<?php 
                                    $this->totalDescuento = $this->jubilacion + $this->ley + $this->aporteos + $this->secart100 + 
                                                            $this->faecysart100 + $this->secart101 + $this->aportefijo;
                                    echo $this->totalDescuento
                                 ?>
                            
                            </td>
                        </tr>                       
                        <tr class="bg-blue">                            
                            <td colspan="4" class="text-right">Neto</td>
                            <td> $<?php 
                                    $this->netoSueldo = $this->totalRemunerativo + $this->totalNoRemunerativo - $this->totalDescuento ;
                                    echo $this->netoSueldo 
                                 ?>
                            </td>
                        </tr>
                    </table>
                   <?php
                   //
                   $this->con->query("UPDATE sueldo SET netoSueldo='$this->netoSueldo' WHERE idSueldo=$this->idSueldo");
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
            echo "<script>alert('Sueldo Registrado');
                    window.location.href='index.php?mesSueldo=$this->mesSueldo&anioSueldo=$this->anioSueldo&idUsuario=$this->idUsuario';                    
                  </script>";
            $this->con->close();            
        }
        //modificación de liquidación
        public function datosModificar($ids){
            $this->idSueldo = $ids;
            $this->consulta= $this->con->query("SELECT * FROM sueldo WHERE idSueldo = '$this->idSueldo'");
            if($this->datos= $this->consulta->fetch_array()){
                ?>
                        <input type="hidden" id="mesSueldo" name="mesSueldo" value="<?php echo $this->datos['mesSueldo'] ?>" required="">
                        <input type="hidden" id="anioSueldo" name="anioSueldo" value="<?php echo $this->datos['anioSueldo']?>" required="">
                        <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $this->datos['idUsuario']?>" required="" >
                        <input type="hidden" id="idSueldo" name="idSueldo" value="<?php echo $this->datos['idSueldo'] ?>" required="">
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
                        <div class="form-group">                                
                            <button class="btn btn-success" type="submit">Modificar</button>
                            <a class="btn btn-danger" href="index.php?mesSueldo=<?php echo $this->datos['mesSueldo']?>&anioSueldo=<?php echo $this->datos['anioSueldo']?>&idUsuario=<?php echo $this->datos['idUsuario']?>">Cancelar</a>
                        </div>
                    
                <?php    
            }
        }
        // confirmar modificación de boleta de sueldo
        public function confirmarModificacion($ids,$dt,$bas,$os,$ant,$df,$ft,$fnt,$fec,$ms,$as,$idu){            
            $this->idSueldo=$ids;
            $this->diasTrabajados=$dt;
            $this->basico=$bas;
            $this->obraSocial=$os;
            $this->antiguedad=$ant;
            $this->diasFeriados=$df;
            $this->feriadosTrabajados=$ft;
            $this->feriadosNoTrabajados=$fnt;
            $this->fecha=$fec;
            $this->mesSueldo=$ms;
            $this->anioSueldo=$as;
            $this->idUsuario=$idu;
            
            $this->consulta = $this->con->query("UPDATE sueldo SET diasTrabajados='$this->diasTrabajados',basico='$this->basico',"
                    . "obraSocial='$this->obraSocial', antiguedad='$this->antiguedad', diasFeriados='$this->diasFeriados', "
                    . "feriadosTrabajados='$this->feriadosTrabajados', feriadosNoTrabajados='$this->feriadosNoTrabajados',"
                    . " fecha='$this->fecha' WHERE idSueldo='$this->idSueldo'");
            echo "<script>alert('Sueldo modificado');window.location.href='index.php?mesSueldo=$this->mesSueldo&anioSueldo=$this->anioSueldo&idUsuario=$this->idUsuario'</script>";
            $this->con->close();            
        }
        
    }
?>