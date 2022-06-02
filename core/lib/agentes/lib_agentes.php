<?php

// ========================================================================================= //
// LISTADOS //
/*
** funcion que carga la tabla de todos los agentes
*/


function listarAgentes($conn,$dbase){

if($conn){

	$sql = "SELECT * FROM agentes";
    mysqli_select_db($conn,$dbase);
    $resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="container-fluid" style="margin-top:70px">
            <div class="panel panel-default" >
                <div class="panel-heading">
                    <img src="../icons/actions/meeting-attending.png"  class="img-reponsive img-rounded"> Listado de Agentes
                </div><br>';
    
      echo "<table class='table table-condensed table-hover' style='width:100%' id='myTable'>";
      echo "<thead>
            <th class='text-nowrap text-center'></th>
		    <th class='text-nowrap text-center'>Nombre y Apellido</th>
            <th class='text-nowrap text-center'>DNI</th>
            <th class='text-nowrap text-center'>Email</th>
            <th class='text-nowrap text-center'>Antiguedad</th>
            <th class='text-nowrap text-center'>Situación Revista</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 if($fila['avatar'] != ''){
			 echo "<td align=center><img src='$fila[avatar]' alt='Avatar' class='avatar' ></td>";
			 }else{
			 echo "<td align=center><img src='../icons/actions/fileview-preview.png' alt='Avatar' class='avatar' ></td>";
			 }
			 echo "<td align=center>".$fila['nombre']."</td>";
			 echo "<td align=center>".$fila['dni']."</td>";
			 echo "<td align=center>".$fila['email']."</td>";
			 echo "<td align=center>".$fila['antiguedad']."</td>";
			 echo "<td align=center>".$fila['situacion_revista']."</td>";
			 echo "<td class='text-nowrap'>";
             echo '<form <action="#" method="POST">
                    <input type="hidden" name="id" value="'.$fila['id'].'">
                        <button type="submit" class="btn btn-success btn-sm" name="editar_agente">
                            <img src="../icons/actions/document-edit.png"  class="img-reponsive img-rounded"> Editar</button>
                   </form>';
             echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<button type="button" class="btn btn-primary">Cantidad de Agentes:  '.$count.' </button>';
		echo '</div></div>';
		}else{
		  echo 'Connection Failure...' .mysqli_error($conn);
		}

    mysqli_close($conn);

}


// ========================================================================================= //
// FORMULARIOS //


/*
** funcion que muestra el formulario de edición de Agentes
*/
function formEditAgente($id,$name,$conn,$dbase){
    
       
   if($id != ''){ 
    
    mysqli_select_db($conn,$dbase);
    $sql = "select * from agentes where id = '$id'";
    $query = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($query)){
        $nombre = $row['nombre'];
        $dni = $row['dni'];
        $email = $row['email'];
        $antiguedad = $row['antiguedad'];
        $revista = $row['situacion_revista'];
        
    }
    }
    if($name != ''){
    
        mysqli_select_db($conn,$dbase);
        $sql = "select * from agentes where nombre = '$name'";
        $query = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($query)){
            $id = $row['id'];
            $nombre = $row['nombre'];
            $dni = $row['dni'];
            $email = $row['email'];
            $antiguedad = $row['antiguedad'];
            $revista = $row['situacion_revista'];
    
    }
    }
       
    echo '<div class="container" style="margin-top:70px">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img class="img-reponsive img-rounded" src="../icons/actions/user-group-properties.png" /> Editar Agente
                </div>
                <div class="panel-body">
                     <form id="fr_actualizar_agente_ajax" method="POST">
                     <input type="hidden" class="form-control" name="id" value="'.$id.'" id="id">
                    <div class="container" style="margin-left:100px">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nombre">Nombre y Apellido:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="'.$nombre.'" required>
                                </div>
                                <div class="form-group">
                                    <label for="dni">DNI:</label>
                                    <input type="text" class="form-control" id="dni" name="dni" maxlength="8" value="'.$dni.'" required>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="'.$email.'" required>
                                </div>
                                <div class="form-group">
                                    <label for="antiguedad">Antiguedad:</label>
                                    <input type="number" class="form-control" id="antiguedad" name="antiguedad" value="'.$antiguedad.'" required>
                                </div>
                            </div>
                            
                             <div class="col-sm-3">
                             <div class="form-group">
                                <label for="revista">Situación de Revista:</label>
                                <select class="form-control" id="revista" name="revista">
                                    <option value="" selected disabled>Seleccionar</option>
                                    <option value="1" '.(($revista == 'Planta Permanente') ? ' selected = "selected"':"").'>Planta Permanente</option>
                                    <option value="2" '.(($revista == 'Ley Marco') ? ' selected = "selected"':"").'>Ley Marco</option>
                                    <option value="3" '.(($revista == 'Contrato 1109') ? ' selected = "selected"':"").'>Contrato 1109</option>
                                    </select>
                                </div> 
                                                              
                                
                            </div>                                 
                        </div>
                        
                        <div class="row">
                        <div class="col-sm-3">
                        <button type="submit" class="btn btn-success" name="edit_agente" id="edit_agente">
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
** funcion que actualiza datos de agente en la base de datos
*/
function updateAgente($id,$nombre,$dni,$email,$antiguedad,$revista,$conn,$dbase){

    $string_1 = nameValidator($nombre);
    $string_2 = intValidator($dni);
    $string_3 = emailValidator($email);
    $string_4 = intValidator($antiguedad);
    $string_5 = intValidator($revista);
    
    if(($string_1 == 1) && ($string_2 == 1) && ($string_3 == 1) && ($string_4 == 1) && ($string_5 == 1)){
    
    $sql = "update agentes set 
            nombre = '$nombre', 
            dni = '$dni', 
            email = '$email', 
            antiguedad = '$antiguedad', 
            situacion_revista = '$revista' 
            where id = '$id'";
            
    mysqli_select_db($conn,$dbase);
    $query = mysqli_query($conn,$sql);
    
    if($query){
        echo 1; // actualizacion exitosa
    }else{
        echo -1; // actualizacion erronea
    }
    }else{
	   echo 2; // alguna de las variables contiene caracteres inválidos
    }
}

?>
