<?php session_start();
      ini_set('display_errors', 1);
      include "../connection/connection.php";
      include "../lib/lib_core.php";
      include "../lib/lib_usuarios.php";
      include "../lib/lib_agentes.php";
      include "../lib/lib_licencias.php";
           
      $usuario = $_SESSION['user'];
            
      $user_agent = $_SERVER['HTTP_USER_AGENT'];
      
      
$sql = "select nombre from usuarios where user = '$usuario'";
mysqli_select_db($conn,'licor');
$query = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($query)){
    $nombre = $row['nombre'];
}

    if($usuario == null || $usuario == ''){
 
    echo '<!DOCTYPE html>
            <html lang="es">
            <head>
            <title>Administración de Licencias</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" type="image/png" href="../../../img/img-favicon32x32.png" />';
            skeleton();
            echo '</head><body>';
            echo '<br><div class="container">
                    <div class="alert alert-danger" role="alert">';
            echo '<p align="center"><img src="../icons/status/task-attempt.png"  class="img-reponsive img-rounded"> '.$usuario.' Su sesión a caducado. Por favor, inicie sesión nuevamente</p>';
            echo '<a href="../../logout.php"><hr><button type="buton" class="btn btn-default btn-block"><img src="../icons/status/dialog-password.png"  class="img-reponsive img-rounded"> Iniciar</button></a>';	
            echo "</div></div>";
            die();
            echo '</body></html>';
}
      
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Administración de Licencias Ordinarias</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="main.css" >
  <?php skeleton(); ?>

<script src="main.js"></script>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
 
  
</head>
<body style="background-color: #566573;" onload="nobackbutton();">

<div class="container-fluid"><hr>
  <div class="row content">
    <div class="col-sm-2 sidenav"><br><br><br>
      
      <?php
      
        if($conn){
        // ====================================== //
        // LIMPIAR ESPACIO DE TRABAJO
        if(isset($_POST['home'])){
            echo '<meta http-equiv="refresh" content="URL=main.php"/>';
        }
        // ====================================== //
        // CARGA DE MENU PRINCIPAL
        if($usuario == 'root'){
            rootMain($nombre);        
        }else{
            userMain($nombre);
        }
        
        // ======================================= //
        //LOG-OUT
        if(isset($_POST['salir'])){
            echo '<meta http-equiv="refresh" content="4;URL=../../logout.php"/>';
        }
        
        
        }else{
            echo "No se pudo completar la conexion con la Base de Datos. Contacte al Administrador" .mysqli_error($conn);
        }
      
            
      ?>
      
    </div>

<!-- Espacio de trabajo  -->
    <div class="col-sm-10"><br>
      <h4 style="color: white;">Bienvenido/a <strong><?php echo $nombre; ?></strong></h4>
      <?php messageBrowser($user_agent); ?>
      
      <form action="#" method="POST">
      <p align="right">
        <button type="submit" class="btn btn-default btn-sm" name="home" data-toggle="tooltip" title="Limpiar Espacio de trabajo"><img src="../icons/actions/go-home.png"  class="img-reponsive img-rounded"></button>
      </p>
      </form>
      <hr>
      
      <?php
      
      if($conn){
      
      // ====================================== //
      // ADMINSTRACION DE USUARIOS
      if(isset($_POST['usuarios'])){
        listarUsuarios($conn);
      }
      // FORMULARIO ALTA USUARIO
      if(isset($_POST['new_user'])){
        formAltaUsuarios();
      }
      if(isset($_POST['mis_datos'])){
        loadUser($conn,$nombre);
      }
      
      // ====================================== //
      // ADMINSTRACION DE AGENTES
      if(isset($_POST['agentes'])){
        listarAgentes($conn);
      }
      if((isset($_POST['editar_agente'])) || (isset($_POST['editar_datos_personales']))) {
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        formEditAgente($id,$name,$conn);
      }
      // ====================================== //
      // ADMINSTRACION DE LICENCIAS
      modalSelAgente($conn);
      
      if((isset($_POST['licencias'])) || (isset($_POST['mis_licencias']))){
        licencias($nombre,$conn);
      }
      if(isset($_POST['select_agente'])){
        $nombre = mysqli_real_escape_string($conn,$_POST['agente']);
        $tipo_licencia = mysqli_real_escape_string($conn,$_POST['clase_licencia']);
        $descripcion = mysqli_real_escape_string($conn,$_POST['descripcion']);
        
            if($tipo_licencia == 'Licencia Ordinaria'){
                formNuevaLicencia($nombre,$descripcion,$conn);
            }
            if($tipo_licencia == 'Inasistencias'){
                formNuevaLicencia($nombre,$descripcion,$conn);
            }if($tipo_licencia == 'Franquicias'){
                formNuevaLicencia($nombre,$descripcion,$conn);
            }if($tipo_licencia == 'Licencias Especiales'){
                formNuevaLicencia($nombre,$descripcion,$conn);
            }
      }
      
      if(isset($_POST['eliminar_licencia'])){
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        formEliminarLicencia($id,$conn);
      }
      if(isset($_POST['more_info'])){
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        formInfoLicencias($id,$conn);
      }
      if(isset($_POST['upload_comprobante'])){
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        formSubirComprobante($id,$conn);
      }
      if(isset($_POST['subir_comprobante'])){
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        $file = basename($_FILES["file"]["name"]);
        insertComprobante($id,$file,$conn);
      }
      
      
      // ====================================== //
      // TIPO DE LICENCIAS
      if(isset($_POST['tipo_licencia'])){
        listarTipoLicencia($conn);
      }
      if(isset($_POST['new_tipo_licencia'])){
        formAltaTipoLicencia();
      }
      if(isset($_POST['editar_tipo_licencia'])){
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        formEditTipoLicencia($id,$conn);
      }
      
      
      }else{
            echo "No se pudo completar la conexion con la Base de Datos. Contacte al Administrador" .mysqli_error($conn);
        }
      
      
      ?>
      
    </div>
  </div>
</div>

<script type="text/javascript" src="../lib/lib_licencias.js"></script>
<script type="text/javascript" src="../lib/lib_usuarios.js"></script>


<script>
  $(document).ready(function(e) {
  $('#modalUserAllow').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data().id;
    $(e.currentTarget).find('#bookId').val(id);
  });
});
  </script>
  
<script>
  $(document).ready(function(e) {
  $('#modalChangePass').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data().id;
    $(e.currentTarget).find('#bookId').val(id);
  });
});
  </script>


  
<?php modalPermisos(); ?>
<?php modalChangePassword(); ?>

</body>
</html>
