<?php session_start();
      include "../connection/connection.php";
      include "../lib/lib_core.php";
      include "../lib/lib_usuarios.php";
      include "../lib/lib_agentes.php";
      include "../lib/lib_licencias.php";
           
      $usuario = $_SESSION['user'];
            
         
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
  <?php skeleton(); ?>
  
  <style>
    
    textarea {
    overflow: scroll;
    resize: none;
    }
  
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 700px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 10px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 700px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
  </style>

<script src="main.js"></script>

<!-- Guardar nuevo usuario -->
<script type="text/javascript">
$(document).ready(function(){
    $('#add_nuevo_usuario').click(function(){
        var datos=$('#fr_nuevo_usuario_ajax').serialize();
        $.ajax({
            type:"POST",
            url:"../lib/add_nuevo_usuario.php",
            data:datos,
            success:function(r){
                if(r==1){
                    alert("Agente y Usuario Creado Exitosamente!!");
                    $('#nombre').val('');
                    $('#dni').val('');
                    $('#email').val('');
                    $('#antiguedad').val('');
                    $('#revista').val('');
                    $('#nombre').focus();
                }else if(r==-1){
                    alert("Hubo un problema al intentar Crear el Agente y el Usuario");
                    console.log("Datos: " + datos);
                }else if(r==2){
                    alert("Hay campos en los cuales ingresó caracteres no válidos");
                    console.log("Datos: " + datos);
                }else if(r == 3){
                    alert("No ha ingresado datos aún!!");
                }
            }
        });

        return false;
    });
});
</script>

<!-- Guardar nuevo tipo de licencias -->
<script type="text/javascript">
$(document).ready(function(){
    $('#add_tipo_licencia').click(function(){
        var datos=$('#fr_nuevo_tipo_licencia_ajax').serialize();
        $.ajax({
            type:"POST",
            url:"../lib/add_nuevo_tipo_licencia.php",
            data:datos,
            success:function(r){
                if(r==1){
                    alert("Tipo de Licencia Agregada Exitosamente!!");
                    $('#clase_licencia').val('');
                    $('#descripcion').val('');
                    $('#articulo').val('');
                    $('#revista').val('');
                    $('#tiempo').val('');
                    $('#goce_haberes').val('');
                    $('#obligatoriedad').val('');
                    $('#particularidad').val('');
                    $('#clase_licencia').focus();
                }else if(r==-1){
                    alert("Hubo un problema al intentar agregar el tipo de licencia");
                    console.log("Datos: " + datos);
                }else if(r==2){
                    alert("Hay campos en los cuales ingresó caracteres no válidos");
                    console.log("Datos: " + datos);
                }else if(r == 3){
                    alert("No ha ingresado datos aún!!");
                }
            }
        });

        return false;
    });
});
</script>


<!-- Actualizar Agente -->
<script type="text/javascript">
$(document).ready(function(){
    $('#edit_agente').click(function(){
        var datos=$('#fr_actualizar_agente_ajax').serialize();
        $.ajax({
            type:"POST",
            url:"../lib/update_agente.php",
            data:datos,
            success:function(r){
                if(r==1){
                    alert("Agente Actualizado Exitosamente!!");
                    console.log("Datos: " + datos);
                    document.location.href="main.php";
                }else if(r==-1){
                    alert("Hubo un problema al intentar Actualizar el Agente");
                    console.log("Datos: " + datos);
                }else if(r==2){
                    alert("Hay campos en los cuales ingresó caracteres no válidos");
                    console.log("Datos: " + datos);
                }
            }
        });

        return false;
    });
});
</script>

<!-- Cambiar Permiso usuario -->
<script type="text/javascript">
$(document).ready(function(){
    $('#cambiar_permiso').click(function(){
        var datos=$('#frm_user_allow').serialize();
        $.ajax({
            type:"POST",
            url:"../lib/cambiar_permiso_usuario.php",
            data:datos,
            success:function(r){
                if(r==1){
                    alert("Permiso de Usuario Cambiado Exitosamente!!");
                     window.location.reload();
                }else if(r==-1){
                    alert("Hubo un problema al intentar cambiar el Permiso de Usuario");
                }
            }
        });

        return false;
    });
});
</script>

<!-- Cambiar Password usuario -->
<script type="text/javascript">
$(document).ready(function(){
    $('#change_password').click(function(){
        var datos=$('#frm_change_password').serialize();
        $.ajax({
            type:"POST",
            url:"../lib/change_password.php",
            data:datos,
            success:function(r){
                if(r == 1){
                    alert("Password Actualizada Exitosamente!!");
                     window.location.reload();
                }else if(r == -1){
                    alert("Hubo un problema al intentar actualizar el Password");
                }else if(r == 0){
                    alert("Los Password no Conciden");
                    console.log("Datos: " + datos);
                }else if(r == 2){
                    alert("El password no puede tener menos o más de 15 caracteres");
                    console.log("Datos: " + datos);
                }else if(r == 3){
                    alert("El password contiene caracteres no válidos");
                    console.log("Datos: " + datos);
                }
                
            }
        });

        return false;
    });
});
</script>
  
<script>
$(document).ready(function(){
      $('#myTable').DataTable({
      "order": [[1, "asc"]],
      "responsive": true,
      "scrollY":        "300px",
        "scrollX":        true,
        "scrollCollapse": true,
        "paging":         true,
        "fixedColumns": true,
      "language":{
        "lengthMenu": "Mostrar _MENU_ registros por pagina",
        "info": "Mostrando pagina _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrada de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search": "Buscar:",
        "zeroRecords":    "No se encontraron registros coincidentes",
        "paginate": {
          "next":       "Siguiente",
          "previous":   "Anterior"
        },
      }
    });

  });

</script>
  
 
  
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-2 sidenav"><br>
      
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
      <h4>Bienvenido/a <strong><?php echo $nombre; ?></strong></h4>
      
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
      }
      
      if(isset($_POST['eliminar_licencia'])){
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        formEliminarLicencia($id,$conn);
      }
      
      
      // ====================================== //
      // TIPO DE LICENCIAS
      if(isset($_POST['tipo_licencia'])){
        listarTipoLicencia($conn);
      }
      if(isset($_POST['new_tipo_licencia'])){
        formAltaTipoLicencia();
      }
      
      
      }else{
            echo "No se pudo completar la conexion con la Base de Datos. Contacte al Administrador" .mysqli_error($conn);
        }
      
      
      ?>
      
    </div>
  </div>
</div>

<script type="text/javascript" src="../lib/lib_licencias.js"></script>

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
