<?php

// ========================================================================================= //
// LISTADOS //
/*
** funcion que carga la tabla de todos los usuarios
*/


function licencias($nombre,$conn,$dbase){


$fecha_actual = date("Y-m-d");


if($conn)
{
	
	if($nombre == 'Administrador'){
        
        $sql = "SELECT * FROM licencias order by f_desde ASC";
    	mysqli_select_db($conn,$dbase);
    	$resultado = mysqli_query($conn,$sql);
    }
    if($nombre != 'Administrador'){
    
        $sql = "SELECT * FROM licencias where agente = '$nombre'";
    	mysqli_select_db($conn,$dbase);
    	$resultado = mysqli_query($conn,$sql);
    
    }
	//mostramos fila x fila
	$count = 0;
	
	if(($nombre == 'Administrador') || ($nombre != 'Administrador')){
	
	echo '<div class="container-fluid" style="margin-top:70px">
            <div class="panel panel-default" >
                <div class="panel-heading"><span class="pull-center "><img src="../icons/actions/view-calendar-timeline.png"  class="img-reponsive img-rounded"> Licencias';
                    
    echo '<p align="right">
            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalSelAgente" data-toggle="tooltip" title="Cargar Nueva Licencia">
                <img src="../icons/actions/task-new.png"  class="img-reponsive img-rounded"></button>
          </p>';
                  
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
			 if($fila['f_desde'] == $fecha_actual){
			 echo '<td align=center style="background-color:green"><font color="white">'.$fila['f_desde'].'</font></td>';
			 }else{
			 echo '<td align=center>'.$fila['f_desde'].'</td>';
			 }
			 echo "<td align=center>".$fila['f_hasta']."</td>";
			 echo "<td class='text-nowrap'>";
             echo '<form <action="#" method="POST">
                            <input type="hidden" name="id" value="'.$fila['id'].'">
                            
                            <button type="submit" class="btn btn-success btn-sm" name="more_info">
                            <img src="../icons/status/dialog-information.png"  class="img-reponsive img-rounded"> + Info</button>';
                            
                            if($fecha_actual <= $fila['f_desde']){
                            
                            echo '<button type="submit" class="btn btn-danger btn-sm" name="eliminar_licencia">
                                    <img src="../icons/actions/trash-empty.png"  class="img-reponsive img-rounded"> Eliminar Licencia</button>';
                            }
             echo '</form>';
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
function formNuevaLicencia($nombre,$descripcion,$conn,$dbase){

    $sql = "select * from agentes where nombre = '$nombre'";
    mysqli_select_db($conn,$dbase);
    $query = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($query)){
        $dni = $row['dni'];
        $email = $row['email'];
        $antiguedad = $row['antiguedad'];
        $revista = $row['situacion_revista'];    
    }
    
     $fecha_actual = date("Y-m-d");
    
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
                                    <label for="antiguedad">Antiguedad (A??os):</label>
                                    <input type="number" class="form-control" id="antiguedad" name="antiguedad" value="'.$antiguedad.'" required readonly>
                                </div><hr>
                            
                            </div>
                            
                             <div class="col-sm-3">
                                
                                <div class="form-group">
                                    <label for="revista">Situaci??n de revista:</label>
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
                                    <input type="date" class="form-control" id="f_desde" name="f_desde" min = '.$fecha_actual.' '.$fecha_actual.'>
                                </div>
                                
                                <div class="form-group">
                                    <label for="f_hasta">Fecha Hasta:</label>
                                    <input type="date" class="form-control" id="f_hasta" name="f_hasta" min = '.$fecha_actual.' '.$fecha_actual.'>
                                </div><hr>
                            
                            </div>';
                            
                            if($descripcion == 'Licencia Anual Ordinaria'){
                            
                            echo '<div class="col-sm-3">
                            
                                <div class="form-group">
                                <label for="periodo">Per??odo:</label>
                                <select class="form-control" id="periodo" name="periodo" >';
                                
                                    for($i = 2020; $i <= 2050; $i++){
                                
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    
                                echo '</select>
                                </div>
                                
                                <div class="form-group">
                                <label for="fraccion">Fracci??n:</label>
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
                                    <p align="justify">Tenga en cuenta que el sistema usar?? la cantidad de d??as correspondientes a la antiguedad
                                        y los propios del per??odo seleccionado, hasta agotar estos d??as y/o la fracci??n. Si selecciona un per??odo
                                        en el cual lo d??as ya han sido utilizados el sistema le informar?? que seleccione uno nuevo. Lo mismo ocurrir??
                                        si est?? solicitando la tercera fracci??n. <strong>Para utilizar la tercera fracci??n deber?? solicitar permiso a su superior.</strong></p>
                                </div>
                        
                            </div>';
                            
                            }
                            
                            if($descripcion == 'Fallecimiento'){
                            
                               echo '<div class="col-sm-3">
                                        <div class="form-group">
                                        <label for="fraccion">Tipo de Relaci??n Parental:</label>
                                        <select class="form-control" id="parentalidad" name="parentalidad">
                                            <option value="" selected disabled>Seleccionar</option>
                                            <option value="1">Familiar Directo (Conyuge / Hijos / Hermanos)</option>
                                            <option value="2">Familiar Cosangu??neo (Sobrino / T??o)</option>
                                        </select>
                                        </div><hr>
                                    </div>';
                            
                            }
                            
                            if(($descripcion == 'Horarios para estudiantes') || ($descripcion == 'Reducci??n horaria para agentes madres de lactantes')){
                            
                                echo '<div class="col-sm-3">
                                        <div class="form-group">
                                        <label for="cant_horas">Cantidad Horas:</label>
                                        <select class="form-control" id="cant_horas" name="cant_horas">
                                            <option value="" selected disabled>Seleccionar</option>
                                            <option value="1800">1/2 Hora</option>
                                            <option value="1">1 Hora</option>
                                            <option value="2">2 Horas</option>
                                            <option value="3">3 Horas</option>
                                            <option value="4">4 Horas</option>
                                        </select>
                                        </div><hr></div>';
                            }
                            
                            if(($descripcion == 'Afecciones largo tratamiento') || ($descripcion == 'Accidente de trabajo')){
                            
                                echo '<div class="col-sm-3">
                                        <div class="form-group">
                                        <label for="cant_anios">Cantidad A??os:</label>
                                        <select class="form-control" id="cant_anios" name="cant_anios">
                                            <option value="" selected disabled>Seleccionar</option>
                                            <option value="1">1 A??o</option>
                                            <option value="2">2 A??os</option>
                                            <option value="3">3 A??os</option>
                                            <option value="4">4 A??os</option>
                                        </select>
                                        </div><hr></div>';
                            
                            }
                            
                            if($descripcion == 'Maternidad'){
                                
                                echo '<div class="col-sm-3">
                                        <div class="form-group">
                                        <label for="parto_multiple">Parto Multiple:</label>
                                        <select class="form-control" id="parto_multiple" name="parto_multiple">
                                            <option value="" selected disabled>Seleccionar</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                        </div><hr></div>';
                            
                            }
                            
                            if($descripcion == 'Tenencia para adopci??n'){
                                    
                                echo '<div class="col-sm-3">
                                      <div class="form-group">
                                            <label for="edad_ninio">Edad del Menor:</label>
                                            <input type="number" class="form-control" id="edad_ninio" name="edad_ninio" min="1" max="7" required >
                                      </div>
                                      </div><hr>';
                            
                            }
                            
                            if($descripcion == 'Maternidad (Nac. sin vida)'){
                                
                                echo '<div class="col-sm-3">
                                        <div class="form-group">
                                        <label for="parto_multiple">Parto Multiple:</label>
                                        <select class="form-control" id="parto_multiple" name="parto_multiple">
                                            <option value="" selected disabled>Seleccionar</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                        </div><hr></div>';
                            
                            }
                            
                            if($descripcion == 'Maternidad Excedencia'){
                            
                                echo '<div class="col-sm-3">
                                        <div class="form-group">
                                        <label for="opciones">Opci??n de Usufructo:</label>
                                        <select class="form-control" id="opciones" name="opciones">
                                            <option value="" selected disabled>Seleccionar</option>
                                            <option value="1">Sin percibir haberes por un per??odo de 3 meses</option>
                                            <option value="2">Sin percibir haberes por un per??odo de 6 meses</option>
                                            
                                        </select>
                                        </div>                                       
                                        <hr>
                                        </div>';
                            
                            }
                            
                            if($descripcion == 'Para Rendir Examenes'){
                            
                                echo '<div class="col-sm-3">
                                        <div class="form-group">
                                        <label for="cursando">Estudios en Curso:</label>
                                        <select class="form-control" id="cursando" name="cursando">
                                            <option value="" selected disabled>Seleccionar</option>
                                            <option value="1">Secundario</option>
                                            <option value="2">Terciario / Universitario / Postgrado</option>
                                            
                                        </select>
                                        </div>                                       
                                        <hr>
                                        </div>';                      
                            
                            }
                            
                            if($descripcion == 'Para Realizar estudios o Investigaciones'){
                                
                                echo '<div class="col-sm-3">
                                        <div class="form-group">
                                        <label for="anios_investigacion">Cantidad de A??os de Investigaci??n:</label>
                                        <select class="form-control" id="anios_investigacion" name="anios_investigacion">
                                            <option value="" selected disabled>Seleccionar</option>
                                            <option value="1">1 A??o</option>
                                            <option value="2">2 A??os</option>
                                            
                                        </select>
                                        </div>                                       
                                        <hr>
                                        </div>';
                                
                            }
                            
                            if($descripcion == 'Matrimonio del agente o hijos'){
                                
                                echo '<div class="col-sm-3">
                                        <div class="form-group">
                                        <label for="matrimonio">Persona que Contrae Matrimonio:</label>
                                        <select class="form-control" id="matrimonio" name="matrimonio">
                                            <option value="" selected disabled>Seleccionar</option>
                                            <option value="1">Matrimonio del Agente</option>
                                            <option value="2">Matrimonio del Hijo del Agente</option>
                                            
                                        </select>
                                        </div>                                       
                                        <hr>
                                        </div>';
                                
                            }
                            
                            if($descripcion == 'Razones Particulares'){
                                
                                echo '<div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="mese">Cantidad Meses:</label>
                                            <input type="text" class="form-control" id="meses" name="meses" value="6" readonly required>
                                        </div>                                       
                                        <hr>
                                        </div>';
                                
                            }
                            
                            if($descripcion == 'Razones de Estudio'){
                                
                                echo '<div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="anio">Per??odo M??ximo (1 a??o):</label>
                                            <input type="text" class="form-control" id="anio" name="anio" value="1" readonly required>
                                        </div>                                       
                                        <hr>
                                        </div>';
                                
                            }
                            
                        echo '</div>
                        
                        
                        
                        <div class="row">
                        
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success" name="guardar_licencia" id="add_nueva_licencia" >
                                <img class="img-reponsive img-rounded" src="../icons/devices/media-floppy.png" /> Guardar</button><hr>
                                
                                <button type="submit" class="btn btn-default" name="licencias">
                                    <img class="img-reponsive img-rounded" src="../icons/actions/object-rotate-left.png" /> Volver a Licencias</button>
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
function formEliminarLicencia($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
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
                <img class="img-reponsive img-rounded" src="../icons/status/task-attempt.png" /> <strong>Atenci??n!</strong><hr>
                <p>Est?? por eliminar la Licencia: <strong>'.$licencia.'</strong></p>
                <p>Agente: <strong>'.$agente.'</strong></p>
                <p>Per??odo: <strong>'.$periodo.'</strong></p>
                <p>Fecha Desde: <strong>'.$f_desde.'</strong></p>
                <p>Fecha Hasta: <strong>'.$f_hasta.'</strong</<p><hr>
                <p>Si est?? seguro, presione Aceptar, de lo contrario presione Cancelar.</p>
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


/*
** FORMULARIO SUBIR COMPROBANTE
*/
function formSubirComprobante($id,$conn){

                    
            echo '<div class="container" style="margin-top:70px">
            <div class="row">
            <div class="col-sm-8">
            
            <div class="panel panel-default">
            <div class="panel-heading"><img class="img-reponsive img-rounded" src="../icons/actions/svn-commit.png" /> Licencia - Subir Comprobante</div>
            <div class="panel-body">
            <form action="#" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="id" value="'.$id.'">
            
                <div class="alert alert-default">
                <img class="img-reponsive img-rounded" src="../icons/status/task-attempt.png" /> <strong>Atenci??n!</strong> Est?? por subir comprobante de Licencia<hr>
                <label for="file">Seleccione Archivo de su PC:</label>
                <input type="file" id="file" name="file">
                </div><hr>
            
            <button type="submit" class="btn btn-success btn-block" name="subir_comprobante"">Aceptar</button><br>
            </form>
            
            </div>
            </div>
            
            </div>
            </div>
            </div>';

}


// ======================================================================================================================================================== //
// INFORMES //
// ======================================================================================================================================================== //

/*
** FORMULARIO DE INFORMACION ADICIONAL SOBRE LICENCIA ORDINARIA
*/
function formInfoLicencias($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
        }
            
            echo '<div class="container" style="margin-top:70px">
            <div class="row">
            <div class="col-sm-8">
          
            <div class="panel panel-info">
            <div class="panel-heading">
                <h2 align="center"><img class="img-reponsive img-rounded" src="../icons/status/dialog-information.png" /> 
                Licencias - Informaci??n Extendida</h2>
            </div>
            <div class="panel-body">';
            
            if($licencia == 'Licencia Anual Ordinaria'){
                infoLicor($id,$conn,$dbase);
            }
            if($licencia == 'Razones Particulares (Ausente con Aviso)'){
                infoAca($id,$conn,$dbase);
            }
            if($licencia == 'Nacimientos'){
                infoPaternidad($id,$conn,$dbase);
            }
            if($licencia == 'Fallecimiento'){
                infoFallecimiento($id,$conn,$dbase);
            }
            if($licencia == 'Razones Especiales (Fuerza Mayor)'){
                infoFuerzaMayor($id,$conn,$dbase);
            }
            if($licencia == 'Donaci??n de Sangre'){
                infoDonarSangre($id,$conn,$dbase);
            }
            if($licencia == 'Mesas Examinadoras'){
                infoMesaExaminadora($id,$conn,$dbase);
            }
            if($licencia == 'Horarios para estudiantes'){
                infoHorariosEstudiantes($id,$conn,$dbase);
            }
            if($licencia == 'Reducci??n horaria para agentes madres de lactantes'){
                infoMadresLactantes($id,$conn,$dbase);
            }
            if($licencia == 'Asistencia a congresos'){
                infoAsistenciaCongresos($id,$conn,$dbase);
            }
            if($licencia == 'Afecciones de corto tratamiento'){
                infoCortoTratamiento($id,$conn,$dbase);
            }
            if($licencia == 'Afecciones largo tratamiento'){
                infoLargoTratamiento($id,$conn,$dbase);
            }
            if($licencia == 'Accidente de trabajo'){
                infoAccidenteTrabajo($id,$conn,$dbase);
            }
            if($licencia == 'Incapacidad'){
                infoIncapacidad($id,$conn,$dbase);
            }
            if($licencia == 'Anticipo de haber por pasividad'){
                infoAnticipoPasividad($id,$conn,$dbase);
            }
            if($licencia == 'Maternidad'){
                infoMaternidad($id,$conn,$dbase);
            }
            if($licencia == 'Tenencia para adopci??n'){
                infoAdopcion($id,$conn,$dbase);
            }
            if($licencia == 'Maternidad (Nac. sin vida)'){
                infoNacimientoSinVida($id,$conn,$dbase);
            }
            if($licencia == 'Maternidad Excedencia'){
                infoMaternidadExcedencia($id,$conn,$dbase);
            }
            if($licencia == 'Para Rendir Examenes'){
                infoRendirExamen($id,$conn,$dbase);
            }
            if($licencia == 'Para Realizar estudios o Investigaciones'){
                infoEstudiosInvestigaciones($id,$conn,$dbase);
            }
            if($licencia == 'Estudios en Escuela Defensa Nacional'){
                infoEstudiosDefensaNacional($id,$conn,$dbase);
            }
            if($licencia == 'Matrimonio del agente o hijos'){
                infoMatrimonioAgente($id,$conn,$dbase);
            }
            if($licencia == 'Actividades Deportivas no rentadas'){
                infoActividadesDeportivas($id,$conn,$dbase);
            }
            if($licencia == 'Ejercicio Transitorio de otros cargos'){
                infoCargosTransitorios($id,$conn,$dbase);
            }
            if($licencia == 'Razones Particulares'){
                infoRazonesparticulares($id,$conn,$dbase);
            }
            if($licencia == 'Razones de Estudio'){
                infoRazonesEstudios($id,$conn,$dbase);
            }
            if($licencia == 'Acompa??ar C??nyuge'){
                infoAcompa??arConyuge($id,$conn,$dbase);
            }
            if($licencia == 'Cargos, horas C??tedra'){
                infoHorasCatedra($id,$conn,$dbase);
            }
            
               
                
                
                
            echo '<form action="#" method="POST">
                    <button type="submit" class="btn btn-default btn-block" name="licencias">
                        <img class="img-reponsive img-rounded" src="../icons/actions/object-rotate-left.png" /> Volver a Licencias</button>
                  </form>
            
            </div>
            
            </div>
            </div>
            
            </div>
            </div>
            </div>';


}


/*
** FUNCION INFO LICENCIA ANUAL ORDINARIA
*/
function infoLicor($id,$conn,$dbase){
    
        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $periodo = $fila['periodo'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $total_lic = $fila['total_lor'];
                $dias_tomados = $fila['dias_tomados_lor'];
                $dias_restantes = $fila['dias_restantes_lor'];
                $fraccion = $fila['fraccion'];
            }
            
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Per??odo: </strong> <span class="badge badge-inverse">'.$periodo.'</span></li>';
                if($fraccion == 'Primera'){
                    echo '<li class="list-group-item"><strong>Fracci??n: </strong> <span class="badge badge-success">'.$fraccion.'</span></li>';
                }
                if($fraccion == 'Segunda'){
                    echo '<li class="list-group-item"><strong>Fracci??n: </strong> <span class="badge badge-warning">'.$fraccion.'</span></li>';
                }
                if($fraccion == 'Tercera'){
                    echo '<li class="list-group-item"><strong>Fracci??n: </strong> <span class="badge badge-danger">'.$fraccion.'</span></li>';
                }
          echo '<li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Total D??as: </strong> <span class="badge badge-inverse">'.$total_lic.'</span></li>
                <li class="list-group-item"><strong>D??as Tomados: </strong> <span class="badge badge-inverse">'.$dias_tomados.'</span></li>
                <li class="list-group-item"><strong>D??as Restantes: </strong> <span class="badge badge-inverse">'.$dias_restantes.'</span></li>
            </ul>';

}

/*
** FUNCION INFO AUSENTE CON AVISO
*/
function infoAca($id,$conn,$dbase){
    
        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $total_lic = $fila['total_aca'];
                $dias_tomados = $fila['dias_tomados_aca'];
                $dias_restantes = $fila['dias_restantes_aca'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Total D??as: </strong> <span class="badge badge-inverse">'.$total_lic.'</span></li>
                <li class="list-group-item"><strong>D??as Tomados: </strong> <span class="badge badge-inverse">'.$dias_tomados.'</span></li>
                <li class="list-group-item"><strong>D??as Restantes: </strong> <span class="badge badge-inverse">'.$dias_restantes.'</span></li>
            </ul>';

}

/*
** FUNCION INFO PATERNIDAD 
*/
function infoPaternidad($id,$conn,$dbase){
    
        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $dias_tomados = $fila['dias_tomados_otros'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong>
                    <span class="badge badge-warning"><a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>D??as Tomados: </strong> <span class="badge badge-inverse">'.$dias_tomados.'</span></li>
             </ul>';

}

/*
** FUNCION INFORME FALLECIMEINTO
*/
function infoFallecimiento($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $dias_tomados = $fila['dias_tomados_otros'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>D??as Tomados: </strong> <span class="badge badge-inverse">'.$dias_tomados.'</span></li>
             </ul>';

}

/*
** FUNCION INFORME FUERZA MAYOR
*/
function infoFuerzaMayor($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $dias_tomados = $fila['dias_tomados_otros'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>D??as Tomados: </strong> <span class="badge badge-inverse">'.$dias_tomados.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}

/*
** FUNCION INFORME DONAR SANGRE
*/
function infoDonarSangre($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $dias_tomados = $fila['dias_tomados_otros'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>D??as Tomados: </strong> <span class="badge badge-inverse">'.$dias_tomados.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** FUNCION INFORME MESA EXAMINADORA
*/
function infoMesaExaminadora($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $dias_totales = $fila['total_estudio'];
                $dias_tomados_estudio = $fila['dias_tomados_estudio'];
                $dias_resto_estudio = $fila['dias_restantes_estudio'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>D??as: </strong> <span class="badge badge-inverse">'.$dias_totales.'</span></li>
                <li class="list-group-item"><strong>D??as Tomados: </strong> <span class="badge badge-inverse">'.$dias_tomados_estudio.'</span></li>
                <li class="list-group-item"><strong>D??as Restantes: </strong> <span class="badge badge-inverse">'.$dias_resto_estudio.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** INFORMACION HORARIOS PARA ESTUDIANTES
*/
function infoHorariosEstudiantes($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $cant_horas = $fila['cant_horas'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
           
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad Horas: </strong> <span class="badge badge-inverse">'.$cant_horas.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** INFORMACION MADRES LACTANTES
*/
function infoMadresLactantes($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $cant_horas = $fila['cant_horas'];
                $cant_dias = $fila['dias_tomados_otros'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad Horas: </strong> <span class="badge badge-inverse">'.$cant_horas.'</span></li>
                <li class="list-group-item"><strong>Cantidad D??as: </strong> <span class="badge badge-inverse">'.$cant_dias.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** INFORMACION ASISTENCIA A CONGRESOS
*/
function infoAsistenciaCongresos($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $cant_dias = $fila['dias_tomados_otros'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad D??as: </strong> <span class="badge badge-inverse">'.$cant_dias.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </Tenencia para adopci??nform>';
                }
                
             echo '</ul>';

}


/*
** INFORMACION AFECCIONES DE CORTO TRATAMIENTO
*/
function infoCortoTratamiento($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $total_dias = $fila['total_enfermedad'];
                $tomados_enfermedad = $fila['dias_tomados_enfermedad'];
                $restantes_enfermedad = $fila['dias_restantes_enfermedad'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Total D??as: </strong> <span class="badge badge-inverse">'.$total_dias.'</span></li>
                <li class="list-group-item"><strong>D??as Tomados: </strong> <span class="badge badge-inverse">'.$tomados_enfermedad.'</span></li>
                <li class="list-group-item"><strong>D??as Restantes: </strong> <span class="badge badge-inverse">'.$restantes_enfermedad.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}

/*
** INFORMACION AFECCIONES DE LARGO TRATAMIENTO
*/
function infoLargoTratamiento($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $cant_anios = $fila['cant_anios'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad de A??os: </strong> <span class="badge badge-inverse">'.$cant_anios.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}

/*
** INFORMACION ACCIDENTE DE TRABAJO
*/
function infoAccidenteTrabajo($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $cant_anios = $fila['cant_anios'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad de A??os: </strong> <span class="badge badge-inverse">'.$cant_anios.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** INFORMACION INCAPACIDAD
*/
function infoIncapacidad($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $cant_anios = $fila['cant_anios'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad de A??os: </strong> <span class="badge badge-inverse">'.$cant_anios.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** INFORMACION ANTICIPO DE HABERES POR PASIVIDAD
*/
function infoAnticipoPasividad($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $cant_anios = $fila['cant_anios'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad de A??os: </strong> <span class="badge badge-inverse">'.$cant_anios.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}

/*
** INFORMACION MATERNIDAD
*/
function infoMaternidad($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $total_maternidad = $fila['total_maternidad'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad de D??as: </strong> <span class="badge badge-inverse">'.$total_maternidad.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}

/*
** INFORMACION ADOPCION DE MENOR HASTA 7 A??OS DE EDAD
*/
function infoAdopcion($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $cant_dias = $fila['dias_tomados_otros'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad de D??as: </strong> <span class="badge badge-inverse">'.$cant_dias.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** INFORMACION MATERNIDAD
*/
function infoNacimientoSinVida($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $total_maternidad = $fila['total_maternidad'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad de D??as: </strong> <span class="badge badge-inverse">'.$total_maternidad.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** MATERNIDAD EXCEDENCIA
*/
function infoMaternidadExcedencia($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $total_maternidad = $fila['total_maternidad'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad de D??as: </strong> <span class="badge badge-inverse">'.$total_maternidad.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** PARA RENDIR EXAMENES
*/
function infoRendirExamen($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $total_estudio = $fila['total_estudio'];
                $dias_tomados = $fila['dias_tomados_estudio'];
                $dias_restantes = $fila['dias_restantes_estudio'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Total D??as: </strong> <span class="badge badge-inverse">'.$total_estudio.'</span></li>
                <li class="list-group-item"><strong>D??as Tomados: </strong> <span class="badge badge-inverse">'.$dias_tomados.'</span></li>
                <li class="list-group-item"><strong>D??as Restantes: </strong> <span class="badge badge-inverse">'.$dias_restantes.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** PARA REALIZAR ESTUDIOS O INVESTIGACIONES
*/
function infoEstudiosInvestigaciones($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $cant_anios = $fila['cant_anios'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad de A??os: </strong> <span class="badge badge-inverse">'.$cant_anios.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** PARA REALIZAR ESTUDIOS ESCUELA DE DEFENSA NACIONAL
*/
function infoEstudiosDefensaNacional($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** MATRIMONIO DEL AGENTE O LOS HIJOS DEL AGENTE
*/
function infoMatrimonioAgente($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}

/*
** ACTIVIDADES DEPORTIVAS NO RENTADAS
*/
function infoActividadesDeportivas($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $cant_dias = $fila['dias_tomados_otros'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad de D??as: </strong> <span class="badge badge-inverse">'.$cant_dias.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** EJERCICIO TRANSITORIO DE OTROS CARGOS
*/
function infoCargosTransitorios($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $cant_dias = $fila['dias_tomados_otros'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad de D??as: </strong> <span class="badge badge-inverse">'.$cant_dias.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}

/*
** INFO RAZONES PARTICULARES
*/
function infoRazonesparticulares($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $cant_dias = $fila['dias_tomados_otros'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad de D??as: </strong> <span class="badge badge-inverse">'.$cant_dias.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** INFO RAZONES DE ESTUDIOS
*/
function infoRazonesEstudios($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $cant_dias = $fila['dias_tomados_otros'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad de D??as: </strong> <span class="badge badge-inverse">'.$cant_dias.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** INFO ACOMPA??AR CONYUGE
*/
function infoAcompa??arConyuge($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $cant_dias = $fila['dias_tomados_otros'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad de D??as: </strong> <span class="badge badge-inverse">'.$cant_dias.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}


/*
** INFO CARGOS Y HORAS C??TEDRA
*/
function infoHorasCatedra($id,$conn,$dbase){

        $sql = "select * from licencias where id = '$id'";
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
        while($fila = mysqli_fetch_array($query)){
                $licencia = $fila['tipo_licencia'];
                $agente = $fila['agente'];
                $f_desde = $fila['f_desde'];
                $f_hasta = $fila['f_hasta'];
                $cant_dias = $fila['dias_tomados_otros'];
                $comprobante = $fila['comprobantes'];
        }
        
        $sql_2 = "select art_licencia from tipo_licencia where descripcion = '$licencia'";
        $query_2 = mysqli_query($conn,$sql_2);
        while($row = mysqli_fetch_array($query_2)){
            $articulo = $row['art_licencia'];
        }
            
        echo '<ul class="list-group">
                <li class="list-group-item"><strong>Tipo de Licencia: </strong><span class="badge badge-warning">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="'.$articulo.'">'.$licencia.'</a></span></li>
                <li class="list-group-item"><strong>Agente: </strong> <span class="badge badge-inverse">'.$agente.'</span></li>
                <li class="list-group-item"><strong>Fecha Desde: </strong> <span class="badge badge-inverse">'.$f_desde.'</span></li>
                <li class="list-group-item"><strong>Fecha Hasta: </strong> <span class="badge badge-inverse">'.$f_hasta.'</span></li>
                <li class="list-group-item"><strong>Cantidad de D??as: </strong> <span class="badge badge-inverse">'.$cant_dias.'</span></li>';
                
                if($comprobante != ''){
                    echo '<li class="list-group-item"><a href="../lib/licencias/download_comprobante.php?file_name='.$comprobante.'" class="list-group-item active">
                            <img src="../icons/actions/layer-visible-on.png"  class="img-reponsive img-rounded"> Ver Comprobante</a></li>';
                }else{
                    echo '<form action="#" method="POST">
                            <input type="hidden" name="id" value="'.$id.'">
                            <hr>
                            <button type="submit" class="btn btn-warning btn-block" name="upload_comprobante">
                                <img src="../icons/actions/svn-commit.png"  class="img-reponsive img-rounded"> Subir Comprobante</button>
                            <hr>
                          </form>';
                }
                
             echo '</ul>';

}

// ========================================================================================= //
// MODAL //
function modalSelAgente($nombre,$conn,$dbase){
    
       
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
                        
                    if($nombre == 'Administrador'){
                       
                       $query = "SELECT nombre FROM agentes order by nombre ASC";
                        mysqli_select_db($conn,$dbase);
                        $res = mysqli_query($conn,$query);

                        if($res){
                            while($valores = mysqli_fetch_array($res)){
                                echo '<option value="'.$valores[nombre].'" >'.$valores[nombre].'</option>';
                            }
                            }
                    }
                    
                    if($nombre != 'Administrador'){
                    
                        $query = "SELECT nombre FROM agentes where nombre = '$nombre'";
                        mysqli_select_db($conn,$dbase);
                        $res = mysqli_query($conn,$query);

                        if($res){
                            while($valores = mysqli_fetch_array($res)){
                                echo '<option value="'.$valores[nombre].'" >'.$valores[nombre].'</option>';
                            }
                            }
                                       
                    }
                        
                    echo '</select>
                            </div><hr>
                            
                        <div class="form-group">
                        <label for="tipo_licencia">Tipo de Licencia:</label>
                        <select class="form-control" name="clase_licencia" id="tipo_licencia" onchange="CargarLicencias(this.value);">
                        <option value="" disabled selected>Seleccionar</option>';
                        
                        
                        $query = "SELECT clase_licencia FROM tipo_licencia group by clase_licencia ASC";
                        mysqli_select_db($conn,$dbase);
                        $res = mysqli_query($conn,$query);

                        if($res){
                            while($valores = mysqli_fetch_array($res)){
                                echo '<option value="'.$valores[clase_licencia].'" >'.$valores[clase_licencia].'</option>';
                            }
                            }
                        
                    echo '</select>
                            </div><hr>
                            
                            
                        <div class="form-group">
                        <label for="descripcion">Descripci??n:</label>
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
        // "Las fechas no son v??lidas";
        return -1;
    }else{
        
        if(($mes_f_desde == $mes_f_hasta) && ($anyo_f_desde == $anyo_f_hasta)){
            return 1; // el mes y a??o son iguales
        }else{
            return 0; // el mes y el a??o son distintos
        }
        
    } 

}

/*
** FUNCION QUE COMPARA SI UNA FECHA ES MENOR O MAYOR A OTRA
*/
function dateDifferent($f_desde,$f_hasta){

    $f_desde = strtotime($f_desde);
    $f_hasta = strtotime($f_hasta);
    
    if($f_hasta > $f_desde){
        return 1; // correcto
    }else if($f_hasta == f_desde){
        return 0;
    }else if($f_hasta < $f_desde){
        return -1; // fecha hasta no puede ser menor a la de inicio
    }

}

/*
** FUNCION PARA GUARDAR REGISTRO DE ERROR DE MYSQL INSERT
*/
function mysqlInsertsErrors($error){
    
    $file = '../../mysql_errors/mysql_insert_errors.txt';
    $fecha_actual = date("Y-m-d H:i:s");
    $text = "\n".$fecha_actual .' / '. $error;
    
    if(file_exists($file)){
        $fp = fopen($file, "a+");
        fwrite($fp, $text);
        fclose($fp);
    }else{
        exit();
    }
}

/*
** GUARDAR DATOS ALEATORIOS
*/
function datos($string){

    $file = '../../lost+found/lost_found.txt';
    $fecha_actual = date("Y-m-d H:i:s");
    $text = "\n".$fecha_actual .' / '. $string;
    
    if(file_exists($file)){
        $fp = fopen($file, "a+");
        fwrite($fp, $text);
        fclose($fp);
    }else{
        exit();
    }


}

// ================================================================== //
// PERSISTENCIA A BASE
function insertLicenciaOrdinaria($nombre,$dni,$antiguedad,$revista,$descripcion,$f_desde,$f_hasta,$periodo,$fraccion,$conn,$dbase){
        
    mysqli_select_db($conn,$dbase); // seleccionamos base de datos
    
    $sql_1 = "select * from licencias where agente = '$nombre'";
    $query_1 = mysqli_query($conn,$sql_1);
    while ($row_1 = mysqli_fetch_array($query_1)){
        $total_lic = $row_1['total_lor'];
        $periodo_agente = $row_1['periodo'];
        $fraccion_agente = $row_1['fraccion'];
        $dias_restantes_agente = $row_1['dias_restantes_lor'];
    }
    
    $cantidad_dias = dias_pasados($f_desde,$f_hasta);
    
    // primero evalua si se carg?? alguna licencia, si no se cragado nada a??n se carga
    
    if(($periodo_agente == '') && ($fraccion_agente == '') || ($periodo_agente == 'NULL') && ($fraccion_agente == 'NULL')){
            
    // evalua si el total de dias de licencia est?? vacio o no
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
                    $error = mysqli_error($conn);
                    mysqlInsertsErrors($error);
                 }
        }
        if($cantidad_dias > $total_lic){
            echo 4; // la cantidad de dias a tomar es mayor de los que dispone
        }
    
    }
    
    // se evalua si el periodo y la fraccion ya fueron usados
    
    if(($periodo_agente == $periodo) && ($fraccion_agente == $fraccion)){
    
        if($fraccion_agente == 'Primera'){
            echo 11; // ya utiliz?? la primera fraccion
        }
        if($fraccion_agente == 'Segunda'){
            echo 13; // debe solitar permiso al superior
        }
        if($fraccion_agente == 'Tercera'){
            echo 15; // ya agot?? todas las fracciones para dicho periodo
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
                    $error = mysqli_error($conn);
                    mysqlInsertsErrors($error);
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
                echo 19; // ya no posee m??s dias para dicho periodo
            }
         
         }
         
         if(($fraccion_agente == 'Primera') && ($fraccion == 'Tercera')){
            echo 17; // debe hacer uso antes de la segunda fraccion
         }
         
         
         if(($fraccion_agente == 'Primera') && ($fraccion == 'Primera')){
            echo 11; // ya utiliz?? la primera fraccion
         }
         if(($fraccion_agente == 'Segunda') && ($fraccion == 'Segunda')){
            
            echo 13; // debe solitar permiso al superior
            
         }
          if(($fraccion_agente == 'Tercera') && ($fraccion == 'Tercera')){
            
            echo 15; // agot?? todas las fracciones para dicho per??odo
            
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
                    $error = mysqli_error($conn);
                    mysqlInsertsErrors($error);
                }
        
        }
    
    }
 

}


/*
** LICENCIA AUSENTE CON AVISO
*/

function insertAusenteAviso($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){

    mysqli_select_db($conn,$dbase);
    $sql_1 = "select * from licencias where agente = '$nombre' and tipo_licencia = '$descripcion'";
    $query_1 = mysqli_query($conn,$sql_1);
    while($row_1 = mysqli_fetch_array($query_1)){
        $total_aca = $row_1['total_aca'];
        $dias_tomados_aca = $row_1['dias_tomados_aca'];
        $dias_resto_aca = $row_1['dias_restantes_aca'];
        $fecha = $row_1['f_hasta'];
    
    }
    
    $rows = mysqli_num_rows($query_1);
    
    $cant_dias = dias_pasados($f_desde,$f_hasta);
       
    if(($revista == 'Planta Permanente') || ($revista == 'Ley Marco')){
    
        if($rows == 0){
                
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
                                $error = mysqli_error($conn);
                                mysqlInsertsErrors($error);
                            }
                                       
                    }else if($cant_dias > 2){
                        echo 23; // solo puede tomar hasta 2 dias seguidos de ausente con aviso
                    }
                               
                }
                
                else if($rows > 0){
                        
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
                                            $error = mysqli_error($conn);
                                            mysqlInsertsErrors($error);
                                        }
                            }else if(($dias_resto_aca == 0) && ($dias_resto_aca != 'NULL')){
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
                                            $error = mysqli_error($conn);
                                            mysqlInsertsErrors($error);
                                        }
                            
                      }else if($validarMes == -1){
                        echo 29; // las fechas no son v??lidas
                      }
                        
                }
    
    }
    
    if($revista == 'Contrato 1109'){
        echo 21; // solo planta permante y ley marco pueden solicitar ausentes con aviso
    }
 
}


/*
** LICENCIA AUSENTE CON AVISO SIN GOCE DE HABERES
*/

function insertAusenteSinGoce($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){

    mysqli_select_db($conn,$dbase);
    
    $sql = "select * from licencias where agente = '$nombre' and tipo_licencia = 'Razones Particulares (Ausente con Aviso)'";
    $query = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($query)){
        $dias_aca = $row['dias_restantes_aca'];
    }
    
    $sql_1 = "select * from licencias where agente = '$nombre' and tipo_licencia = '$descripcion'";
    $query_1 = mysqli_query($conn,$sql_1);
    while($row_1 = mysqli_fetch_array($query_1)){
        $total_aca = $row_1['total_aca'];
        $dias_tomados_aca = $row_1['dias_tomados_aca'];
        $dias_resto_aca = $row_1['dias_restantes_aca'];
        $fecha = $row_1['f_hasta'];
    
    }
    
    $rows = mysqli_num_rows($query_1);
    
    $cant_dias = dias_pasados($f_desde,$f_hasta);
       
    if($dias_aca == 0){   
       
    if(($revista == 'Planta Permanente') || ($revista == 'Ley Marco')){
    
        if($rows == 0){
                
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
                                $error = mysqli_error($conn);
                                mysqlInsertsErrors($error);
                            }
                                       
                    }else if($cant_dias > 2){
                        echo 47; // solo puede tomar hasta 2 dias seguidos de ausente con aviso
                    }
                               
                }
                
                else if($rows > 0){
                        
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
                                            $error = mysqli_error($conn);
                                            mysqlInsertsErrors($error);
                                        }
                            }else if(($dias_resto_aca == 0) && ($dias_resto_aca != 'NULL')){
                                echo 49; // ya no tiene mas dias para usar
                            }
                      
                      }if(($validarMes == 1) && ($dias_tomados_aca == 2)){
                        echo 51; // no puede tomar ausente con aviso dos veces en el mismo mes
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
                                            $error = mysqli_error($conn);
                                            mysqlInsertsErrors($error);
                                        }
                            
                      }else if($validarMes == -1){
                        echo 29; // las fechas no son v??lidas
                      }
                        
                }
    
    }
    
    if($revista == 'Contrato 1109'){
        echo 21; // solo planta permante y ley marco pueden solicitar ausentes con aviso
    }
    
    }else if($dias_aca > 0){
        echo 53; // primero debe agotar los dias de ausente con aviso
    }
}



/*
** FUNCION INSERTAR LICENCIA POR PATERNIDAD
*/
function insertLicPaternidad($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){

    $cant_dias = dias_pasados($f_desde,$f_hasta);

    if($cant_dias == 3){
    mysqli_select_db($conn,$dbase);
    $sql = "INSERT INTO licencias ".
             "(agente,dni,f_desde,f_hasta,tipo_licencia,dias_tomados_otros)".
             "VALUES ".
             "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_dias')";
    $query = mysqli_query($conn,$sql);
    
    if($query){
        echo 1; // registro incertado correctamente
    }else{
        echo -1; // error al incertar registro
        $error = mysqli_error($conn);
        mysqlInsertsErrors($error);
    }
    }if(($cant_dias < 3) || ($cant_dias > 3)){
        echo 33; // la cantidad de dias no puede ser menor ni mayor a tres
    }

}

/*
** INSERTAR LICENCIA POR FALLECIMIENTO
*/
function insertLicFallecimiento($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$parentalidad,$conn,$dbase){

    $cant_dias = dias_pasados($f_desde,$f_hasta);
    
    if($parentalidad == 1){
    
        if($cant_dias == 5){
            mysqli_select_db($conn,$dbase);
            $sql = "INSERT INTO licencias ".
             "(agente,dni,f_desde,f_hasta,tipo_licencia,dias_tomados_otros)".
             "VALUES ".
             "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_dias')";
            $query = mysqli_query($conn,$sql);
    
                if($query){
                    echo 1; // registro incertado correctamente
                }else{
                    echo -1; // error al incertar registro
                    $error = mysqli_error($conn);
                    mysqlInsertsErrors($error);
                }
        
        }else if(($cant_dias < 5) || ($cant_dias > 5)){
            echo 35; // para fallecimiento de conyuge, hijos, padres o hermanos el total son 5 d??as h??biles
        }
    
    }
    
    if($parentalidad == 2){
    
        if($cant_dias == 3){
            mysqli_select_db($conn,$dbase);
            $sql = "INSERT INTO licencias ".
            "(agente,dni,f_desde,f_hasta,tipo_licencia,dias_tomados_otros)".
            "VALUES ".
            "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_dias')";
            $query = mysqli_query($conn,$sql);
    
                if($query){
                    echo 1; // registro incertado correctamente
                }else{
                    echo -1; // error al incertar registro
                    $error = mysqli_error($conn);
                    mysqlInsertsErrors($error);
                }
        }else if(($cant_dias < 3) || ($cant_dias > 3)){
            echo 37; // para fallecimiento de sobrinos, tios la cantidad de d??as es de 3
        }
    
    }
    
}


/*
** INSERTAR LICENCIA POR FUERZA MAYOR
*/
function insertFuerzaMayor($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){
    
    $cant_dias = dias_pasados($f_desde,$f_hasta);
    mysqli_select_db($conn,$dbase);
    $sql = "INSERT INTO licencias ".
           "(agente,dni,f_desde,f_hasta,tipo_licencia,dias_tomados_otros)".
           "VALUES ".
           "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_dias')";
    $query = mysqli_query($conn,$sql);
    
        if($query){
            echo 1; // registro incertado correctamente
        }else{
            echo -1; // error al incertar registro
            $error = mysqli_error($conn);
            mysqlInsertsErrors($error);
        }

}

/*
** INSERTAR DONACION DE SANGRE
*/
function insertDonarSangre($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){
    
    $cant_dias = dias_pasados($f_desde,$f_hasta);
    
    
        if($cant_dias == 1){
        mysqli_select_db($conn,$dbase);
        $sql = "INSERT INTO licencias ".
            "(agente,dni,f_desde,f_hasta,tipo_licencia,dias_tomados_otros)".
            "VALUES ".
            "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_dias')";
        $query = mysqli_query($conn,$sql);
        
            if($query){
                echo 1; // registro incertado correctamente
            }else{
                echo -1; // error al incertar registro
                $error = mysqli_error($conn);
                mysqlInsertsErrors($error);
            }
        }else if($cant_dias > 1){
            echo 39; // solo se puede tomar un dia
        }
   
}


/*
** LICENCIA MESA EXAMINADORA
*/

function insertMesaExaminadora($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){

    mysqli_select_db($conn,$dbase);
    $sql_1 = "select * from licencias where agente = '$nombre' and tipo_licencia = '$descripcion'";
    $query_1 = mysqli_query($conn,$sql_1);
    while($row_1 = mysqli_fetch_array($query_1)){
        $total_estudio = $row_1['total_estudio'];
        $dias_tomados_estudio = $row_1['dias_tomados_estudio'];
        $dias_resto_estudio = $row_1['dias_restantes_estudio'];
       
    }
    
    $rows = mysqli_num_rows($query_1);
    $string = 'cantidad dias: '.$cant_dias;
            datos($string);
    $cant_dias = dias_pasados($f_desde,$f_hasta);
       
    if(($revista == 'Planta Permanente') || ($revista == 'Ley Marco')){
    
        if($rows == 0){
                
                    $total_dias = 12;
                
                    if($cant_dias <= 12){
                    
                        $dias_restantes = $total_dias - $cant_dias;
                        
                        $sql_2 = "INSERT INTO licencias ".
                                "(agente,dni,f_desde,f_hasta,tipo_licencia,total_estudio,dias_tomados_estudio,dias_restantes_estudio)".
                                "VALUES ".
                                "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$total_dias','$cant_dias','$dias_restantes')";
                                $query_2 = mysqli_query($conn,$sql_2);
                            
                            if($query_2){
                                echo 1; // registro incertado correctamente
                            }else{
                                echo -1; // error al incertar registro
                                $error = mysqli_error($conn);
                                mysqlInsertsErrors($error);
                            }
                                       
                    }else if($cant_dias > 12){
                        echo 41; // solo puede tomar hasta 12 dias al a??o
                    }
                               
                }
                
                else if($rows > 0){
                        
                            $total_dias = 12;
                       
                        
                            if($dias_resto_estudio >= $cant_dias){
                                
                                $dias_restantes = $dias_resto_estudio - $cant_dias;
                                
                                    $sql_3 = "INSERT INTO licencias ".
                                            "(agente,dni,f_desde,f_hasta,tipo_licencia,total_estudio,dias_tomados_estudio,dias_restantes_estudio)".
                                            "VALUES ".
                                            "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$total_dias','$cant_dias','$dias_restantes')";
                                            $query_3 = mysqli_query($conn,$sql_3);
                                        
                                        if($query_3){
                                            echo 1; // registro incertado correctamente
                                        }else{
                                            echo -1; // error al incertar registro
                                            $error = mysqli_error($conn);
                                            mysqlInsertsErrors($error);
                                        }
                            }else if($dias_resto_estudio == 0){
                                echo 43; // ya no tiene mas dias para usar
                            }else if($dias_resto_estudio < $cant_dias){
                                echo 45; // la cantidad de dias a pedir excede los que quedan
                            }
                        
                }
    
    }
    
    if($revista == 'Contrato 1109'){
        echo 21; // solo planta permante y ley marco pueden solicitar ausentes con aviso
    }
 
}


// ================================================================== //
// FRAQUICIAS //
/*
** INSERTAR LICENCIA HORARIO PARA ESTUDIANTES
*/
function insertLicenciaHorEstudiante($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$cant_horas,$conn,$dbase){

    $cant_horas = intval($cant_horas);


    if(is_int($cant_horas)){

    if(($cant_horas < 2) || ($cant_horas > 2) || ($cant_horas == 1800)){
       echo 55; // la cantidad de horas no pueden ser mayores ni menores a 2
    }else if($cant_horas == 2){
        
            mysqli_select_db($conn,$dbase);
            $sql = "INSERT INTO licencias ".
                     "(agente,dni,f_desde,f_hasta,tipo_licencia,cant_horas)".
                     "VALUES ".
                     "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_horas')";
                     $query = mysqli_query($conn,$sql);
                     
                    if($query){
                        echo 1; // registro incertado correctamente
                    }else{
                        echo -1; // error al incertar registro
                        $error = mysqli_error($conn);
                        mysqlInsertsErrors($error);
                    }
    }
    }else{
        echo 56; // no es un entero
    }
    
}



/*
** REDUCCION HORARIA PARA MADRES EN PER??ODO DE LACTANCIA
*/
function insertLicenciaMadreLactante($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$cant_horas,$conn,$dbase){

    $cant_horas = intval($cant_horas);
    $cant_dias = dias_pasados($f_desde,$f_hasta);formNuevaLicencia($nombre,$descripcion,$conn);
    
    $sql = "select * from licencias where agente = '$nombre' and descripcion = '$descripcion'";
    mysqli_select_db($conn,$dbase);
    $query = mysqli_query($conn,$sql);
    $row = mysqli_num_rows($query);
    while($rows = mysqli_fetch_array($query)){
        $dias_tomados = $rows['dias_tomados_otros'];
    }
    
        
    if($row == 0){
    
    if($cant_dias <= 240){
    
        
        if($cant_horas == 1){
        
            mysqli_select_db($conn,$dbase);
            $sql_1 = "INSERT INTO licencias ".
                   "(agente,dni,f_desde,f_hasta,tipo_licencia,cant_horas,dias_tomados_otros)".
                   "VALUES ".
                   "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_horas','$cant_dias')";
            $query_1 = mysqli_query($conn,$sql_1);
                     
                    if($query_1){
                        echo 1; // registro incertado correctamente
                    }else{
                        echo -1; // error al incertar registro
                        $error = mysqli_error($conn);
                        mysqlInsertsErrors($error);
                    }
    
        }else if($cant_horas > 1){
            echo 57; // no se puede exceder la cantidad de 1 hr
        }

    }else if($cant_dias > 240){
        echo 59; // el valor no puede ser superior a 240
    }else if($cant_horas == 1800){
        $cant_horas = 30;
        
            mysqli_select_db($conn,$dbase);
            $sql_2 = "INSERT INTO licencias ".
                   "(agente,dni,f_desde,f_hasta,tipo_licencia,cant_horas,dias_tomados_otros)".
                   "VALUES ".
                   "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_horas','$cant_dias')";
            $query_2 = mysqli_query($conn,$sql_2);
                     
                    if($query_2){
                        echo 1; // registro incertado correctamente
                    }else{
                        echo -1; // error al incertar registro
                        $error = mysqli_error($conn);
                        mysqlInsertsErrors($error);
                    }
    }
    
    }
    
    if($row > 0){
        
        $dias_restantes = 365 - $dias_tomados;
        
            if($cant_horas == 1){
        
                mysqli_select_db($conn,$dbase);
                $sql_3 = "INSERT INTO licencias ".
                    "(agente,dni,f_desde,f_hasta,tipo_licencia,cant_horas,dias_tomados_otros)".
                    "VALUES ".
                    "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_horas','$dias_restantes')";
                $query_3 = mysqli_query($conn,$sql_3);
                        
                        if($query_3){
                            echo 1; // registro incertado correctamente
                        }else{
                            echo -1; // error al incertar registro
                            $error = mysqli_error($conn);
                            mysqlInsertsErrors($error);
                        }
    
            }else if($cant_horas > 1){
                echo 57; // no se puede exceder la cantidad de 1 hr
            }else if($cant_horas == 1800){
        
                $cant_horas = 30;
            
                mysqli_select_db($conn,$dbase);
                $sql_4 = "INSERT INTO licencias ".
                    "(agente,dni,f_desde,f_hasta,tipo_licencia,cant_horas,dias_tomados_otros)".
                    "VALUES ".
                    "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_horas','$dias_restantes')";
                $query_4 = mysqli_query($conn,$sql_4);
                        
                        if($query_4){
                            echo 1; // registro incertado correctamente
                        }else{
                            echo -1; // error al incertar registro
                            $error = mysqli_error($conn);
                            mysqlInsertsErrors($error);
                        }
        }
    
    }

}

/*
** INSERTAR EN BASE ASISTENCIA A CONGRESOS
*/
function insertAsistenciaCongresos($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){

    $cant_dias = dias_pasados($f_desde,$f_hasta);
    
    mysqli_select_db($conn,$dbase);
    $sql = "INSERT INTO licencias ".
            "(agente,dni,f_desde,f_hasta,tipo_licencia,dias_tomados_otros)".
            "VALUES ".
            "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_dias')";
    $query = mysqli_query($conn,$sql);
                        
                        if($query){
                            echo 1; // registro incertado correctamente
                        }else{
                            echo -1; // error al incertar registro
                            $error = mysqli_error($conn);
                            mysqlInsertsErrors($error);
                        }

}

// =========================================================================================================================== //
// LICENCIAS ESPECIALES //
/*
** AFECCIONES DE CORTO TRATAMIENTO
*/
function insertCortoTratamiento($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){
    
    $cant_dias = dias_pasados($f_desde,$f_hasta);
    
    mysqli_select_db($conn,$dbase);
    $sql = "select * from licencias where agente = '$nombre' and tipo_licencia = '$descripcion'";
    $query = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($query);
    while($row = mysqli_fetch_array($query)){
        $tomados_enfermedad = $row['dias_tomados_enfermedad'];
        $restantes_enfermedad = $row['dias_restantes_enfermedad'];    
    }
    
    if($rows == 0){
    
        $total_dias = 45;
        $dias_restantes = $total_dias - $cant_dias;
        
        if($cant_dias <= 45){
        
            $sql_1 = "INSERT INTO licencias ".
            "(agente,dni,f_desde,f_hasta,tipo_licencia,total_enfermedad,dias_tomados_enfermedad,dias_restantes_enfermedad)".
            "VALUES ".
            "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$total_dias','$cant_dias','$dias_restantes')";
            $query_1 = mysqli_query($conn,$sql_1);
                        
                        if($query_1){
                            echo 1; // registro incertado correctamente
                        }else{
                            echo -1; // error al incertar registro
                            $error = mysqli_error($conn);
                            mysqlInsertsErrors($error);
                        }
        
        }else if($cant_dias > 45){
            echo 61; // LA CANTIDAD DE DIAS A TOMAR NO PUEDE EXCEDER LOS 45
        }
    
    }else if($rows > 0){
    
        $total_dias = 45;
        $string = 'cantidad dias: '.$cant_dias;
            datos($string);
        if($cant_dias <= $restantes_enfermedad){
        
            $dias_restantes = $restantes_enfermedad - $cant_dias;
            
                $sql_2 = "INSERT INTO licencias ".
                         "(agente,dni,f_desde,f_hasta,tipo_licencia,total_enfermedad,dias_tomados_enfermedad,dias_restantes_enfermedad)".
                         "VALUES ".
                         "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$total_dias','$cant_dias','$dias_restantes')";
                $query_2 = mysqli_query($conn,$sql_2);
                        
                        if($query_2){
                            echo 1; // registro incertado correctamente
                        }else{
                            echo -1; // error al incertar registro
                            $error = mysqli_error($conn);
                            mysqlInsertsErrors($error);
                        }
        
        }else if($cant_dias > $restantes_enfermedad){
            echo 63; // la cantidad de dias a tomar es mayor a los que quedan
        }
    
    }

}

/*
** INSERTAR ENFERMEDAD EN HORAS DE LABOR
*/
function insertEnfHorasLabor($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){

    $cant_dias = dias_pasados($f_desde,$f_hasta);
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $hora_actual = time('H:i:s');
    $hora_actual = strtotime($hora_actual);
    $medio_dia = strtotime('12:00:00');
    
    mysqli_select_db($conn,$dbase);
    $sql = "select * from licencias where agente = '$nombre' and tipo_licencia = 'Afecciones de corto tratamiento'";
    $query = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($query);
    while($row = mysqli_fetch_array($query)){
        $tomados_enfermedad = $row['dias_tomados_enfermedad'];
        $restantes_enfermedad = $row['dias_restantes_enfermedad'];    
    }
    
    if($rows == 0){
    
    if($hora_actual > $medio_dia){
    
        $sql_1 = "INSERT INTO licencias ".
                         "(agente,dni,f_desde,f_hasta,tipo_licencia,dias_tomados_enfermedad)".
                         "VALUES ".
                         "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_dias')";
        $query_1 = mysqli_query($conn,$sql_1);
                      
                        if($query_1){
                            echo 1; // registro incertado correctamente
                        }else{
                            echo -1; // error al incertar registro
                            $error = mysqli_error($conn);
                            mysqlInsertsErrors($error);
                        }
    }
    
    if($hora_actual < $medio_dia){
    
        $descripcion = 'Afecciones de corto tratamiento';
    
        if($cant_dias <= $restantes_enfermedad){
            
            $total_dias = 45;
            $dias_restantes = $restantes_enfermedad - $cant_dias;
            
                $sql_2 = "INSERT INTO licencias ".
                         "(agente,dni,f_desde,f_hasta,tipo_licencia,total_enfermedad,dias_tomados_enfermedad,dias_restantes_enfermedad)".
                         "VALUES ".
                         "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$total_dias','$cant_dias','$dias_restantes')";
                $query_2 = mysqli_query($conn,$sql_2);
                        
                        if($query_2){
                            echo 1; // registro incertado correctamente
                        }else{
                            echo -1; // error al incertar registro
                            $error = mysqli_error($conn);
                            mysqlInsertsErrors($error);
                        }
        
        }else if($cant_dias > $restantes_enfermedad){
            echo 63; // la cantidad de dias a tomar es mayor a los que quedan
        }
    
    }
    
    }else if($rows > 0){ 
    
        if($hora_actual > $medio_dia){
    
                $sql_3 = "INSERT INTO licencias ".
                                "(agente,dni,f_desde,f_hasta,tipo_licencia,dias_tomados_enfermedad)".
                                "VALUES ".
                                "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_dias')";
                $query_3 = mysqli_query($conn,$sql_3_);
                                
                                if($query_3){
                                    echo 1; // registro incertado correctamente
                                }else{
                                    echo -1; // error al incertar registro
                                    $error = mysqli_error($conn);
                                    mysqlInsertsErrors($error);
                                }
            
        }
        if($hora_actual < $medio_dia){
    
            $descripcion = 'Afecciones de corto tratamiento';
    
            if($cant_dias <= $restantes_enfermedad){
                    
                    $total_dias = 45;
                    $dias_restantes = $restantes_enfermedad - $cant_dias;
                    
                        $sql_4 = "INSERT INTO licencias ".
                                "(agente,dni,f_desde,f_hasta,tipo_licencia,total_enfermedad,dias_tomados_enfermedad,dias_restantes_enfermedad)".
                                "VALUES ".
                                "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$total_dias','$cant_dias','$dias_restantes')";
                        $query_4 = mysqli_query($conn,$sql_4);
                                
                                if($query_4){
                                    echo 1; // registro incertado correctamente
                                }else{
                                    echo -1; // error al incertar registro
                                    $error = mysqli_error($conn);
                                    mysqlInsertsErrors($error);
                                }

            }else if($cant_dias > $restantes_enfermedad){
                echo 63; // la cantidad de dias a tomar es mayor a los que quedan
            }

        }
    }

}

/*
** AFECCIONES LARGO TRATAMIENTO
*/
function insertAfeccionLargoTratamiento($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$cant_anios,$conn,$dbase){

    $cant_dias = dias_pasados($f_desde,$f_hasta);
   
    mysqli_select_db($conn,$dbase);
    $sql = "select * from licencias where agente = '$nombre' and tipo_licencia = '$descripcion'";
    $query = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($query);
    while($row = mysqli_fetch_array($query)){
        $cant_anios_usados = $row['cant_anios'];
    }
        
        if(($cant_dias == 365) && ($cant_anios == 1) || 
                ($cant_dias == 730) && ($cant_anios == 2) || 
                    ($cant_dias == 1095) && (cant_anios == 3) || 
                        ($cant_dias == 1460) && ($cant_anios == 4)){
        
        $string = 'cantidad dias: '.$cant_dias;
        datos($string);
        
        if($rows <= 0){
        
            $sql_1 = "INSERT INTO licencias ".
                     "(agente,dni,f_desde,f_hasta,tipo_licencia,cant_anios)".
                     "VALUES ".
                     "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_anios')";
            $query_1 = mysqli_query($conn,$sql_1);
                                
                if($query_1){
                    echo 1; // registro incertado correctamente
                }else{
                    echo -1; // error al incertar registro
                    $error = mysqli_error($conn);
                    mysqlInsertsErrors($error);
                }
        
        }
        if($rows > 0){
        
            if(($cant_anios_usados > 0) && ($cant_anios_usados < 4)){
            
                if($cant_anios_usados >= $cant_anios){
            
                    $anios = $cant_anios_usados + $cant_anios;
                        
                       if($anios <= 4){
                       
                            $sql_2 = "INSERT INTO licencias ".
                                    "(agente,dni,f_desde,f_hasta,tipo_licencia,cant_anios)".
                                    "VALUES ".
                                    "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$anios')";
                            $query_2 = mysqli_query($conn,$sql_2);
                                    
                                if($query_2){
                                    echo 1; // registro incertado correctamente
                                }else{
                                    echo -1; // error al incertar registro
                                    $error = mysqli_error($conn);
                                    mysqlInsertsErrors($error);
                                }
                        }else{
                            echo 67; // ya no tiene mas a??os para usar
                        }
                }else if($cant_anios_usados < $cant_anios){
                    echo 65; // cantidad de a??os seleccionados es mayor a los que quedan por usar
                }
            
            }else if($cant_anios_usados == 4){
                echo 67; // ya no tiene mas a??os para usar
            }
        
        }
        
        }else if(($cant_dias != 365) && ($cant_anios != 1) || 
                    ($cant_dias != 730) && ($cant_anios != 2) || 
                        ($cant_dias != 1095) && (cant_anios != 3) || 
                            ($cant_dias != 1460) && ($cant_anios != 4)){
            echo 69; // el per??do de entre la fecha inicial y la final debe coincidir con la cantidad de a??os elegidos
            $string = 'cantidad dias: '.$cant_dias;
            datos($string);
        }

}

/*
** ACCIDENTE DE TRABAJO
*/
function insertAccidenteTrabajo($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$cant_anios,$conn,$dbase){
    
    $cant_dias = dias_pasados($f_desde,$f_hasta);
    mysqli_select_db($conn,$dbase);
    $sql = "select * from licencias where agente = '$nombre' and tipo_licencia = '$descripcion'";
    $query = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($query);
    while($row = mysqli_fetch_array($query)){
        $cant_anios_usados = $row['cant_anios'];
    }
    
    if(($cant_dias == 365) && ($cant_anios == 1) || 
                ($cant_dias == 730) && ($cant_anios == 2) || 
                    ($cant_dias == 1095) && (cant_anios == 3) || 
                        ($cant_dias == 1460) && ($cant_anios == 4)){
        
        $string = 'cantidad dias: '.$cant_dias;
        datos($string);
    
            if($rows <= 0){
                
                $sql_1 = "INSERT INTO licencias ".
                     "(agente,dni,f_desde,f_hasta,tipo_licencia,cant_anios)".
                     "VALUES ".
                     "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_anios')";
                $query_1 = mysqli_query($conn,$sql_1);
                                
                    if($query_1){
                        echo 1; // registro incertado correctamente
                    }else{
                        echo -1; // error al incertar registro
                        $error = mysqli_error($conn);
                        mysqlInsertsErrors($error);
                    }
    
            }
            if($rows > 0){
            
                    if(($cant_anios_usados > 0) && ($cant_anios_usados < 4)){
            
                        if($cant_anios_usados >= $cant_anios){
            
                            $anios = $cant_anios_usados + $cant_anios;
                        
                                if($anios <= 4){
                       
                                    $sql_2 = "INSERT INTO licencias ".
                                            "(agente,dni,f_desde,f_hasta,tipo_licencia,cant_anios)".
                                            "VALUES ".
                                            "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$anios')";
                                    $query_2 = mysqli_query($conn,$sql_2);
                                            
                                        if($query_2){
                                            echo 1; // registro incertado correctamente
                                        }else{
                                            echo -1; // error al incertar registro
                                            $error = mysqli_error($conn);
                                            mysqlInsertsErrors($error);
                                        }
                                }else{
                                    echo 67; // ya no tiene mas a??os para usar
                                }
                        }else if($cant_anios_usados < $cant_anios){
                            echo 65; // cantidad de a??os seleccionados es mayor a los que quedan por usar
                        }
                    
                    }else if($cant_anios_usados == 4){
                        echo 67; // ya no tiene mas a??os para usar
                    }
            
            }
    }else if(($cant_dias != 365) && ($cant_anios != 1) || 
                    ($cant_dias != 730) && ($cant_anios != 2) || 
                        ($cant_dias != 1095) && (cant_anios != 3) || 
                            ($cant_dias != 1460) && ($cant_anios != 4)){
            echo 69; // el per??do de entre la fecha inicial y la final debe coincidir con la cantidad de a??os elegidos
            $string = 'cantidad dias: '.$cant_dias;
            datos($string);
    }

}


/*
** INCAPACIDAD
*/
function insertIncapacidad($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){

    $cant_dias = dias_pasados($f_desde,$f_hasta);
    mysqli_select_db($conn,$dbase);
    $sql = "select * from licencias where agente = '$nombre' and tipo_licencia = '$descripcion'";
    $query = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($query);
    while($row = mysqli_fetch_array($query)){
        $cant_anios_usados = $row['cant_anios'];
    }
    
    if($rows <= 0){
    
        if($cant_dias == 365){
            
                $cant_anios = 1;
        
                $sql_1 = "INSERT INTO licencias ".
                     "(agente,dni,f_desde,f_hasta,tipo_licencia,cant_anios)".
                     "VALUES ".
                     "('$nombre','$dni','$f_desde','$f_hasta','$descripcion','$cant_anios')";
                $query_1 = mysqli_query($conn,$sql_1);
                                
                    if($query_1){
                        echo 1; // registro incertado correctamente
                    }else{
                        echo -1; // error al incertar registro
                        $error = mysqli_error($conn);
                        mysqlInsertsErrors($error);
                    }
        
        
        
        }
        if(($cant_dias < 365) || ($cant_dias > 365)){
            echo 71; // la cantidad de d??as no puede ser menor o mayor a 365
        }
    
    }if($rows > 0){
        echo 73; // ya est?? usufructuando de la licencia por incapacidad
    }

}


/*
** ANTICIPO DE HABERES POR PASIVIDAD (art. 10f)
*/
function insertAnticipoPasividad($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){

    $cant_dias = dias_pasados($f_desde,$f_hasta);
    mysqli_select_db($conn,$dbase);
    $sql = "select * from licencias where agente = '$nombre' and tipo_licencia = '$descripcion'";
    $query = mysqli_query($conn,$sql);
    
    while($row = mysqli_fetch_array($query)){
        $cant_anios_usados = $row['cant_anios'];
    }
    
    if($query){
    
        $rows = mysqli_num_rows($query);
        
    if($rows <= 0){
    
        if($cant_dias == 365){
            
                $cant_anios = 1;
        
                $sql_1 = "INSERT INTO licencias ".
                     "(agente,
                       dni,
                       f_desde,
                       f_hasta,
                       tipo_licencia,
                       cant_anios)".
                     "VALUES ".
                     "('$nombre',
                       '$dni',
                       '$f_desde',
                       '$f_hasta',
                       '$descripcion',
                       '$cant_anios')";
                
                    $query_1 = mysqli_query($conn,$sql_1);
                                
                    if($query_1){
                        echo 1; // registro incertado correctamente
                    }else{
                        echo -1; // error al incertar registro
                        $error = mysqli_error($conn);
                        mysqlInsertsErrors($error);
                    }
        
        
        
        }
        if(($cant_dias < 365) || ($cant_dias > 365)){
            echo 75; // la cantidad de d??as no puede ser menor o mayor a 365
        }
    
    }if($rows != 0){
        echo 77; // ya est?? usufructuando de la licencia de anticipo por pasividad
    }
    }else{
        echo -5; // no se pudo realizar la comprobacion
    }

}


/*
** LICENCIA POR MATERNIDAD (art. 10g)
*/
function insertMaternidad($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$parto_multiple,$conn,$dbase){
    
    $cant_dias = dias_pasados($f_desde,$f_hasta);
    
    if($parto_multiple == 'Si'){
        
        if($cant_dias == 110){
            
            mysqli_select_db($conn,$dbase);
            $sql_1 = "INSERT INTO licencias ".
                     "(agente,
                       dni,
                       f_desde,
                       f_hasta,
                       tipo_licencia,
                       total_maternidad)".
                     "VALUES ".
                     "('$nombre',
                       '$dni',
                       '$f_desde',
                       '$f_hasta',
                       '$descripcion',
                       '$cant_dias')";
                
                    $query_1 = mysqli_query($conn,$sql_1);
                                
                    if($query_1){
                        echo 1; // registro incertado correctamente
                    }else{
                        echo -1; // error al incertar registro
                        $error = mysqli_error($conn);
                        mysqlInsertsErrors($error);
                    }
        
        }else if(($cant_dias > 110) || ($cant_dias < 110)){
            echo 79; // para parto multiple no puede exceder los 110 dias
            $string = 'cantidad dias: '.$cant_dias;
            datos($string);
        }
    
    }
    
    if($parto_multiple == 'No'){
    
        if($cant_dias == 100){
        
            $sql_1 = "INSERT INTO licencias ".
                     "(agente,
                       dni,
                       f_desde,
                       f_hasta,
                       tipo_licencia,
                       total_maternidad)".
                     "VALUES ".
                     "('$nombre',
                       '$dni',
                       '$f_desde',
                       '$f_hasta',
                       '$descripcion',
                       '$cant_dias')";
                
                    $query_1 = mysqli_query($conn,$sql_1);
                                
                    if($query_1){
                        echo 1; // registro incertado correctamente
                    }else{
                        echo -1; // error al incertar registro
                        $error = mysqli_error($conn);
                        mysqlInsertsErrors($error);
                    }
               
        }else if(($cant_dias > 100) || ($cant_dias < 100)){
            echo 81; // si el parto no es multiple no puede superar los 100 dias
            $string = 'cantidad dias: '.$cant_dias;
            datos($string);
        }
       
    }

} // end of function


/*
** TENENCIA POR ADOPCION HASTA 7 A??OS DE EDAD (ART 10H)
*/
function insertAdopcion($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$edad,$conn,$dbase){

    $cant_dias = dias_pasados($f_desde,$f_hasta);
    
    if(($edad >= 0) && ($edad <= 7)){
    
        if($cant_dias == 60){
            
            mysqli_select_db($conn,$dbase);
            $sql_1 = "INSERT INTO licencias ".
                     "(agente,
                       dni,
                       f_desde,
                       f_hasta,
                       tipo_licencia,
                       dias_tomados_otros)".
                     "VALUES ".
                     "('$nombre',
                       '$dni',
                       '$f_desde',
                       '$f_hasta',
                       '$descripcion',
                       '$cant_dias')";
                
                    $query_1 = mysqli_query($conn,$sql_1);
                                
                    if($query_1){
                        echo 1; // registro incertado correctamente
                    }else{
                        echo -1; // error al incertar registro
                        $error = mysqli_error($conn);
                        mysqlInsertsErrors($error);
                    }
        
        }else if($cant_dias < 60){
            echo 83; // la cantidad de dias no puede ser menor a 60
            $string = 'cantidad dias: '.$cant_dias;
            datos($string);
        }
    
    }else if($edad > 7){
        echo 85; // la edad del menor no puede ser mayor a 7 a??os
    }

}

/*
**  MATERNIDAD (NACIMIENTO SIN VIDA) ART. 135 CCTG
*/
function insertNacimientoSinVida($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$parto_multiple,$conn,$dbase){
    
    $cant_dias = dias_pasados($f_desde,$f_hasta);
    
    if($parto_multiple == 'Si'){
        
        if($cant_dias == 111){
            
            mysqli_select_db($conn,$dbase);
            $sql_1 = "INSERT INTO licencias ".
                     "(agente,
                       dni,
                       f_desde,
                       f_hasta,
                       tipo_licencia,
                       total_maternidad)".
                     "VALUES ".
                     "('$nombre',
                       '$dni',
                       '$f_desde',
                       '$f_hasta',
                       '$descripcion',
                       '$cant_dias')";
                
                    $query_1 = mysqli_query($conn,$sql_1);
                                
                    if($query_1){
                        echo 1; // registro incertado correctamente
                    }else{
                        echo -1; // error al incertar registro
                        $error = mysqli_error($conn);
                        mysqlInsertsErrors($error);
                    }
        
        }else if(($cant_dias > 111) || ($cant_dias < 111)){
            echo 87; // para parto multiple no puede exceder los 111 dias
            $string = 'cantidad dias: '.$cant_dias;
            datos($string);
        }
    
    }
    
    if($parto_multiple == 'No'){
    
        if($cant_dias == 101){
            mysqli_select_db($conn,$dbase);
            $sql_1 = "INSERT INTO licencias ".
                     "(agente,
                       dni,
                       f_desde,
                       f_hasta,
                       tipo_licencia,
                       total_maternidad)".
                     "VALUES ".
                     "('$nombre',
                       '$dni',
                       '$f_desde',
                       '$f_hasta',
                       '$descripcion',
                       '$cant_dias')";
                
                    $query_1 = mysqli_query($conn,$sql_1);
                                
                    if($query_1){
                        echo 1; // registro incertado correctamente
                    }else{
                        echo -1; // error al incertar registro
                        $error = mysqli_error($conn);
                        mysqlInsertsErrors($error);
                    }
               
        }else if(($cant_dias > 101) || ($cant_dias < 101)){
            echo 89; // si el parto no es multiple no puede superar los 101 dias
            $string = 'cantidad dias: '.$cant_dias;
            datos($string);
        }
       
    }
}

/*
** MATERNIDAD EXCEDENCIA
*/
function insertMaternidadExcedencia($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$opciones,$conn,$dbase){

    $cant_dias = dias_pasados($f_desde,$f_hasta);
    
       
    if(($opciones == 1) && ($cant_dias == 90)){
        
        mysqli_select_db($conn,$dbase);
        $sql_1 = "INSERT INTO licencias ".
                     "(agente,
                       dni,
                       f_desde,
                       f_hasta,
                       tipo_licencia,
                       total_maternidad)".
                     "VALUES ".
                     "('$nombre',
                       '$dni',
                       '$f_desde',
                       '$f_hasta',
                       '$descripcion',
                       '$cant_dias')";
                
                    $query_1 = mysqli_query($conn,$sql_1);
                                
                    if($query_1){
                        echo 1; // registro incertado correctamente
                    }else{
                        echo -1; // error al incertar registro
                        $error = mysqli_error($conn);
                        mysqlInsertsErrors($error);
                    }
    
    }else if(($opciones == 1) && ($cant_dias < 90) || ($opciones == 1) || ($cant_dias > 90)){
       echo 91; // si seleccion?? tres meses de excedencia la cantidad de dias no puede ser menor o mayor a 90
       $string = 'cantidad dias: '.$cant_dias;
       datos($string);
    }
    
    
        
    
    if(($opciones == 2) && ($cant_dias == 180)){
        mysqli_select_db($conn,$dbase);
        $sql_2 = "INSERT INTO licencias ".
                     "(agente,
                       dni,
                       f_desde,
                       f_hasta,
                       tipo_licencia,
                       total_maternidad)".
                     "VALUES ".
                     "('$nombre',
                       '$dni',
                       '$f_desde',
                       '$f_hasta',
                       '$descripcion',
                       '$cant_dias')";
                
                    $query_2 = mysqli_query($conn,$sql_2);
                                
                    if($query_2){
                        echo 1; // registro incertado correctamente
                    }else{
                        echo -1; // error al incertar registro
                        $error = mysqli_error($conn);
                        mysqlInsertsErrors($error);
                    }
    
    }else if(($opciones == 2) && ($cant_dias < 180) || ($opciones == 2) && ($cant_dias > 180)){
        echo 93; // si la cantidad de meses seleccionada es 6 la cantidad de dias no puede ser menor o mayor a 180
        $string = 'cantidad dias: '.$cant_dias;
        datos($string);
    }
    

}

// ============================================================================================================================== //
// LICENCIAS EXTRAORDINARIAS CON GOCE DE HABERES
// ============================================================================================================================== //

/*
** PARA RENDIR EXAMENES
*/
function insertRendirExamen($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$cursando,$conn,$dbase){

    mysqli_select_db($conn,$dbase); // seleccionamos base de datos
    
    $sql = "select total_estudio, dias_tomados_estudio, dias_restantes_estudio from licencias where agente = '$nombre' and tipo_licencia = '$descripcion'";
    $query = mysqli_query($conn,$sql);
    while ($row = mysqli_fetch_array($query)){
        $total_estudio = $row['total_estudio'];
        $dias_tomados_estudio = $row['dias_tomados_estudio'];
        $dias_restantes_estudio = $row['dias_restantes_estudio'];
    }
    
    $cant_dias = dias_pasados($f_desde,$f_hasta);
    
    if($cursando == 1){
    
        $total_dias = 12;
        
        if(($total_estudio == 0) || ($total_estudio == 'NULL')){
        
            if(($cant_dias > 0) || ($cant_dias <= 3)){
                    
                    $dias_restantes = $total_dias - $cant_dias;
                
                    $sql_1 = "INSERT INTO licencias ".
                            "(agente,
                            dni,
                            f_desde,
                            f_hasta,
                            tipo_licencia,
                            total_estudio,
                            dias_tomados_estudio,
                            dias_restantes_estudio)".
                            "VALUES ".
                            "('$nombre',
                            '$dni',
                            '$f_desde',
                            '$f_hasta',
                            '$descripcion',
                            '$total_dias',
                            '$cant_dias',
                            '$dias_restantes')";
                        
                            $query_1 = mysqli_query($conn,$sql_1);
                                        
                            if($query_1){
                                echo 1; // registro incertado correctamente
                            }else{
                                echo -1; // error al incertar registro
                                $error = mysqli_error($conn);
                                mysqlInsertsErrors($error);
                            }
            
            }else if($cant_dias > 3){
                echo 95; // la cantidad de dias a tomar no puede ser mayor a 3
            }
        
        }
        
        if($total_estudio != 0){
            
            if(($cant_dias > 0) || ($cant_dias <= 3)){
                    
                    if($dias_restantes_estudio >= 3){
                    
                            $dias_restantes = $dias_restantes_estudio - $cant_dias;
                        
                            $sql_2 = "INSERT INTO licencias ".
                                    "(agente,
                                    dni,
                                    f_desde,
                                    f_hasta,
                                    tipo_licencia,
                                    total_estudio,
                                    dias_tomados_estudio,
                                    dias_restantes_estudio)".
                                    "VALUES ".
                                    "('$nombre',
                                    '$dni',
                                    '$f_desde',
                                    '$f_hasta',
                                    '$descripcion',
                                    '$total_dias',
                                    '$cant_dias',
                                    '$dias_restantes')";
                                
                                    $query_2 = mysqli_query($conn,$sql_2);
                                                
                                    if($query_2){
                                        echo 1; // registro incertado correctamente
                                    }else{
                                        echo -1; // error al incertar registro
                                        $error = mysqli_error($conn);
                                        mysqlInsertsErrors($error);
                                    }
                }else if($dias_restantes_estudio == 0){
                    echo 97; // ya no posee m??s dias
                }else if($dias_restantes_estudio < 3){
                    echo 99; // la cantidad de dias restantes son insuficientes
                }
            }else if($cant_dias > 3){
                echo 95; // la cantidad de dias a tomar no puede ser mayor a 3
            }
        
        }
    
    }
    
    if($cursando == 2){
    
        $total_dias = 28;
        
            if(($total_estudio == 0) || ($total_estudio == 'NULL')){
        
            if(($cant_dias > 0) || ($cant_dias <= 6)){
                    
                    $dias_restantes = $total_dias - $cant_dias;
                
                    $sql_3 = "INSERT INTO licencias ".
                            "(agente,
                            dni,
                            f_desde,
                            f_hasta,
                            tipo_licencia,
                            total_estudio,
                            dias_tomados_estudio,
                            dias_restantes_estudio)".
                            "VALUES ".
                            "('$nombre',
                            '$dni',
                            '$f_desde',
                            '$f_hasta',
                            '$descripcion',
                            '$total_dias',
                            '$cant_dias',
                            '$dias_restantes')";
                        
                            $query_3 = mysqli_query($conn,$sql_3);
                                        
                            if($query_3){
                                echo 1; // registro incertado correctamente
                            }else{
                                echo -1; // error al incertar registro
                                $error = mysqli_error($conn);
                                mysqlInsertsErrors($error);
                            }
            
            }else if($cant_dias > 6){
                echo 101; // la cantidad de dias a tomar no puede ser mayor a 6
            }
        
        }
        
        if($total_estudio != 0){
            
            if(($cant_dias > 0) || ($cant_dias <= 6)){
                    
                    if($dias_restantes_estudio >= 6){
                    
                            $dias_restantes = $dias_restantes_estudio - $cant_dias;
                        
                            $sql_4 = "INSERT INTO licencias ".
                                    "(agente,
                                    dni,
                                    f_desde,
                                    f_hasta,
                                    tipo_licencia,
                                    total_estudio,
                                    dias_tomados_estudio,
                                    dias_restantes_estudio)".
                                    "VALUES ".
                                    "('$nombre',
                                    '$dni',
                                    '$f_desde',
                                    '$f_hasta',
                                    '$descripcion',
                                    '$total_dias',
                                    '$cant_dias',
                                    '$dias_restantes')";
                                
                                    $query_4 = mysqli_query($conn,$sql_4);
                                                
                                    if($query_4){
                                        echo 1; // registro incertado correctamente
                                    }else{
                                        echo -1; // error al incertar registro
                                        $error = mysqli_error($conn);
                                        mysqlInsertsErrors($error);
                                    }
                }else if($dias_restantes_estudio == 0){
                    echo 105; // ya no posee m??s dias
                }else if($dias_restantes_estudio < 6){
                    echo 103; // la cantidad de dias restantes son insuficientes
                }
            }else if($cant_dias > 6){
                echo 101; // la cantidad de dias a tomar no puede ser mayor a 6
            }
        
        }
        
        
        
    }
    

}

/*
** PARA REALIZAR ESTUDIOS O INVESTIGACIONES
*/
function insertEstudiosInvestigaciones($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$anios_investigacion,$conn,$dbase){

    mysqli_select_db($conn,$dbase);
    $sql = "select antiguedad from agentes where nombre = '$nombre'";
    $query = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($query)){
        $antiguedad = $row['antiguedad'];
    }
    
    $sql_1 = "select cant_anios from licencias where agente = '$nombre' and tipo_licencia = '$descripcion'";
    $query_1 = mysqli_query($conn,$sql_1);
    while($row_1 = mysqli_fetch_array($query_1)){
        $cant_anios = $row_1['cant_anios'];
    }

    $cant_dias = dias_pasados($f_desde,$f_hasta);
    
    if(($cant_anios == 0) || ($cant_anios == 'NULL')){
    
        if(($cant_dias == 365) && ($anios_investigacion == 1)){
        
            if($antiguedad >= 1){
            
                    $sql_2 = "INSERT INTO licencias ".
                             "(agente,
                               dni,
                               f_desde,
                               f_hasta,
                               tipo_licencia,
                               cant_anios)".
                              "VALUES ".
                              "('$nombre',
                                '$dni',
                                '$f_desde',
                                '$f_hasta',
                                '$descripcion',
                                '$anios_investigacion')";
                     $query_2 = mysqli_query($conn,$sql_2);
                     
                     if($query_2){
                         echo 1; // registro incertado correctamente
                     }else{
                         echo -1; // error al incertar registro
                         $error = mysqli_error($conn);
                         mysqlInsertsErrors($error);
                     }
            
            }else if($antiguedad < 1){
                echo 109; // aun no tiene la antiguedad para solicitar dicha licencia
            }
                
        }else if(($cant_dias < 365) && ($anios_investigacion == 1) || ($cant_dias > 365) && ($anios_investigacion == 1)){
            echo 107; // la cantidad de dias no puede exceder de 365 o ser menor a 365
            $string = 'cantidad dias: '.$cant_dias;
            datos($string);
        }
    
            if(($cant_dias == 730) && ($anios_investigacion == 2)){
            
                if($antiguedad >= 1){
            
                    $sql_3 = "INSERT INTO licencias ".
                             "(agente,
                               dni,
                               f_desde,
                               f_hasta,
                               tipo_licencia,
                               cant_anios)".
                              "VALUES ".
                              "('$nombre',
                                '$dni',
                                '$f_desde',
                                '$f_hasta',
                                '$descripcion',
                                '$anios_investigacion')";
                     $query_3 = mysqli_query($conn,$sql_3);
                     
                     if($query_3){
                         echo 1; // registro incertado correctamente
                     }else{
                         echo -1; // error al incertar registro
                         $error = mysqli_error($conn);
                         mysqlInsertsErrors($error);
                     }
            
            }else if($antiguedad < 1){
                echo 109; // aun no tiene la antiguedad para solicitar dicha licencia
            }
            
        }else if(($cant_dias < 730) && ($anios_investigacion == 2) || ($cant_dias > 730) && ($anios_investigacion == 2)){
            echo 111; // la cantidad de dias no puede exceder de 730 o ser menor a 730
            $string = 'cantidad dias: '.$cant_dias;
            datos($string);
        }
    
    }
    
    if($cant_anios == 1){
    
        if(($cant_dias == 365) && ($anios_investigacion == 1)){
        
            if($antiguedad >= 1){
            
                $anios_investigacion += 1;
            
                    $sql_2 = "INSERT INTO licencias ".
                             "(agente,
                               dni,
                               f_desde,
                               f_hasta,
                               tipo_licencia,
                               cant_anios)".
                              "VALUES ".
                              "('$nombre',
                                '$dni',
                                '$f_desde',
                                '$f_hasta',
                                '$descripcion',
                                '$anios_investigacion')";
                     $query_2 = mysqli_query($conn,$sql_2);
                     
                     if($query_2){
                         echo 1; // registro incertado correctamente
                     }else{
                         echo -1; // error al incertar registro
                         $error = mysqli_error($conn);
                         mysqlInsertsErrors($error);
                     }
            
            }else if($antiguedad < 1){
                echo 109; // aun no tiene la antiguedad para solicitar dicha licencia
            }
                
        }else if(($cant_dias < 365) && ($anios_investigacion == 1) || ($cant_dias > 365) && ($anios_investigacion == 1)){
            echo 107; // la cantidad de dias no puede exceder de 365 o ser menor a 365
            $string = 'cantidad dias: '.$cant_dias;
            datos($string);
        }
    }
    
    if(($cant_anios == 2) && ($anios_investigacion == 1) || ($cant_anios == 2) && ($anios_investigacion == 2)){
        echo 113; // ya no posee m??s a??os para tomar dicha licencia
    }
    
    if(($cant_anios == 1) && ($anios_investigacion == 2)){
        echo 115; // solo le queda un a??o 
    }
    

}


/*
** ESTUDIO EN ESCUELA DE DEFENSA NACIONAL
*/
function insertEstudiosDefensaNacional($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){

    mysqli_select_db($conn,$dbase);
        
    if($revista == 'Planta Permanente'){
    
        $sql_1 = "INSERT INTO licencias ".
                 "(agente,
                   dni,
                   f_desde,
                   f_hasta,
                   tipo_licencia)".
                 "VALUES ".
                 "('$nombre',
                   '$dni',
                   '$f_desde',
                   '$f_hasta',
                   '$descripcion')";
        $query_1 = mysqli_query($conn,$sql_1);
        
            if($query_1){
                echo 1; // registro incertado correctamente
            }else{
                echo -1; // error al incertar registro
                $error = mysqli_error($conn);
                mysqlInsertsErrors($error);
            }
    }else{
        echo 117; // solo planta permanente puede solicitar dicha licencia
    }

}

/*
** MATROMIO DEL AGENTE O DEL HIJO DEL AGENTE
*/
function insertCasamientoAgente($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$matrimonio,$conn,$dbase){
    
    $cant_dias = dias_pasados($f_desde,$f_hasta);

    if($matrimonio == 1){
    
        if(($cant_dias >= 12) || ($cant_dias <= 14)){
        
        mysqli_select_db($conn,$dbase);
        $sql = "INSERT INTO licencias ".
                 "(agente,
                   dni,
                   f_desde,
                   f_hasta,
                   tipo_licencia)".
                 "VALUES ".
                 "('$nombre',
                   '$dni',
                   '$f_desde',
                   '$f_hasta',
                   '$descripcion')";
        $query = mysqli_query($conn,$sql);
        
            if($query){
                echo 1; // registro incertado correctamente
            }else{
                echo -1; // error al incertar registro
                $error = mysqli_error($conn);
                mysqlInsertsErrors($error);
            }
    
    }else if(($cant_dias < 12) || ($cant_dias > 14))
        echo 119; // los dias deben estar entre 12 y 14 dias
   }
   
   if($matrimonio == 2){
   
        if(($cant_dias >= 3) || ($cant_dias <= 5)){
                mysqli_select_db($conn,$dbase);
                $sql = "INSERT INTO licencias ".
                        "(agente,
                        dni,
                        f_desde,
                        f_hasta,
                        tipo_licencia)".
                        "VALUES ".
                        "('$nombre',
                        '$dni',
                        '$f_desde',
                        '$f_hasta',
                        '$descripcion')";
                $query = mysqli_query($conn,$sql);
                
                    if($query){
                        echo 1; // registro incertado correctamente
                    }else{
                        echo -1; // error al incertar registro
                        $error = mysqli_error($conn);
                        mysqlInsertsErrors($error);
                    }
    
      }else if(($cant_dias < 3) || ($cant_dias > 5)){
            echo 121; // la cantidad de dias debe estar entre 3 y 5 dias.
      }
   
   }

}

/*
** ACTIVIDADES DEPORTIVAS NO RENTADAS
*/
function insertActividadesDeportivas($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){

    $cant_dias = dias_pasados($f_desde,$f_hasta);

    mysqli_select_db($conn,$dbase);
    
    $sql = "INSERT INTO licencias ".
           "(agente,
             dni,
             f_desde,
             f_hasta,
             tipo_licencia,
             dias_tomados_otros)".
           "VALUES ".
           "('$nombre',
             '$dni',
             '$f_desde',
             '$f_hasta',
             '$descripcion',
             '$cant_dias')";
           $query = mysqli_query($conn,$sql);
           
           if($query){
              echo 1; // registro incertado correctamente
           }else{
              echo -1; // error al incertar registro
              $error = mysqli_error($conn);
              mysqlInsertsErrors($error);
           }
    
}


// ============================================================================================================================== //
// LICENCIAS EXTRAORDINARIAS SIN GOCE DE HABERES
// ============================================================================================================================== //
/*
** EJERCICIO TRANSITORIO DE OTROS CARGOS
*/
function insertCargosTransitorios($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){
    
    $cant_dias = dias_pasados($f_desde,$f_hasta);

    mysqli_select_db($conn,$dbase);
    
    if($revista == 'Planta Permanente'){
    
    $sql = "INSERT INTO licencias ".
           "(agente,
             dni,
             f_desde,
             f_hasta,
             tipo_licencia,
             dias_tomados_otros)".
           "VALUES ".
           "('$nombre',
             '$dni',
             '$f_desde',
             '$f_hasta',
             '$descripcion',
             '$cant_dias')";
           $query = mysqli_query($conn,$sql);
           
           if($query){
              echo 1; // registro incertado correctamente
           }else{
              echo -1; // error al incertar registro
              $error = mysqli_error($conn);
              mysqlInsertsErrors($error);
           }
    }else{
        echo 123; // solo planta permanente
    }
    
}

/*
** RAZONES PARTICULARES (ART. 13b2)
*/
function insertRazonesParticulares($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$meses,$conn,$dbase){
    
    $cant_dias = dias_pasados($f_desde,$f_hasta); // se obtiene la cantidad de dias entre fechas
    
    mysqli_select_db($conn,$dbase);
    $sql = "select f_hasta, dias_tomados_otros from licencias where agente = '$nombre' and tipo_licencia = '$descripcion'";
    $query = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($query);
    while($row = mysqli_fetch_array($query)){
        $f_fin = $row['f_hasta'];
        $dias_tomados = $row['dias_tomados_otros'];
    }
       
    $decada = dias_pasados($f_fin,$f_desde);
    
    if(($rows == 0) || ($rows == 'NULL')){
    
            if($revista == 'Planta Permanente'){
                    
                if(($cant_dias == 180) && ($meses == 6)){
                
                        $sql_1 = "INSERT INTO licencias ".
                                "(agente,
                                    dni,
                                    f_desde,
                                    f_hasta,
                                    tipo_licencia,
                                    dias_tomados_otros)".
                                "VALUES ".
                                "('$nombre',
                                    '$dni',
                                    '$f_desde',
                                    '$f_hasta',
                                    '$descripcion',
                                    '$cant_dias')";
                                $query_1 = mysqli_query($conn,$sql_1);
                                
                                if($query_1){
                                    echo 1; // registro incertado correctamente
                                }else{
                                    echo -1; // error al incertar registro
                                    $error = mysqli_error($conn);
                                    mysqlInsertsErrors($error);
                                }
                }else if(($cant_dias < 180) && ($meses == 6) || ($cant_dias > 180) && ($meses == 6)){
                    echo 124; // la cantidad de dias no debe ser menor o superior a 180
                    $string = 'cantidad dias: '.$cant_dias;
                    datos($string);
                }
            
            
            }else{
                echo 123; // solo personal que reviste en planta permanente
            }
    }
    
    if($rows > 0){
    
        if($decada >= 3600){
        
            if($revista == 'Planta Permanente'){
                    
                if(($cant_dias == 180) && ($meses == 6)){
                
                        $sql_1 = "INSERT INTO licencias ".
                                "(agente,
                                    dni,
                                    f_desde,
                                    f_hasta,
                                    tipo_licencia,
                                    dias_tomados_otros)".
                                "VALUES ".
                                "('$nombre',
                                    '$dni',
                                    '$f_desde',
                                    '$f_hasta',
                                    '$descripcion',
                                    '$cant_dias')";
                                $query_1 = mysqli_query($conn,$sql_1);
                                
                                if($query_1){
                                    echo 1; // registro incertado correctamente
                                }else{
                                    echo -1; // error al incertar registro
                                    $error = mysqli_error($conn);
                                    mysqlInsertsErrors($error);
                                }
                }else if(($cant_dias < 180) && ($meses == 6) || ($cant_dias > 180) && ($meses == 6)){
                    echo 124; // la cantidad de dias no debe ser menor o superior a 180
                    $string = 'cantidad dias: '.$cant_dias;
                    datos($string);
                }
            
            
            }else{
                echo 123; // solo personal que reviste en planta permanente
            }
        
        }else if($decada < 3600){
            echo 125; // a??n no han pasado 10 a??os para volver a tomar dicha licencia
        }
        
    }

}


/*
** RAZONES DE ESTUDIO (ART. 13c2)
*/
function insertRazonesEstudio($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$anio,$conn,$dbase){
    
    $cant_dias = dias_pasados($f_desde,$f_hasta); // se obtiene la cantidad de dias entre fechas
    
    mysqli_select_db($conn,$dbase);
    $sql = "select f_hasta, dias_tomados_otros from licencias where agente = '$nombre' and tipo_licencia = '$descripcion'";
    $query = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($query);
    while($row = mysqli_fetch_array($query)){
        $f_fin = $row['f_hasta'];
        $dias_tomados = $row['dias_tomados_otros'];
    }
       
    $decada = dias_pasados($f_fin,$f_desde);
    
    if(($rows == 0) || ($rows == 'NULL')){
    
            if($revista == 'Planta Permanente'){
                    
                if(($cant_dias == 365) && ($anio == 1)){
                
                        $sql_1 = "INSERT INTO licencias ".
                                "(agente,
                                    dni,
                                    f_desde,
                                    f_hasta,
                                    tipo_licencia,
                                    dias_tomados_otros)".
                                "VALUES ".
                                "('$nombre',
                                    '$dni',
                                    '$f_desde',
                                    '$f_hasta',
                                    '$descripcion',
                                    '$cant_dias')";
                                $query_1 = mysqli_query($conn,$sql_1);
                                
                                if($query_1){
                                    echo 1; // registro incertado correctamente
                                }else{
                                    echo -1; // error al incertar registro
                                    $error = mysqli_error($conn);
                                    mysqlInsertsErrors($error);
                                }
                }else if(($cant_dias < 365) && ($anio == 1) || ($cant_dias > 365) && ($anio == 1)){
                    echo 127; // la cantidad de dias no debe ser menor o superior a 365
                    $string = 'cantidad dias: '.$cant_dias;
                    datos($string);
                }
            
            
            }else{
                echo 123; // solo personal que reviste en planta permanente
            }
    }
    
    if($rows > 0){
    
        if($decada >= 3600){
        
            if($revista == 'Planta Permanente'){
                    
                if(($cant_dias == 365) && ($anio == 1)){
                
                        $sql_1 = "INSERT INTO licencias ".
                                "(agente,
                                    dni,
                                    f_desde,
                                    f_hasta,
                                    tipo_licencia,
                                    dias_tomados_otros)".
                                "VALUES ".
                                "('$nombre',
                                    '$dni',
                                    '$f_desde',
                                    '$f_hasta',
                                    '$descripcion',
                                    '$cant_dias')";
                                $query_1 = mysqli_query($conn,$sql_1);
                                
                                if($query_1){
                                    echo 1; // registro incertado correctamente
                                }else{
                                    echo -1; // error al incertar registro
                                    $error = mysqli_error($conn);
                                    mysqlInsertsErrors($error);
                                }
                }else if(($cant_dias < 365) && ($anio == 1) || ($cant_dias > 365) && ($anio == 1)){
                    echo 124; // la cantidad de dias no debe ser menor o superior a 180
                    $string = 'cantidad dias: '.$cant_dias;
                    datos($string);
                }
            
            
            }else{
                echo 123; // solo personal que reviste en planta permanente
            }
        
        }else if($decada < 3600){
            echo 125; // a??n no han pasado 10 a??os para volver a tomar dicha licencia
        }
        
    }

}


/*
** LICENCIA PARA ACOMPA??AR A CONYUGE
*/
function insertAcompa??arConyuge($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){

    $cant_dias = dias_pasados($f_desde,$f_hasta);
    mysqli_select_db($conn,$dbase);
        
        if($revista == 'Planta Permanente'){
                    
                if($cant_dias >= 60){
                
                        $sql_1 = "INSERT INTO licencias ".
                                "(agente,
                                    dni,
                                    f_desde,
                                    f_hasta,
                                    tipo_licencia,
                                    dias_tomados_otros)".
                                "VALUES ".
                                "('$nombre',
                                    '$dni',
                                    '$f_desde',
                                    '$f_hasta',
                                    '$descripcion',
                                    '$cant_dias')";
                                $query_1 = mysqli_query($conn,$sql_1);
                                
                                if($query_1){
                                    echo 1; // registro incertado correctamente
                                }else{
                                    echo -1; // error al incertar registro
                                    $error = mysqli_error($conn);
                                    mysqlInsertsErrors($error);
                                }
                }else if($cant_dias < 60){
                    echo 129; // la cantidad de dias no debe ser menor a 60
                    $string = 'cantidad dias: '.$cant_dias;
                    datos($string);
                }
            
            
            }else{
                echo 123; // solo personal que reviste en planta permanente
            }

}


/*
** LICENCIA PARA CARGOS Y HORAS CATEDRA
*/
function insertHorasCatedra($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase){

    $cant_dias = dias_pasados($f_desde,$f_hasta);
    mysqli_select_db($conn,$dbase);
        
        if($revista == 'Planta Permanente'){
                                
                        $sql_1 = "INSERT INTO licencias ".
                                "(agente,
                                    dni,
                                    f_desde,
                                    f_hasta,
                                    tipo_licencia,
                                    dias_tomados_otros)".
                                "VALUES ".
                                "('$nombre',
                                    '$dni',
                                    '$f_desde',
                                    '$f_hasta',
                                    '$descripcion',
                                    '$cant_dias')";
                                $query_1 = mysqli_query($conn,$sql_1);
                                
                                if($query_1){
                                    echo 1; // registro incertado correctamente
                                }else{
                                    echo -1; // error al incertar registro
                                    $error = mysqli_error($conn);
                                    mysqlInsertsErrors($error);
                                }
                
            }else{
                echo 123; // solo personal que reviste en planta permanente
            }

}

// ============================================================================================================================== //
// FIN PERSISNTENCIA A BASE
// ============================================================================================================================== //

/*
** ELIMINAR REGISTRO DE LICENCIA
*/
function deleteLicencia($id,$conn,$dbase){

    mysqli_select_db($conn,$dbase);
    $sql = "delete from licencias where id = '$id'";
    $query = mysqli_query($conn,$sql);
    
    if($query){
        echo 1; // registro eliminado
    }else{
        echo -1; // error al eliminar el registro
    }

}



/*
** insertar nueva album en base de datos
*/
function insertComprobante($id,$file,$conn,$dbase){
 
$targetDir = '../comprobantes/';
$comprobante = $file;
//$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $comprobante;

$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


if(!empty($_FILES["file"]["tmp_name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','jpeg','png','bmp','pdf');
    
    if(in_array($fileType, $allowTypes)){
    
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
         
               
        $sql = "update licencias set comprobantes = '$comprobante' where id = '$id'";
        
        mysqli_select_db($conn,$dbase);
        $query = mysqli_query($conn,$sql);
              
               
                 
            if($query){
            
			  echo '<div class="alert alert-success" role="alert">';
			  echo '<img class="img-reponsive img-rounded" src="../icons/actions/dialog-ok-apply.png" />
                         <strong> Comprobante Guardado Exitosamente. El Archivo '.$comprobante. ' se ha subido correctamente..</strong>';
              echo "</div><hr>";
            
            }else{
		  
			  echo '<div class="alert alert-success" role="alert">';
			  echo '<img class="img-reponsive img-rounded" src="../icons/actions/dialog-ok-apply.png" />
                        <strong> El Archivo '.$comprobante. ' se ha subido correctamente.</strong></p>';
              echo "</div><hr>";
            
            } 
            }else{
			  echo '<div class="alert alert-warning" role="alert">';
			  echo '<img class="img-reponsive img-rounded" src="../icons/actions/dialog-cancel.png" />
                        <strong> Ups. Hubo un error subiendo el Archivo. Verifique si posee permisos su usuario, o el directorio de destino tiene permisos de escritura</strong></p>';
              echo "</div><hr>";
              
            }
            }else{
    
			  echo '<div class="alert alert-danger" role="alert">';
			  echo '<img class="img-reponsive img-rounded" src="../icons/actions/dialog-cancel.png" />
                        <strong> Ups, solo archivos con extensi??n: JPG, PNG, JPEG, BMP Y PDF son soportados.</strong></p>';
			  echo "</div><hr>";
            }
            }else{
                    echo '<div class="alert alert-info" role="alert">';
                    echo '<img class="img-reponsive img-rounded" src="../icons/actions/system-reboot.png" />
                            <strong> Por favor, seleccione al archivo a subir </strong></p>';
                    echo "</div><hr>";
            }

}

// ================================================================== //
// TIPO DE LICENCIAS
// LISTADOS
/*
** funcion que carga la tabla de todos los tipos de licencias existentes
*/
function listarTipoLicencia($nombre,$conn,$dbase){

if($conn)
{
	$sql = "SELECT * FROM tipo_licencia";
    	mysqli_select_db($conn,$dbase);
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="container-fluid" style="margin-top:70px">
            <div class="panel panel-default" >
	      <div class="panel-heading"><span class="pull-center "><img src="../icons/actions/view-calendar-upcoming-events.png"  class="img-reponsive img-rounded"> Listado de Tipo de Licencia';
    echo '<form <action="#" method="POST">
            <p align="right">
                <button type="submit" class="btn btn-default btn-sm" name="new_tipo_licencia" data-toggle="tooltip" title="A??adir Tipo de Licencia">
                    <img src="../icons/actions/view-time-schedule-insert.png"  class="img-reponsive img-rounded">
                </button>
            </p>
          </form>';
	      
	echo '</div><br>';

            echo "<table class='table table-condensed table-hover' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>Tipo Licencia</th>
            <th class='text-nowrap text-center'>Descripci??n</th>
            <th class='text-nowrap text-center'>Art??culo</th>
            <th class='text-nowrap text-center'>Revista</th>
            <th class='text-nowrap text-center'>Tiempo Licencia</th>enfermedad
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
                            <input type="hidden" name="id" value="'.$fila['id'].'">';
                            
                            if($nombre == 'Administrador'){
                            
                            echo '<button type="submit" class="btn btn-primary btn-sm" name="editar_tipo_licencia">
                            <img src="../icons/actions/document-edit.png"enfermedad  class="img-reponsive img-rounded"> Editar</button>';
                            
                            }
                          
             echo '</form>';
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
// FORMULARIOS TIPO DE LICENCIAS
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
                                    <label for="descripcion">Descripci??n:</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="articulo">Art??culo:</label>
                                    <input type="text" class="form-control" id="articulo" name="articulo" required>
                                </div><hr>
                                
                            </div>
                            
                            <div class="col-sm-3">
                                
                                <div class="form-group">
                                    <label for="revista">Tipo Situaci??n de Revista:</label>
                                    <select class="form-control" id="revista" name="revista" required>
                                        <option value="" selected disabled>Seleccionar</option>
                                        <option value="1">Planta Permanente</option>
                                        <option value="2">No Permanente</enfermedadoption>
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


/*
** funcion que llama al formulario de cargar de nuevo tipo de licencia
*/
function formEditTipoLicencia($id,$conn,$dbase){

    $sql = "select * from tipo_licencia where id = '$id'";
    mysqli_select_db($conn,$dbase);
    $query = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($query)){
        $clase_licencia = $row['clase_licencia'];
        $descripcion = $row['descripcion'];
        $art_licencia = $row['art_licencia'];
        $revista = $row['tipo_revista'];
        $clase_licencia = $row['clase_licencia'];
        $tiempo = $row['tiempo'];
        $goce_haberes = $row['goce_haberes'];
        $obligatoria = $row['obligatoria'];
        $particularidad = $row['particularidad'];
    }

    echo '<div class="container" style="margin-top:70px">
            <div class="panel panel-default">
                    
                <div class="panel-heading">
                    <img class="img-reponsive img-rounded" src="../icons/actions/document-edit.png" /> Editar Tipo de Licencia
                </div>
                <div class="panel-body">
                     <form id="fr_edit_tipo_licencia_ajax" method="POST">
                    <div class="container" style="margin-left:100px">
                        <input type="hidden" name="id" value="'.$id.'">
                        
                        <div class="row">
                            
                            <div class="col-sm-3">
                                
                                <div class="form-group">
                                <label for="clase_licencia">Clase de Licencia:</label>
                                <select class="form-control" id="edit_clase_licencia" name="clase_licencia" required disabled>
                                    <option value="" selected disabled>Seleccionar</option>
                                    <option value="1" '.(($clase_licencia == 'Licencias Ordinarias') ? ' selected = "selected"':"").'>Licencias Ordinarias</option>
                                    <option value="2" '.(($clase_licencia == 'Licencias Especiales') ? ' selected = "selected"':"").'>Licencias Especiales</option>
                                    <option value="3" '.(($clase_licencia == 'Licencias Extraordinarias con goce de haberes') ? ' selected = "selected"':"").'>Licencias Extraordinarias con goce de haberes</option>
                                    <option value="4" '.(($clase_licencia == 'Licencias Extraordinarias sin goce de haberes') ? ' selected = "selected"':"").'>Licencias Extraordinarias sin goce de haberes</option>
                                    <option value="5" '.(($clase_licencia == 'Inasistencias') ? ' selected = "selected"':"").'>Insistencias</option>
                                    <option value="6" '.(($clase_licencia == 'Franquicias') ? ' selected = "selected"':"").'>Franquicias</option>
                                </select><br>
                                <button type="button" class="btn btn-warning" onclick=callEditLicencia("edit_clase_licencia")>Editar</button>
                                </div>
                           
                                <div class="form-group">
                                    <label for="descripcion">Descripci??n:</label>
                                    <input type="text" class="form-control" id="edit_descripcion" name="descripcion" value="'.$descripcion.'" required readonly><br>
                                    <button type="button" class="btn btn-warning" onclick=callEditLicencia("edit_descripcion")>Editar</button>
                                </div>
                                
                                <div class="form-group">
                                    <label for="articulo">Art??culo:</label>
                                    <input type="text" class="form-control" id="edit_articulo" name="articulo" value="'.$art_licencia.'" required readonly><br>
                                    <button type="button" class="btn btn-warning" onclick=callEditLicencia("edit_articulo")>Editar</button>
                                </div><hr>
                                
                            </div>
                            
                            <div class="col-sm-3">
                                
                                <div class="form-group">
                                    <label for="revista">Tipo Situaci??n de Revista:</label>
                                    <select class="form-control" id="edit_revista" name="revista" required disabled>
                                        <option value="" selected disabled>Seleccionar</option>
                                        <option value="1" '.(($revista == 'Planta Permanente') ? ' selected = "selected"':"").'>Planta Permanente</option>
                                        <option value="2" '.(($revista == 'No Permanente') ? ' selected = "selected"':"").'>No Permanente</option>
                                        <option value="3" '.(($revista == 'Ambas') ? ' selected = "selected"':"").'>Ambas</option>
                                    </select><br>
                                    <button type="button" class="btn btn-warning" onclick=callEditLicencia("edit_revista")>Editar</button>
                                </div>
                                
                                <div class="form-group">
                                    <label for="tiempo">Plazos:</label>
                                    <input type="text" class="form-control" id="edit_tiempo" name="tiempo" value="'.$tiempo.'" required readonly><br>
                                    <button type="button" class="btn btn-warning" onclick=callEditLicencia("edit_tiempo")>Editar</button>
                                </div>
                             
                                <div class="form-group">
                                    <label for="goce_haberes">Goce de Haberes:</label>
                                    <select class="form-control" id="edit_goce_haberes" name="goce_haberes" required disabled>
                                        <option value="" selected disabled>Seleccionar</option>
                                        <option value="1" '.(($goce_haberes == 'Si') ? ' selected = "selected"':"").'>Si</option>
                                        <option value="2" '.(($goce_haberes == 'No') ? ' selected = "selected"':"").'>No</option>
                                </select><br>
                                <button type="button" class="btn btn-warning" onclick=callEditLicencia("edit_goce_haberes")>Editar</button>
                                </div><hr>
                                
                                
                            </div>
                            
                             <div class="col-sm-3">
                             
                                <div class="form-group">
                                    <label for="obligatoriedad">Obligatoriedad:</label>
                                    <select class="form-control" id="edit_obligatoriedad" name="obligatoriedad" required disabled>
                                        <option value="" selected disabled>Seleccionar</option>
                                        <option value="1" '.(($obligatoria == 'Si') ? ' selected = "selected"':"").'>Si</option>
                                        <option value="2" '.(($obligatoria == 'No') ? ' selected = "selected"':"").'>No</option>
                                </select><br>
                                <button type="button" class="btn btn-warning" onclick=callEditLicencia("edit_obligatoriedad")>Editar</button>
                                </div>
                                
                                <div class="form-group">
                                    <label for="particularidad">Particularidades:</label>
                                    <textarea class="form-control" rows="4" id="edit_particularidad" name="particularidad" spellcheck="true" required readonly>'.$particularidad.'</textarea><br>
                                    <button type="button" class="btn btn-warning" onclick=callEditLicencia("edit_particularidad")>Editar</button>
                                </div><hr>
                                                              
                                
                            </div>                                 
                        </div>
                        
                        <div class="row">
                        <div class="col-sm-3">
                        <button type="submit" class="btn btn-success" name="edit_tipo_licencia" id="edit_tipo_licencia">
                            <img class="img-reponsive img-rounded" src="../icons/actions/document-save-as.png" /> Actualizar</button>
                        </div>
                        </div>
                        
                    </div>
                        </form> 
                </div>
            </div>
          </div>';


}




// ================================================================ //enfermedad
// PERSISTENCIA A LA BASE
// persistir tipo de licencia
/*
** funcion que guarda registro de tipo de licencia
*/
function addTipoLicencia($clase_licencia,$descripcion,$articulo,$revista,$tiempo,$goce_haberes,$obligatoriedad,$particularidad,$conn,$dbase){

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
    mysqli_select_db($conn,$dbase);
    $query = mysqli_query($conn,$sql);
    
    if($query){
        echo 1; // el registro fue satisfactorio
    }else{
        echo -1; // hubo un problema al insertar el registro
    }
    }else{
        echo 2; // caracteres inv??lidos
    }

}


/*
** FUNCION DE PERSISTENCIA A BASE DE ACTUALIZACION DE TIPO DE LICENCIA
*/
function updateTipoLicencia($id,$clase_licencia,$descripcion,$articulo,$revista,$tiempo,$goce_haberes,$obligatoriedad,$particularidad,$conn,$dbase){

    if((intValidator($clase_licencia) == 1) ||
            (nameValidator($descripcion) == 1) ||
                (nameValidator($articulo) == 1) ||
                    (intValidator($revista) == 1) ||
                        (nameValidator($tiempo) == 1) ||
                            (intValidator($goce_haberes) == 1) ||
                                (intValidator($obligatoriedad) == 1) ||
                                    (nameValidator($particularidad) == 1)){


    $sql = "UPDATE tipo_licencia set 
            clase_licencia = '$clase_licencia', 
            descripcion = '$descripcion', 
            art_licencia = '$articulo', 
            tipo_revista = '$revista', 
            tiempo = '$tiempo', 
            goce_haberes = '$goce_haberes', 
            obligatoria = '$obligatoriedad', 
            particularidad = '$particularidad' 
            where id = '$id'";
    
    mysqli_select_db($conn,$dbase);
    $query = mysqli_query($conn,$sql);
    
    if($query){
        echo 1; // el registro fue satisfactorio
    }else{
        echo -1; // hubo un problema al insertar el registro
    }
    }else{
        echo 2; // caracteres inv??lidos
    }


}

?>
