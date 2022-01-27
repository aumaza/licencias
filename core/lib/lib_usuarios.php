<?php

// ========================================================================================= //
// LISTADOS //
/*
** funcion que carga la tabla de todos los usuarios
*/


function listarUsuarios($conn){

if($conn)
{
	$sql = "SELECT * FROM usuarios";
    	mysqli_select_db($conn,'licor');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="container-fluid" style="margin-top:70px">
            <div class="panel panel-default" >
	      <div class="panel-heading"><span class="pull-center "><img src="../icons/actions/meeting-attending.png"  class="img-reponsive img-rounded"> Listado de Usuarios';
    echo '<form <action="#" method="POST">
            <p align="right">
                <button type="submit" class="btn btn-default btn-sm" name="new_user" data-toggle="tooltip" title="Añadir Usuario">
                    <img src="../icons/actions/user-group-new.png"  class="img-reponsive img-rounded">
                </button>
            </p>
          </form>';
	      
	echo '</div><br>';

            echo "<table class='table table-condensed table-hover' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>Nombre</th>
            <th class='text-nowrap text-center'>User</th>
            <th class='text-nowrap text-center'>Email</th>
            <th class='text-nowrap text-center'>Permisos</th>
            <th>&nbsp;</th>
            </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['nombre']."</td>";
			 echo "<td align=center>".$fila['user']."</td>";
			 echo "<td align=center>".$fila['email']."</td>";
			 echo "<td align=center>".$fila['role']."</td>";
			 echo "<td class='text-nowrap'>";
             echo '<a data-toggle="modal" data-target="#modalUserAllow" href="#" data-id="'.$fila['id'].'" class="btn btn-default btn-sm">
             <img src="../icons/actions/system-switch-user.png"  class="img-reponsive img-rounded"> Cambiar Permisos</a>';
             echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<button type="button" class="btn btn-primary">Cantidad de Usuarios:  '.$count.' </button>';
		echo '</div></div>';
		}else{
		  echo 'Connection Failure...' .mysqli_error($conn);
		}

    mysqli_close($conn);

}


/*
** funcon que carga el usuario logueado
*/

function loadUser($conn,$nombre){

if($conn){
	
	$sql = "SELECT * FROM usuarios where nombre = '$nombre'";
    	mysqli_select_db($conn,'licor');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="container" style="margin-top:70px">
          <div class="alert alert-success">
	      <img src="../icons/actions/user-group-properties.png"  class="img-reponsive img-rounded"> Mis Datos
	      </div>';
	      
	          echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Nombre</th>
                    <th class='text-nowrap text-center'>Usuario</th>
                    <th>&nbsp;</th>
                    </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['nombre']."</td>";
			 echo "<td align=center>".$fila['user']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<a data-toggle="modal" data-target="#modalChangePass" href="#" data-id="'.$fila['id'].'" class="btn btn-default btn-sm">
                    <img src="../icons/actions/view-refresh.png"  class="img-reponsive img-rounded"> Cambiar Password</a>';
             if($nombre != 'Administrador'){
                    echo '<form <action="#" method="POST">
                            <input type="hidden" name="name" value="'.$fila['nombre'].'">
                            <button type="submit" class="btn btn-success btn-sm" name="editar_datos_personales">
                            <img src="../icons/actions/document-edit.png"  class="img-reponsive img-rounded"> Editar Datos</button>
                        </form>';
            }
			 echo "</td>";
			 $count++;
		}

		echo "</table><br></div>";
		
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}



// ========================================================================================= //
// FORMULARIOS //


/*
** funcion que muestra el formulario de alta de usuarios
*/
function formAltaUsuarios(){

    echo '<div class="container" style="margin-top:70px">
            <div class="panel panel-default">
                    
                <div class="panel-heading">
                    <img class="img-reponsive img-rounded" src="../icons/actions/list-add.png" /> Alta Usuario
                </div>
                <div class="panel-body">
                     <form id="fr_nuevo_usuario_ajax" method="POST">
                    <div class="container" style="margin-left:100px">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nombre">Nombre y Apellido:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="dni">DNI:</label>
                                    <input type="text" class="form-control" id="dni" name="dni" maxlength="8" required>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="antiguedad">Antiguedad:</label>
                                    <input type="number" class="form-control" id="antiguedad" name="antiguedad" required>
                                </div>
                            </div>
                            
                             <div class="col-sm-3">
                             <div class="form-group">
                                <label for="revista">Situación de Revista:</label>
                                <select class="form-control" id="revista" name="revista">
                                    <option value="" selected disabled>Seleccionar</option>
                                    <option value="1">Planta Permanente</option>
                                    <option value="2">Ley Marco</option>
                                    <option value="3">Contrato 1109</option>
                                </select>
                                </div> 
                                                              
                                
                            </div>                                 
                        </div>
                        
                        <div class="row">
                        <div class="col-sm-3">
                        <button type="submit" class="btn btn-success" name="guardar_usuario" id="add_nuevo_usuario">
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
* Funcion para agregar usuarios al sistema
*/

function agregarUser($nombre,$dni,$email,$antiguedad,$revista,$conn){
    
    $string_1 = nameValidator($nombre);
    $string_2 = intValidator($dni);
    $string_3 = emailValidator($email);
    $string_4 = intValidator($antiguedad);
    $string_5 = intValidator($revista);
    
    if(($string_1 == 1) && ($string_2 == 1) && ($string_3 == 1) && ($string_4 == 1) && ($string_5 == 1)){
    

	mysqli_select_db($conn,'licor');
	$sql = "insert into agentes ".
        "(nombre,dni,email,antiguedad,situacion_revista)".
        "VALUES ".
        "('$nombre','$dni','$email','$antiguedad','$revista')";
    $query1 = mysqli_query($conn,$sql);
	
	
      // se genera password aleatoria
      $pass = generationPass();
      
      // se encripta el password generado
      $passHash = password_hash($pass, PASSWORD_BCRYPT);
      
      // se determina el permiso basico
      $role = 1;      
      
      // recortamos el email para generar el usuario "usuario@mecon.gov.ar"
      // el usuario deberá quedar con el siguiente formato "usuario_mecon" 
      $dominio = "_mecon";
      $user = substr($email,0,-13);
      $user = $user.$dominio;
      genFile($user,$pass);
        
        $sqlInsert = "INSERT INTO usuarios ".
		"(nombre,user,email,password,role)".
		"VALUES ".
      "('$nombre','$user','$email','$passHash','$role')";
      $query2 = mysqli_query($conn,$sqlInsert);
    
	
	
            if($query1 && $query2){
                echo 1; // se realizó la inserción en la base                
            }else{
                echo -1; // no se realizó la inserción del dato en la base
            }
	    
	    }else{
	    
            echo 2; // alguna de las variables contiene caracteres inválidos
	    
	    }

}


/*
** Funcion para generar password aleatorio
*/

function generationPass(){
    //Se define una cadena de caractares.
    //Os recomiendo desordenar las minúsculas, mayúsculas y números para mejorar la probabilidad.
    $string = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz1234567890@";
    //Obtenemos la longitud de la cadena de caracteres
    $stringLong = strlen($string);
 
    //Definimos la variable que va a contener la contraseña
    $pass = "";
    //Se define la longitud de la contraseña, puedes poner la longitud que necesites
    //Se debe tener en cuenta que cuanto más larga sea más segura será.
    $longPass = 15;
 
    //Creamos la contraseña recorriendo la cadena tantas veces como hayamos indicado
    for($i = 1; $i <= $longPass; $i++){
        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
        $pos = rand(0,$stringLong-1);
 
        //Vamos formando la contraseña con cada carácter aleatorio.
        $pass .= substr($string,$pos,1);
        
    }
    return $pass;
}


/*
** Funcion que actualiza el password de un usuario
*/
function updatePassword($id,$pass,$conn){

    if((strlen($pass) < 15) || (strlen($pass) > 15)){
    
        echo '<div class="container">
                <div class="row">modalUserAllow
                    <div class="col-md-6">
                        <div class="alert alert-danger" role="alert">
                            <img class="img-reponsive img-rounded" src="../icons/status/task-attempt.png" /> El Password no puede contener menos o más de 15 caracteres!!
                        </div>
                    </div>
                </div>
              </div>';
    
    }elseif((strlen($pass)) == 0){
        
        echo '<div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-danger" role="alert">
                            <img class="img-reponsive img-rounded" src="../icons/status/task-attempt.png" /> El Password no puede estar Vacio!!
                        </div>
                    </div>
                </div>
              </div>';
    
    }elseif((strlen($pass)) == 15){
    
        $passHash = password_hash($pass, PASSWORD_BCRYPT);
        
        $sql = "update usuario set password = '$passHash' where id = '$id'";
        $query = mysqli_query($conn,$sql);
        
        if($query){
            echo 1;
        }else{
            echo 0;
        }
    
    }


}


/*
** Funcion para generar archivo de password
*/


function genFile($usuario,$password){
  
  $fileName = "../registro/gen_pass/$usuario.pass.txt"; 
  //$mensaje = $password;
  
  if (file_exists($fileName)){
  
  //echo "Archivo Existente...";
  //echo "Se actualizaran los datos...";
  $file = fopen($fileName, 'w+') or die("Se produjo un error al crear el archivo");
  
  fwrite($file, $password) or die("No se pudo escribir en el archivo");
  
  fclose($file);
	 
  }else{
  
      //echo "Se Generará archivo de respaldo..."
      $file = fopen($fileName, 'w') or die("Se produjo un error al crear el archivo");
      fwrite($file, $password) or die("No se pudo escribir en el archivo");
      fclose($file);
	      
  }
  
  
}


                    
/*
** funcion que valida caracteres especiales
*/
function nameValidator($var){

   $pattern_string = '/^[a-zA-Z0-9áéíóú ]+$/i';
$validate = -1;

if(preg_match($pattern_string,$var)){

    return $validate = 1;

}else{

    return $validate = 0;
}
    
}


/*
** funcion que valida email
*/
function emailValidator($var){

    $pattern_string = '/^[a-zA-Z0-9*._@#]+$/i';

$validate = -1;

if(preg_match($pattern_string,$var)){

    return $validate = 1;

}else{

    return $validate = 0;
}


}


/*
** funcion que valida solo numeros positivos
*/
function intValidator($var){

    $pattern_string = '/^[0-9.-]+$/';

$validate = -1;

if(preg_match($pattern_string,$var)){

    return $validate = 1;

}else{

    return $validate = 0;
}


}


/*
** funcion que valida solo numeros positivos
*/
function passwordValidator($var){

     $pattern_string = '/^[a-zA-Z0-9*._@#!?¿]+$/';

$validate = -1;

if(preg_match($pattern_string,$var)){

    return $validate = 1;

}else{

    return $validate = 0;
}


}



// ============================================================= //
// PERMISOS
/*
* Funcion para cambiar los permisos de los usuarios al sistema
*/

function cambiarPermisos($id,$role,$conn){

  $sql = "UPDATE usuarios set role = '$role' where id = '$id'";
  mysqli_select_db('licor');
  $retval = mysqli_query($conn,$sql);
  if($retval){    
    echo 1;
  }else{
    echo -1;
  }
 
}


/*
** persistencia en la actualizacion de pasword
*/
function changePass($id,$password_1,$password_2,$conn){

   $string_1 = passwordValidator($password_1);
   $string_2 = passwordValidator($password_2);
   
   if(($string_1 == 1) && ($string_2 == 1)){
   
    if((strlen($password_1) == 15) && (strlen($password_2) == 15)){
        
        if((strcmp($password_2,$password_1) == 0)){
        
            $passHash = password_hash($password_1, PASSWORD_BCRYPT); // se procede a encriptar el password
        
        $sql = "update usuarios set password = '$passHash' where id = '$id'";
        mysqli_select_db($conn,'licor');
        $query = mysqli_query($conn,$sql);
        
        if($query){
            echo 1; // password actualizada
        }else{
            echo -1; // error al actualizar el password
        }
        
        }else{
            echo 0; // los password no coinciden
        }
    }else{
        echo 2; // los password no pueden ser menores o mayores a 15 caracteres
    }
    }else{
        echo 3; // caracteres invalidos
    }
    

}

/*
** funcion que carga modal de permisos de usuario
*/
function modalPermisos(){

    echo '<!-- Modal -->
            <div id="modalUserAllow" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <img src="../icons/actions/system-switch-user.png"  class="img-reponsive img-rounded"> Cambiar Permisos de Usuario</h4>
                </div>
                <div class="modal-body">
                    
                    <form id="frm_user_allow" method="POST">
                    <input type="hidden" class="form-control" name="bookId" id="bookId" value="bookId">
                        <div class="form-group">
                            <label for="permisos">Permisos:</label>
                            <select class="form-control" id="permisos" name="permisos">
                                <option value="" selected disabled>Seleccionar</option>
                                <option value="0">Deshabilitar</option>
                                <option value="1">Habilitar</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default" id="cambiar_permiso">
                            <img class="img-reponsive img-rounded" src="../icons/actions/dialog-ok-apply.png" /> Aceptar</button>
                    </form>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <img class="img-reponsive img-rounded" src="../icons/actions/dialog-close.png" /> Cerrar</button>
                </div>
                </div>

            </div>
            </div>';

}

/*
** funcion que carga modal para cambio de password
*/
function modalChangePassword(){

    echo '<!-- Modal -->
            <div id="modalChangePass" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <img src="../icons/actions/view-refresh.png"  class="img-reponsive img-rounded"> Cambiar Password</h4>
                </div>
                <div class="modal-body">
                    
                     <form id="frm_change_password" method="POST">
                     <input type="hidden" class="form-control" name="bookId" id="bookId" value="bookId">
                        <div class="form-group">
                            <label for="password_1">Password:</label>
                            <input type="password" class="form-control" id="password_1" name="password_1" required>
                        </div>
                        <div class="form-group">
                            <label for="password_2">Repita Password:</label>
                            <input type="password" class="form-control" id="password_2" name="password_2" requiered>
                        </div>
                        <button type="submit" class="btn btn-default" id="change_password">
                            <img class="img-reponsive img-rounded" src="../icons/actions/dialog-ok-apply.png" /> Cambiar</button>
                        </form> 
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <img class="img-reponsive img-rounded" src="../icons/actions/dialog-close.png" /> Cerrar</button>
                </div>
                </div>

            </div>
            </div>';

}


?>
