<?php   session_start();
        include "core/connection/connection.php"; 
        include "core/lib/lib_core.php";
?>
      
<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="icons/actions/view-pim-tasks.png" />
  <meta name="description" content="">
  <meta name="author" content="">
  

  <title>Licor - Sistema de Administración de Licencias Ordinarias</title>

  <!-- Bootstrap core CSS -->
  <link href="/licencias/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="/licencias/css/scrolling-nav.css" rel="stylesheet">
    <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="core/registro/reset_password.php" data-toggle="tooltip" data-placement="botton" title="Ingrese aquí para blanquear su Password"><img class="img-reponsive img-rounded" src="core/icons/status/task-attempt.png" /> Olvidé mi Password</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
    </div>
  </nav>

  <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Bienvenidos/as al Sistema de Administración de Licencias Ordinarias</h1><hr>
      
      <p class="lead">Sistema de Administración de Licencias Ordinarias - LICOR</p>
    </div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
        
         <?php
         
         if($conn){
         
	  if(isset($_POST['A'])){
         
	$user = mysqli_real_escape_string($conn,$_POST["user"]);
	$pass = mysqli_real_escape_string($conn,$_POST["pass"]);
	logIn($user,$pass,$conn);
	
	}
	}else{
        mysqli_error($conn);
	}
	
	//cerramos la conexion
	
	mysqli_close($conn);
	
	
           
      ?>
        
        <h1>Ingresar</h1><hr>
          <form action="index.php" method="POST">
	    <div class="form-group">
	      <label for="usuario">Usuario:</label>
	      <input style="text-align: center" type="text" class="form-control" id="usuario" name="user" required>
	    </div>
	    <div class="form-group">
	      <label for="pwd">Password:</label>
	      <input style="text-align: center" type="password" class="form-control" id="pwd" name="pass" required>
	    </div>
	    <button type="submit" name="A" class="btn btn-primary btn-block">Ingresar</button><br>
	    <button type="reset" class="btn btn-danger btn-block">Borrar</button>
	  </form> 
        </div>
      </div>
    </div>
  </section>

 

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white"><img class="img-reponsive img-rounded" src="img/escudo32x32.png" /> Ministerio de Economía de la Nación - Dirección de Presupuesto y Evaluación de Gastos en Personal</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="/licencias/vendor/jquery/jquery.min.js"></script>
  <script src="/licencias/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="/licencias/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="/licencias/js/scrolling-nav.js"></script>

</body>

</html>
