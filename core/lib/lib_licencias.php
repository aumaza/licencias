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
            <th class='text-nowrap text-center'>Período</th>
            <th class='text-nowrap text-center'>Fecha Desde</th>
            <th class='text-nowrap text-center'>Fecha Hasta</th>
            <th class='text-nowrap text-center'>Cantidad Días</th>
            <th class='text-nowrap text-center'>Fracción</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['agente']."</td>";
			 echo "<td align=center>".$fila['dni']."</td>";
			 echo "<td align=center>".$fila['periodo']."</td>";
			 echo "<td align=center>".$fila['f_desde']."</td>";
			 echo "<td align=center>".$fila['f_hasta']."</td>";
			 echo "<td align=center>".$fila['cant_dias']."</td>";
			 echo "<td align=center>".$fila['fraccion']."</td>";
			 echo "<td class='text-nowrap'>";
             echo '<form <action="#" method="POST">
                            <input type="hidden" name="name" value="'.$fila['id'].'">
                            
                            <button type="submit" class="btn btn-primary btn-sm" name="editar_licencia">
                            <img src="../icons/actions/document-edit.png"  class="img-reponsive img-rounded"> Editar Licencia</button>
                            
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
                     <form id="fr_nueva_licencia_ajax" method="POST">
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
                                    <input type="date" class="form-control" id="f_desde" name="f_desde" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="f_hasta">Fecha Hasta:</label>
                                    <input type="date" class="form-control" id="f_hasta" name="f_hasta" required>
                                </div><hr>
                            
                            </div>
                            
                            <div class="col-sm-3">
                            
                                <div class="form-group">
                                <label for="periodo">Período:</label>
                                <select class="form-control" id="periodo" name="periodo" required>';
                                
                                    for($i = 2020; $i <= 2050; $i++){
                                
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                echo '</select>
                                </div>
                                
                                <div class="form-group">
                                <label for="fraccion">Fracción:</label>
                                <select class="form-control" id="fraccion" name="fraccion">
                                    <option value="" selected disabled>Seleccionar</option>
                                    <option value="1">Primera</option>
                                    <option value="2">Segunda</option>
                                    <option value="3">Tercera</option>
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
                        
                            </div>
                            
                        
                        </div>
                        
                        
                        
                        <div class="row">
                        
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success" name="guardar_licencia" id="add_nueva_licencia" onclick="guardarLicencia();">
                                <img class="img-reponsive img-rounded" src="../icons/devices/media-floppy.png" /> Guardar</button>
                            </div>
                            
                        </div>
                        
                    </div>
                        </form> 
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
    return $dias;
}


// ================================================================== //
// PERSISTENCIA A BASE
function insertLicenciaOrdinaria($nombre,$dni,$antiguedad,$revista,$descripcion,$f_desde,$f_hasta,$periodo,$fraccion,$conn){
    
    mysqli_select_db($conn,'licor'); // seleccionamos base de datos
    
    $sql = "select total_lor from licencias where agente = '$nombre'";
    $query = mysqli_query($conn,$sql);
    while ($row = mysqli_fetch_array($query)){
        $total_lic = $row['total_lor'];
    }
    
    $cantidad_dias = dias_pasados($f_desde,$f_hasta);
    
    
    // evalua si el total de dias de licencia está vacio o no
    if(($total_lic == 0) || ($total_lic == '')){
    
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
                                
                                <div class="form-group">
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
