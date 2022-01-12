<?php

// ========================================================================================= //
// LISTADOS //
/*
** funcion que carga la tabla de todos los usuarios
*/


function licencias($nombre,$conn){

if($conn)
{
	
	if($nombre == 'Administrador'){
        
        $sql = "SELECT * FROM licencias";
    	mysqli_select_db($conn,'licor');
    	$resultado = mysqli_query($conn,$sql);
    }
    if($nombre != 'Administrador'){
    
        $sql = "SELECT * FROM licencias where agente = '$nombre'";
    	mysqli_select_db($conn,'licor');
    	$resultado = mysqli_query($conn,$sql);
    
    }
	//mostramos fila x fila
	$count = 0;
	
	if($nombre == 'Administrador'){
	
	echo '<div class="container-fluid" style="margin-top:70px">
            <div class="panel panel-default" >
                <div class="panel-heading"><span class="pull-center "><img src="../icons/actions/view-calendar-timeline.png"  class="img-reponsive img-rounded"> Licencias de Todos los Agentes';
    
    echo '<p align="right">
            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalSelAgente" data-toggle="tooltip" title="Cargar Nueva Licencia">
                <img src="../icons/actions/task-new.png"  class="img-reponsive img-rounded"></button>
          </p>';
                  
    }
    if($nombre != 'Administrador'){
    
    echo '<div class="container-fluid" style="margin-top:70px">
            <div class="panel panel-default" >
	      <div class="panel-heading"><span class="pull-center "><img src="../icons/actions/view-calendar-timeline.png"  class="img-reponsive img-rounded"> Licencias de ' .$nombre;
	      
    echo '<form <action="#" method="POST">
            <input type="hidden" name="nombre" value="'.$nombre.'">
            <p align="right">
                <button type="submit" class="btn btn-default btn-sm" name="new_licencia" data-toggle="tooltip" title="Cargar Nueva Licencia">
                    <img src="../icons/actions/task-new.png"  class="img-reponsive img-rounded">
                </button>
            </p>
          </form>';
    
    }
    
    
    
	      
	echo '</div><br>';

            echo "<table class='table table-condensed table-hover' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>Agente</th>
            <th class='text-nowrap text-center'>DNI</th>
            <th class='text-nowrap text-center'>Licencia</th>
            <th class='text-nowrap text-center'>Fecha Desde</th>
            <th class='text-nowrap text-center'>Fecha Hasta</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['agente']."</td>";
			 echo "<td align=center>".$fila['dni']."</td>";
			 echo "<td align=center>".$fila['tipo_licencia']."</td>";
			 echo "<td align=center>".$fila['f_desde']."</td>";
			 echo "<td align=center>".$fila['f_hasta']."</td>";
			 echo "<td class='text-nowrap'>";
             echo '<form <action="#" method="POST">
                            <input type="hidden" name="id" value="'.$fila['id'].'">
                            
                            <button type="submit" class="btn btn-success btn-sm" name="more_info">
                            <img src="../icons/status/dialog-information.png"  class="img-reponsive img-rounded"> + Info</button>
                            
                            <button type="submit" class="btn btn-danger btn-sm" name="eliminar_licencia">
                            <img src="../icons/actions/trash-empty.png"  class="img-reponsive img-rounded"> Eliminar Licencia</button>
                        </form>';
             echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<button type="button" class="btn btn-primary">Cantidad de Licencias:  '.$count.' </button>';
		echo '</div></div>';
		}else{
		  echo 'Connection Failure...' .mysqli_error($conn);
		}

    mysqli_close($conn);

}


// ========================================================================================= //
// FORMULARIOS //
/*
** funcion que muestra el formulario de nueva licencia
*/
function formNuevaLicencia($nombre,$descripcion,$conn){

    $sql = "select * from agentes where nombre = '$nombre'";
    mysqli_select_db($conn,'licor');
    $query = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($query)){
        $dni = $row['dni'];
        $email = $row['email'];
        $antiguedad = $row['antiguedad'];
        $revista = $row['situacion_revista'];    
    }

    echo '<div class="container" style="margin-top:70px">
            <div class="panel panel-default">
                    
                <div class="panel-heading">
                    <img class="img-reponsive img-rounded" src="../icons/actions/list-add.png" /> Cargar Licencia
                </div>
                <div class="panel-body">
                     <form action="../lib/add_nueva_licencia.php" method="POST">
                    
                    <div class="container" style="margin-left:100px">
                        
                        <div class="row">
                            
                            <div class="col-sm-3">
                                
                                <div class="form-group">
                                    <label for="nombre">Nombre y Apellido:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="'.$nombre.'" required readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="dni">DNI:</label>
                                    <input type="text" class="form-control" id="dni" name="dni" maxlength="8" value="'.$dni.'" required readonly>
                                </div><hr>
                            </div>
                            
                            <div class="col-sm-3">
                                
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="'.$email.'" required readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="antiguedad">Antiguedad (Años):</label>
                                    <input type="number" class="form-control" id="antiguedad" name="antiguedad" value="'.$antiguedad.'" required readonly>
                                </div><hr>
                            
                            </div>
                            
                             <div class="col-sm-3">
                                
                                <div class="form-group">
                                    <label for="revista">Situación de revista:</label>
                                    <input type="text" class="form-control" id="revista" name="revista" value="'.$revista.'" required readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="licencia">Licencia a tomar:</label>
                                    <input type="text" class="form-control" id="licencia" name="licencia" value="'.$descripcion.'" required readonly>
                                </div><hr>
                                                              
                                
                            </div>
                            
                        </div>
                        
                        <div class="row">
                        
                            <div class="col-sm-3">
                            
                                <div class="form-group">
                                    <label for="f_desde">Fecha Desde:</label>
                                    <input type="date" class="form-control" id="f_desde" name="f_desde">
                                </div>
                                
                                <div class="form-group">
                                    <label for="f_hasta">Fecha Hasta:</label>
                                    <input type="date" class="form-control" id="f_hasta" name="f_hasta">
                                </div><hr>
                            
                            </div>';
                            
                            if($descripcion == 'Licencia Anual Ordinaria'){
                            
                            echo '<div class="col-sm-3">
                            
                                <div class="form-group">
                                <label for="periodo">Período:</label>
                                <select class="form-control" id="periodo" name="periodo" >';
                                
                                    for($i = 2020; $i <= 2050; $i++){
                                
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                echo '</select>
                                </div>
                                
                                <div class="form-group">
                                <label for="fraccion">Fracción:</label>
                                <select class="form-control" id="fraccion" name="fraccion">
                                    <option value="" selected disabled>Seleccionar</option>
                                    <option value="Primera">Primera</option>
                                    <option value="Segunda">Segunda</option>
                                    <option value="Tercera">Tercera</option>
                                </select>
                                </div><hr>
                            
                            </div>
                            
                            <div class="col-sm-4">
                        
                                <div class="well well-sm">
                                    <p align="justify">Tenga en cuenta que el sistema usará la cantidad de días correspondientes a la antiguedad
                                        y los propios del período seleccionado, hasta agotar estos días y/o la fracción. Si selecciona un período
                                        en el cual lo días ya han sido utilizados el sistema le informará que seleccione uno nuevo. Lo mismo ocurrirá
                                        si está solicitando la tercera fracción. <strong>Para utilizar la tercera fracción deberá solicitar permiso a su superior.</strong></p>
                                </div>
                        
                            </div>';
                            
                            }
                        
                        echo '</div>
                        
                        
                        
                        <div class="row">
                        
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success" name="guardar_licencia" >
                                <img class="img-reponsive img-rounded" src="../icons/devices/media-floppy.png" /> Guardar</button>
                            </div>
                            
                        </div>
                        
                    </div>
                        </form> 
                </div>
            </div>
          </div>';


}


/*
** FORMULARIO DE ELIMINAR UN REGISTRO DE LICENCIAS
*/
function formEliminarLicencia($id,$conn){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,'licor');
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $periodo = $fila['periodo'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
            }
            
            echo '<div class="container" style="margin-top:70px">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-danger">
            <div class="panel-heading"><img class="img-reponsive img-rounded" src="../icons/status/security-low.png" /> Licencia - Eliminar Registro</div>
            <div class="panel-body">
            <form id="fr_delete_licencia_ajax" method="POST">
            <input type="hidden" class="form-control" name="id" value="'.$id.'">
            
                <div class="alert alert-danger">
                <img class="img-reponsive img-rounded" src="../icons/status/task-attempt.png" /> <strong>Atención!</strong><hr>
                <p>Está por eliminar la Licencia: <strong>'.$licencia.'</strong></p>
                <p>Agente: <strong>'.$agente.'</strong></p>
                <p>Período: <strong>'.$periodo.'</strong></p>
                <p>Fecha Desde: <strong>'.$f_desde.'</strong></p>
                <p>Fecha Hasta: <strong>'.$f_hasta.'</strong</<p><hr>
                <p>Si está seguro, presione Aceptar, de lo contrario presione Cancelar.</p>
                </div><hr>
            
            <button type="submit" class="btn btn-success btn-block" name="delete_licencia" id="delete_licencia">Aceptar</button><br>
            </form>
            <a href="main.php"><button type="button" class="btn btn-danger btn-block">Cancelar</button></a>
            </div>
            </div>
            
            </div>
            </div>
            </div>';

}




// ========================================================================================= //
// MODAL //
function modalSelAgente($conn){
    
       
    echo '<div id="modalSelAgente" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Seleccione Agente a Cargar Licencia</h4>
                </div>
                <div class="modal-body">
                    
                  <form action="#" method="POST">
                  
                    <div class="form-group">
                    <label for="agente">Agente:</label>
                    <select class="form-control" name="agente" id="agente" >
                    <option value="" disabled selected>Seleccionar</option>';
                        
                        
                        $query = "SELECT nombre FROM agentes order by nombre ASC";
                        mysqli_select_db($conn,'licor');
                        $res = mysqli_query($conn,$query);

                        if($res){
                            while($valores = mysqli_fetch_array($res)){
                                echo '<option value="'.$valores[nombre].'" >'.$valores[nombre].'</option>';
                            }
                            }
                        
                    echo '</select>
                            </div><hr>
                            
                        <div class="form-group">
                        <label for="tipo_licencia">Tipo de Licencia:</label>
                        <select class="form-control" name="clase_licencia" id="tipo_licencia" onchange="CargarLicencias(this.value);">
                        <option value="" disabled selected>Seleccionar</option>';
                        
                        
                        $query = "SELECT clase_licencia FROM tipo_licencia group by clase_licencia ASC";
                        mysqli_select_db($conn,'licor');
                        $res = mysqli_query($conn,$query);

                        if($res){
                            while($valores = mysqli_fetch_array($res)){
                                echo '<option value="'.$valores[clase_licencia].'" >'.$valores[clase_licencia].'</option>';
                            }
                            }
                        
                    echo '</select>
                            </div><hr>
                            
                            
                        <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <select class="form-control" name="descripcion" id="descripcion" >
                        <div id="respuesta"></div>
                        </select>
                        </div><hr>
                    
                    <button type="submit" class="btn btn-default" name="select_agente">
                        <img src="../icons/actions/dialog-ok.png"  class="img-reponsive img-rounded"> Aceptar</button>
                    </form>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <img src="../icons/actions/dialog-close.png"  class="img-reponsive img-rounded"> Cerrar</button>
                </div>
                </div>

            </div>
            </div>';
            
}


// ================================================================== //
// FUNCIONES ESPECIFICAS

/*
** funcion que cuenta dias entre dos fechas
*/
function dias_pasados($f_desde,$f_hasta){
    
    $dias = (strtotime($f_desde) - strtotime($f_hasta)) / 86400;
    $dias = abs($dias); $dias = floor($dias);
    $dias = $dias + 1;
    return $dias;
}

/*
** FUNCION QUE COMPARA FECHAS
*/
function dateCompare($f_desde,$f_hasta){

    $f_desde = explode("-", $f_desde);   
    $f_hasta = explode("-", $f_hasta); 

    $dia_f_desde = $f_desde[2];  
    $mes_f_desde = $f_desde[1];  
    $anyo_f_desde = $f_desde[0]; 

    $dia_f_hasta = $f_hasta[2];  
    $mes_f_hasta = $f_hasta[1];  
    $anyo_f_hasta = $f_hasta[0];

    //$diasPrimeraJuliano = gregoriantojd($mes_f_desde, $dia_f_desde, $anyo_f_desde);  
    //$diasSegundaJuliano = gregoriantojd($mes_f_hasta, $dia_f_hasta, $anyo_f_hasta);     

    if((!checkdate($mes_f_desde, $dia_f_desde, $anyo_f_desde)) && (!checkdate($mes_f_hasta, $dia_f_hasta, $anyo_f_hasta))){
        // "Las fechas no son válidas";
        return -1;
    }else{
        
        if(($mes_f_desde == $mes_f_hasta) && ($anyo_f_desde == $anyo_f_hasta)){
            return 1; // el mes y año son iguales
        }else{
            return 0; // el mes y el año son distintos
        }
        
    } 

}


// ================================================================== //
// PERSISTENCIA A BASE
function insertLicenciaOrdinaria($nombre,$dni,$antiguedad,$revista,$descripcion,$f_desde,$f_hasta,$periodo,$fraccion,$conn){
        
    mysqli_select_db($conn,'licor'); // seleccionamos base de datos
    
    $sql_1 = "select * from licencias where agente = '$nombre'";
    $query_1 = mysqli_query($conn,$sql_1);
    while ($row_1 = mysqli_fetch_array($query_1)){
        $total_lic = $row_1['total_lor'];
        $periodo_agente = $row_1['periodo'];
        $fraccion_agente = $row_1['fraccion'];
        $dias_restantes_agente = $row_1['dias_restantes_lor'];
    }
    
    $cantidad_dias = dias_pasados($f_desde,$f_hasta);
    
    // primero evalua si se cargó alguna licencia, si no se cragado nada aún se carga
    
    if(($periodo_agente == '') && ($fraccion_agente == '') || ($periodo_agente == 'NULL') && ($fraccion_agente == 'NULL')){
            
    // evalua si el total de dias de licencia está vacio o no
    if(($total_lic == 0) || ($total_lic == '') || ($total_lic == 'NULL')){
    
        if($antiguedad <= 5){
            $total_lic = 20;        
        }
        if(($antiguedad > 5) && ($antiguedad <= 10)){
            $total_lic = 25;
        }
        if(($antiguedad > 10) && ($antiguedad <= 15)){
            $total_lic = 30;
        }
        if($antiguedad > 15){
            $total_lic = 35;
        }
    }
        
        // ahora evalua si posee dias para usar
        
        if($cantidad_dias <= $total_lic){
        
            $dias_restantes = $total_lic - $cantidad_dias;
            
            $sql_2 = "INSERT INTO licencias ".
                    "(agente,dni,periodo,f_desde,f_hasta,tipo_licencia,total_lor,dias_tomados_lor,dias_restantes_lor,fraccion)".
                    "VALUES ".
                    "('$nombre','$dni','$periodo','$f_desde','$f_hasta','$descripcion','$total_lic','$cantidad_dias','$dias_restantes','$fraccion')";
                    $query_2 = mysqli_query($conn,$sql_2);
                 
                 if($query_2){
                    echo 1; // registro incertado correctamente
                 }else{
                    echo -1; // error al incertar registro
                 }
        }
        if($cantidad_dias > $total_lic){
            echo 4; // la cantidad de dias a tomar es mayor de los que dispone
        }
    
    }
    
    // se evalua si el periodo y la fraccion ya fueron usados
    
    if(($periodo_agente == $periodo) && ($fraccion_agente == $fraccion)){
    
        if($fraccion_agente == 'Primera'){
            echo 11; // ya utilizó la primera fraccion
        }
        if($fraccion_agente == 'Segunda'){
            echo 13; // debe solitar permiso al superior
        }
        if($fraccion_agente == 'Tercera'){
            echo 15; // ya agotó todas las fracciones para dicho periodo
        }
    }
    
    // si el perido es el mismo pero la fraccion distinta, se evalua que fraccion va a usar
    
    if(($periodo_agente == $periodo) && ($fraccion_agente != $fraccion)){
        
        if(($fraccion_agente == 'Primera') && ($fraccion == 'Segunda')){
            
            if($cantidad_dias > $dias_restantes_agente){
            
                echo 4; // la cantidad de dias a tomar es mayor de los que dispone
            
            }
            else if($cantidad_dias <= $dias_restantes_agente){
            
                $dias_restantes = $dias_restantes_agente - $cantidad_dias;
            
                $sql_3 = "INSERT INTO licencias ".
                    "(agente,dni,periodo,f_desde,f_hasta,tipo_licencia,total_lor,dias_tomados_lor,dias_restantes_lor,fraccion)".
                    "VALUES ".
                    "('$nombre','$dni','$periodo','$f_desde','$f_hasta','$descripcion','$total_lic','$cantidad_dias','$dias_restantes','$fraccion')";
                $query_3 = mysqli_query($conn,$sql_3);
                
                if($query_3){
                    echo 1; // registro agregado correctamente
                }else{
                    echo -1; // hubo un problema al agregar el registro
                }
            }
            else if($dias_restantes_agente == 0){
                echo 19; // ya no posee mas dias para dicho periodo
            }
         }
         
         if(($fraccion_agente == 'Segunda') && ($fraccion == 'Tercera')){
            
            if($cantidad_dias <= $dias_restantes_agente){
                echo 13; // debe solicitar permiso al superior
            }else if($dias_restantes_agente == 0){
                echo 19; // ya no posee más dias para dicho periodo
            }
         
         }
         
         if(($fraccion_agente == 'Primera') && ($fraccion == 'Tercera')){
            echo 17; // debe hacer uso antes de la segunda fraccion
         }
         
         
         if(($fraccion_agente == 'Primera') && ($fraccion == 'Primera')){
            echo 11; // ya utilizó la primera fraccion
         }
         if(($fraccion_agente == 'Segunda') && ($fraccion == 'Segunda')){
            
            echo 13; // debe solitar permiso al superior
            
         }
          if(($fraccion_agente == 'Tercera') && ($fraccion == 'Tercera')){
            
            echo 15; // agotó todas las fracciones para dicho período
            
         }
       
         
    }
    
    
    if(($periodo_agente != $periodo) && (($fraccion_agente == '') || ($fraccion_agente == 'NULL'))){
    
        if($cantidad_dias > $total_lic){
            echo 4; // la cantidad de dias a tomar es mayor de la que dispone
        }
        if($cantidad_dias <= $total_lic){
        
            $dias_restantes = $total_lic - $cantidad_dias;
            
                $sql_4 = "INSERT INTO licencias ".
                    "(agente,dni,periodo,f_desde,f_hasta,tipo_licencia,total_lor,dias_tomados_lor,dias_restantes_lor,fraccion)".
                    "VALUES ".
                    "('$nombre','$dni','$periodo','$f_desde','$f_hasta','$descripcion','$total_lic','$cantidad_dias','$dias_restantes','$fraccion')";
                $query_4 = mysqli_query($conn,$sql_4);
                
                if($query_4){
                    echo 1; // registro agregado correctamente
                }else{
                    echo -1; // hubo un problema al agregar el registro
                }
        
        }
    
    }
 

}


/*
** LICENCIA AUSENTE CON AVISO
*/

function insertAusenteAviso($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn){

    mysqli_select_db($conn,'licor');
    $sql_1 = "select * from licencias where agente = '$nombre' and tipo_licencia = '$descripcion'";
    $query_1 = mysqli_query($conn,$sql_1);
    while($row_1 = mysqli_fetch_array($query_1)){
        $total_aca = $row_1['total_aca'];
        $dias_tomados_aca = $row_1['dias_tomados_aca'];
        $dias_resto_aca = $row_1['dias_restantes_aca'];
        $fecha = $row_1['f_hasta'];
    
    }
    
    $cant_dias = dias_pasados($f_desde,$f_hasta);
       
    if(($revista == 'Planta Permanente') || ($revista == 'Ley Marco')){
    
        if(($total_aca == '') || ($total_aca == 'NULL') || ($total_aca == 0) &&
            ($dias_tomados_aca == '') || ($dias_tomados_aca == 'NULL') || ($dias_tomados_aca == 0) &&
                ($dias_restantes_aca == '') || ($dias_restantes_aca == 'NULL') || ($dias_restantes_aca == 0)){
                
                    $total_dias = 6;
                
                    if($cant_dias <= 2){
                    
                        $dias_restantes = $total_dias - $cant_dias;
                        
                        $sql_2 = "INSERT INTO licencias ".
                                "(agente,dni,f_desde,f_hasta,tipo_licencia,total_aca,dias_tomados_aca,dias_restantes_aca)".
                                "VALUES ".
                                "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$total_dias','$cant_dias','$dias_restantes')";
                                $query_2 = mysqli_query($conn,$sql_2);
                            
                            if($query_2){
                                echo 1; // registro incertado correctamente
                            }else{
                                echo -1; // error al incertar registro
                            }
                                       
                    }else if($cant_dias > 2){
                        echo 23; // solo puede tomar hasta 2 dias seguidos de ausente con aviso
                    }
                               
                }
                
                if(($total_aca != '') || ($total_aca != 'NULL') || ($total_aca != 0) &&
                        ($dias_tomados_aca != '') || ($dias_tomados_aca != 'NULL') || ($dias_tomados_aca != 0) &&
                            ($dias_restantes_aca != '') || ($dias_restantes_aca != 'NULL') || ($dias_restantes_aca != 0)){
                        
                            $total_dias = 6;
                            $validarMes = dateCompare($fecha,$f_hasta);
                                                    
                        if($validarMes == 0){
                        
                            if(($dias_resto_aca >= 2) && ($dias_resto_aca <= 4)){
                                
                                $dias_restantes = $dias_resto_aca - $cant_dias;
                                
                                    $sql_3 = "INSERT INTO licencias ".
                                            "(agente,dni,f_desde,f_hasta,tipo_licencia,total_aca,dias_tomados_aca,dias_restantes_aca)".
                                            "VALUES ".
                                            "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$total_dias','$cant_dias','$dias_restantes')";
                                            $query_3 = mysqli_query($conn,$sql_3);
                                        
                                        if($query_3){
                                            echo 1; // registro incertado correctamente
                                        }else{
                                            echo -1; // error al incertar registro
                                        }
                            }else if($dias_resto_aca == 0){
                                echo 25; // ya no tiene mas dias para usar
                            }
                      
                      }if(($validarMes == 1) && ($dias_tomados_aca == 2)){
                        echo 27; // no puede tomar ausente con aviso dos veces en el mismo mes
                      }if(($validarMes == 1) && ($dias_tomados_aca == 1)){
                            
                            $dias_restantes = $dias_resto_aca - $cant_dias;
                                
                                    $sql_4 = "INSERT INTO licencias ".
                                            "(agente,dni,f_desde,f_hasta,tipo_licencia,total_aca,dias_tomados_aca,dias_restantes_aca)".
                                            "VALUES ".
                                            "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$total_dias','$cant_dias','$dias_restantes')";
                                            $query_4 = mysqli_query($conn,$sql_4);
                                        
                                        if($query_4){
                                            echo 1; // registro incertado correctamente
                                        }else{
                                            echo -1; // error al incertar registro
                                        }
                            
                      }else if($validarMes == -1){
                        echo 29; // las fechas no son válidas
                      }
                        
                }
    
    }
    
    if($revista == 'Contrato 1109'){
        echo 21; // solo planta permante y ley marco pueden solicitar ausentes con aviso
    }
    


}


/*
** ELIMINAR REGISTRO DE LICENCIA
*/
function deleteLicencia($id,$conn){

    mysqli_select_db($conn,'licor');
    $sql = "delete from licencias where id = '$id'";
    $query = mysqli_query($conn,$sql);
    
    if($query){
        echo 1; // registro eliminado
    }else{
        echo -1; // error al eliminar el registro
    }

}



// ================================================================== //
// TIPO DE LICENCIAS
// LISTADOS
/*
** funcion que carga la tabla de todos los tipos de licencias existentes
*/
function listarTipoLicencia($conn){

if($conn)
{
	$sql = "SELECT * FROM tipo_licencia";
    	mysqli_select_db($conn,'licor');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="container-fluid" style="margin-top:70px">
            <div class="panel panel-default" >
	      <div class="panel-heading"><span class="pull-center "><img src="../icons/actions/view-calendar-upcoming-events.png"  class="img-reponsive img-rounded"> Listado de Tipo de Licencia';
    echo '<form <action="#" method="POST">
            <p align="right">
                <button type="submit" class="btn btn-default btn-sm" name="new_tipo_licencia" data-toggle="tooltip" title="Añadir Tipo de Licencia">
                    <img src="../icons/actions/view-time-schedule-insert.png"  class="img-reponsive img-rounded">
                </button>
            </p>
          </form>';
	      
	echo '</div><br>';

            echo "<table class='table table-condensed table-hover' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>Tipo Licencia</th>
            <th class='text-nowrap text-center'>Descripción</th>
            <th class='text-nowrap text-center'>Artículo</th>
            <th class='text-nowrap text-center'>Revista</th>
            <th class='text-nowrap text-center'>Tiempo Licencia</th>
            <th class='text-nowrap text-center'>Goce Haberes</th>
            <th class='text-nowrap text-center'>Obligatoriedad</th>
            <th class='text-nowrap text-center'>Particularidades</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['clase_licencia']."</td>";
			 echo "<td align=center>".$fila['descripcion']."</td>";
			 echo "<td align=center>".$fila['art_licencia']."</td>";
			 echo "<td align=center>".$fila['tipo_revista']."</td>";
			 echo "<td align=center>".$fila['tiempo']."</td>";
			 echo "<td align=center>".$fila['goce_haberes']."</td>";
			 echo "<td align=center>".$fila['obligatoria']."</td>";
			 echo "<td align=justify>".$fila['particularidad']."</td>";
			 echo "<td class='text-nowrap'>";
             echo '<form <action="#" method="POST">
                            <input type="hidden" name="name" value="'.$fila['id'].'">
                            
                            <button type="submit" class="btn btn-primary btn-sm" name="editar_tipo_licencia">
                            <img src="../icons/actions/document-edit.png"  class="img-reponsive img-rounded"> Editar</button>
                            
                            <button type="submit" class="btn btn-danger btn-sm" name="borrar_tipo_licencia">
                            <img src="../icons/actions/trash-empty.png"  class="img-reponsive img-rounded"> Borrar</button>
                        </form>';
             echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<div class="well well-sm"><strong>Cantidad Tipo de Licencias:</strong>  '.$count.'</div>';
		echo '</div></div>';
		}else{
		  echo 'Connection Failure...' .mysqli_error($conn);
		}

    mysqli_close($conn);

}

// ================================================================== //
// FORMULARIOS
/*
** funcion que llama al formulario de cargar de nuevo tipo de licencia
*/
function formAltaTipoLicencia(){

    echo '<div class="container" style="margin-top:70px">
            <div class="panel panel-default">
                    
                <div class="panel-heading">
                    <img class="img-reponsive img-rounded" src="../icons/actions/list-add.png" /> Alta Tipo de Licencia
                </div>
                <div class="panel-body">
                     <form id="fr_nuevo_tipo_licencia_ajax" method="POST">
                    <div class="container" style="margin-left:100px">
                        
                        <div class="row">
                            
                            <div class="col-sm-3">
                                
                                <div class="form-group">
                                <label for="clase_licencia">Clase de Licencia:</label>
                                <select class="form-control" id="clase_licencia" name="clase_licencia" required>
                                    <option value="" selected disabled>Seleccionar</option>
                                    <option value="1">Licencias Ordinarias</option>
                                    <option value="2">Licencias Especiales</option>
                                    <option value="3">Licencias Extraordinarias con goce de haberes</option>
                                    <option value="4">Licencias Extraordinarias sin goce de haberes</option>
                                    <option value="5">Insistencias</option>
                                    <option value="6">Franquicias</option>
                                </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="descripcion">Descripción:</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="articulo">Artículo:</label>
                                    <input type="articulo" class="form-control" id="articulo" name="articulo" required>
                                </div><hr>
                                
                            </div>
                            
                            <div class="col-sm-3">
                                
                                <div class="form-group">
                                    <label for="revista">Tipo Situación de Revista:</label>
                                    <select class="form-control" id="revista" name="revista" required>
                                        <option value="" selected disabled>Seleccionar</option>
                                        <option value="1">Planta Permanente</option>
                                        <option value="2">No Permanente</option>
                                        <option value="3">Ambas</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">tomados
                                    <label for="tiempo">Plazos:</label>
                                    <input type="text" class="form-control" id="tiempo" name="tiempo" required>
                                </div>
                             
                                <div class="form-group">
                                    <label for="goce_haberes">Goce de Haberes:</label>
                                    <select class="form-control" id="goce_haberes" name="goce_haberes" required>
                                        <option value="" selected disabled>Seleccionar</option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                </select>
                                </div><hr>
                                
                                
                            </div>
                            
                             <div class="col-sm-3">
                             
                                <div class="form-group">
                                    <label for="obligatoriedad">Obligatoriedad:</label>
                                    <select class="form-control" id="obligatoriedad" name="obligatoriedad" required>
                                        <option value="" selected disabled>Seleccionar</option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="particularidad">Particularidades:</label>
                                    <textarea class="form-control" rows="4" id="particularidad" name="particularidad" required></textarea>
                                </div><hr>
                                                              
                                
                            </div>                                 
                        </div>
                        
                        <div class="row">
                        <div class="col-sm-3">
                        <button type="submit" class="btn btn-success" name="guardar_tipo_licencia" id="add_tipo_licencia">
                            <img class="img-reponsive img-rounded" src="../icons/devices/media-floppy.png" /> Guardar</button>
                        </div>
                        </div>
                        
                    </div>
                        </form> 
                </div>
            </div>
          </div>';


}


// ================================================================ //
// PERSISTENCIA A LA BASE
// persistir tipo de licencia
/*
** funcion que guarda registro de tipo de licencia
*/
function addTipoLicencia($clase_licencia,$descripcion,$articulo,$revista,$tiempo,$goce_haberes,$obligatoriedad,$particularidad,$conn){

    if((intValidator($clase_licencia) == 1) ||
            (nameValidator($descripcion) == 1) ||
                (nameValidator($articulo) == 1) ||
                    (intValidator($revista) == 1) ||
                        (nameValidator($tiempo) == 1) ||
                            (intValidator($goce_haberes) == 1) ||
                                (intValidator($obligatoriedad) == 1) ||
                                    (nameValidator($particularidad) == 1)){


    $sql = "INSERT INTO tipo_licencia ".
		"(clase_licencia,descripcion,art_licencia,tipo_revista,tiempo,goce_haberes,obligatoria,particularidad)".
		"VALUES ".
      "('$clase_licencia','$descripcion','$articulo','$revista','$tiempo','$goce_haberes','$obligatoriedad','$particularidad')";
    mysqli_select_db($conn,'licor');
    $query = mysqli_query($conn,$sql);
    
    if($query){
        echo 1; // el registro fue satisfactorio
    }else{
        echo -1; // hubo un problema al insertar el registro
    }
    }else{
        echo 2; // caracteres inválidos
    }

}


?>
