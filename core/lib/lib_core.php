<?php

/*
** Funcion que carga el skeleto del sistema
*/

function skeleton(){

  echo '<link rel="stylesheet" href="/licencias/skeleton/css/bootstrap.min.css" >
	<link rel="stylesheet" href="/licencias/skeleton/css/bootstrap-theme.css" >
	<link rel="stylesheet" href="/licencias/skeleton/css/bootstrap-theme.min.css" >
	<link rel="stylesheet" href="/licencias/skeleton/css/scrolling-nav.css" >
	<link rel="stylesheet" href="/licencias/skeleton/css/fontawesome.css">
	<link rel="stylesheet" href="/licencias/skeleton/css/fontawesome.min.css" >
	<link rel="stylesheet" href="/licencias/skeleton/css/jquery.dataTables.min.css" >
	<link rel="stylesheet" href="/licencias/skeleton/Chart.js/Chart.min.css" >
	<link rel="stylesheet" href="/licencias/skeleton/Chart.js/Chart.css" >
	
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="/licencias/skeleton/js/jquery-3.4.1.min.js"></script>
	<script src="/licencias/skeleton/js/bootstrap.min.js"></script>
	
	<script src="/licencias/skeleton/js/jquery.dataTables.min.js"></script>
	<script src="/licencias/skeleton/js/dataTables.editor.min.js"></script>
	<script src="/licencias/skeleton/js/dataTables.select.min.js"></script>
	<script src="/licencias/skeleton/js/dataTables.buttons.min.js"></script>
	
	<script src="/licencias/js/scrolling-nav.js"></script>
	<script src="/licencias/skeleton/Chart.js/Chart.min.js"></script>
	<script src="/licencias/skeleton/Chart.js/Chart.bundle.min.js"></script>
	<script src="/licencias/skeleton/Chart.js/Chart.bundle.js"></script>
	<script src="/licencias/skeleton/Chart.js/Chart.js"></script>';
}



/*
** Funcion que elimina un registro
*/

function delUser($id,$conn){

		
	mysqli_select_db('licor');
	$sql = "delete from usuarios where id = '$id'";
           
	$res = mysqli_query($conn,$sql);


	if($res){
		//mysqli_query($conn,$sqlInsert);
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-success" role="alert">';
		echo 'Registro Eliminado Exitosamente. Aguarde un Instante que será Redireccionado';
		echo "</div>";
		echo "</div>";	
	}else{
		echo "<br>";
		echo '<div class="container">';
		echo '<div class="alert alert-warning" role="alert">';
		echo "Hubo un error al Eliminar el Registro!. Aguarde un Instante que será Redireccionado" .mysqli_error($conn);
		echo "</div>";
		echo "</div>";
	}
}



function usuarios($conn){

if($conn)
{
	$sql = "SELECT * FROM usuarios";
    	mysqli_select_db('licor');
    	$resultado = mysqli_query($conn,$sql);
	//mostramos fila x fila
	$count = 0;
	echo '<div class="panel panel-success" >
	      <div class="panel-heading"><span class="pull-center "><img src="../../icons/actions/user-group-properties.png"  class="img-reponsive img-rounded"> Usuarios';
	echo '</div><br>';

            echo "<table class='display compact' style='width:100%' id='myTable'>";
              echo "<thead>
		    <th class='text-nowrap text-center'>ID</th>
		    <th class='text-nowrap text-center'>Nombre</th>
                    <th class='text-nowrap text-center'>Usuario</th>
                    <th class='text-nowrap text-center'>Role</th>
                    <th>&nbsp;</th>
                    </thead>";


	while($fila = mysqli_fetch_array($resultado)){
			  // Listado normal
			 echo "<tr>";
			 echo "<td align=center>".$fila['id']."</td>";
			 echo "<td align=center>".$fila['nombre']."</td>";
			 echo "<td align=center>".$fila['user']."</td>";
			 echo "<td align=center>".$fila['role']."</td>";
			 echo "<td class='text-nowrap'>";
			 echo '<a href="../usuarios/edit.php?id='.$fila['id'].'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> Editar</a>';
			 echo '<a href="#" data-href="../usuarios/eliminar.php?id='.$fila['id'].'" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Borrar</a>';
			 echo "</td>";
			 $count++;
		}

		echo "</table>";
		echo "<br>";
		echo '<a href="../usuarios/nuevoRegistro.php"><button type="button" class="btn btn-default"><span class="pull-center "><img src="../../icons/actions/list-add.png"  class="img-reponsive img-rounded"> Agregar Usuario</button></a><br><hr>';
		echo '<button type="button" class="btn btn-primary">Cantidad de Registros:  ' .$count; echo '</button>';
		echo '</div>';
		}else{
		  echo 'Connection Failure...';
		}

    mysqli_close($conn);

}



/*
** Funcion de validación de ingreso
*/
function logIn($user,$pass,$conn){

    mysqli_select_db('licor');
    
	$_SESSION['user'] = $user;
	$_SESSION['pass'] = $pass;
	
	$sql_1 = "select password from usuarios where user = '$user'";
	$query_1 = mysqli_query($conn,$sql_1);
	while($row = mysqli_fetch_array($query_1)){
        $hash = $row['password'];
	}
	
    
    
	$sql = "SELECT * FROM usuarios where user='$user' and role = 1";
	$q = mysqli_query($conn,$sql);
	
	$query = "SELECT * FROM usuarios where user='$user' and role = 0";
	$retval = mysqli_query($conn,$query);
	
	
	
	if(!$q && !$retval){	
			echo '<div class="alert alert-danger" role="alert">';
			echo "Error de Conexion..." .mysqli_error($conn);
			echo "</div>";
			echo '<a href="index.php"><br><br><button type="submit" class="btn btn-primary">Aceptar</button></a>';	
			exit;			
			
			}
		
			if(($user = mysqli_fetch_assoc($retval)) && (password_verify($pass,$hash))){
				

				echo '<div class="alert alert-danger" role="alert">';
				echo "<strong>Atención!  </strong>" .$_SESSION["user"];
				echo "<br>";
				echo '<span class="pull-center "><img src="core/icons/status/security-low.png"  class="img-reponsive img-rounded"><strong> Usuario Bloqueado. Contacte al Administrador.</strong>';
				echo "</div>";
				exit;
			}

			else if(($user = mysqli_fetch_assoc($q)) && (password_verify($pass,$hash))){

				if(strcmp($_SESSION["user"], 'root') == 0){

				echo "<br>";
				echo '<div class="alert alert-success" role="alert">';
				echo '<button class="btn btn-success">
				      <span class="spinner-border spinner-border-sm"></span>
				      </button>';
				echo "<strong> Bienvenido!  </strong>" .$_SESSION["user"];
				echo "<strong> Aguarde un Instante...</strong>";
				echo "<br>";
				echo "</div>";
  				echo '<meta http-equiv="refresh" content="5;URL=core/main/main.php "/>';
				
			}else{
				echo '<div class="alert alert-success" role="alert">';
				echo '<button class="btn btn-success">
				      <span class="spinner-border spinner-border-sm"></span>
				      </button>';
				echo "<strong> Bienvenido!  </strong>" .$_SESSION["user"];
				echo "<strong> Aguarde un Instante...</strong>";
				echo "<br>";
				echo "</div>";
  				echo '<meta http-equiv="refresh" content="5;URL=core/main/main.php "/>';
				
			}
			}else{
				echo '<div class="alert alert-danger" role="alert">';
				echo '<span class="pull-center "><img src="core/icons/status/dialog-warning.png"  class="img-reponsive img-rounded"> Usuario o Contraseña Incorrecta. Reintente Por Favor....';
				echo "</div>";
				}
}


/*
** Funcion que carga el menú principal
*/
function rootMain($nombre){

    echo ' <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h4 class="panel-title" align="center">
                    <a data-toggle="collapse" href="#collapse1" data-toggle="tooltip" title="Click para Comenzar">
                        <img src="../icons/categories/preferences-desktop.png"  class="img-reponsive img-rounded"> Menú Principal</a>
                </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                
                <form action="#" method="POST">
                <ul class="list-group">
                
                    <li class="list-group-item">
                        <button type="submit" class="btn btn-default btn-xs btn-block" name="mis_datos" data-toggle="tooltip" title="Visualizar y Editar Datos Personales">
                            <img src="../icons/actions/address-book-new.png"  class="img-reponsive img-rounded"> Mis Datos</button>
                    </li>
                    
                    <li class="list-group-item">
                        <button type="submit" class="btn btn-default btn-xs btn-block" name="usuarios" data-toggle="tooltip" title="Listar todos los Usuarios, Altas y Modificaciones">
                            <img src="../icons/actions/meeting-attending.png"  class="img-reponsive img-rounded"> Usuarios</button>
                    </li>
                    
                    <li class="list-group-item">
                        <button type="submit" class="btn btn-default btn-xs btn-block" name="agentes" data-toggle="tooltip" title="Listar todos los Agentes y Modificar">
                            <img src="../icons/actions/view-ldap-resource.png"  class="img-reponsive img-rounded"> Agentes</button>
                    </li>
                    
                    <li class="list-group-item">
                        <button type="submit" class="btn btn-default btn-xs btn-block" name="licencias" data-toggle="tooltip" title="Listar todas las Licencias tomadas por Agentes, Agregar, Editar, Borrar">
                            <img src="../icons/actions/view-calendar-month.png"  class="img-reponsive img-rounded"> Licencias</button>
                    </li>  
                    
                    <li class="list-group-item">
                        <button type="submit" class="btn btn-default btn-xs btn-block" name="tipo_licencia" data-toggle="tooltip" title="Listar todos los tipos de licencias existentes">
                            <img src="../icons/actions/view-calendar-upcoming-events.png"  class="img-reponsive img-rounded"> Tipo Licencias</button>
                    </li>
                
                </ul>
                </form>
                
                <div class="panel-footer">
                <form action="#" method="POST">
                    <button type="submit" class="btn btn-danger btn-sm btn-block" name="salir" data-toggle="tooltip" title="Salir del Sistema">
                        <img src="../icons/actions/system-shutdown.png"  class="img-reponsive img-rounded"> Salir</button>
                </form>
                </div>
                </div>
                
            </div>
            </div>';

}


function userMain($nombre){

    echo ' <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#collapse1" data-toggle="tooltip" title="Click para Comenzar">
                        <img src="../icons/categories/preferences-desktop.png"  class="img-reponsive img-rounded"> Menú Principal</a>
                </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                <form action="#" method="POST">
                <ul class="list-group">
                
                    <li class="list-group-item">
                        <button type="submit" class="btn btn-default btn-xs btn-block" name="mis_datos" data-toggle="tooltip" title="Visualizar y Editar Datos Personales">
                            <img src="../icons/actions/address-book-new.png"  class="img-reponsive img-rounded"> Mis Datos</button>
                    </li>
                    
                    <li class="list-group-item">
                        <button type="submit" class="btn btn-default btn-xs btn-block" name="mis_licencias" data-toggle="tooltip" title="Listar todas las Licencias, Agregar, Editar, Borrar">
                            <img src="../icons/actions/view-calendar-month.png"  class="img-reponsive img-rounded"> Mis Licencias</button>
                    </li>                    
                
                </ul>
                </form>
                
                <div class="panel-footer">
                <form action="#" method="POST">
                    <button type="submit" class="btn btn-danger btn-xs btn-block" name="salir" data-toggle="tooltip" title="Salir del Sistema">
                        <img src="../icons/actions/system-shutdown.png"  class="img-reponsive img-rounded"> Salir</button>
                </form>
                </div>
                </div>
                
            </div>
            </div>';


}


?>
