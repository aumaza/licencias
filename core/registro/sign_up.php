<?php include "../connection/connection.php"; 
      include "../functions/functions.php";
      
       $entorno = $_GET['entorno'];
       
       if($entorno == 'VP'){
            $descripcion = "Venta de Productos";
       }
       if($entorno == 'TG'){
            $descripcion = "Turnos Gabinete";
       }
       if($entorno == 'TE'){
            $descripcion = "Alquiler de Equipos";
       }
       if($entorno == 'VE'){
            $descripcion = "Venta de Equipos";
       }
       if($entorno == 'CA'){
            $descripcion = "Capacitación";
       }
?>

<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SM Bienestar - Registro de Usuario</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../../#"><img class="img-reponsive img-rounded" src="../icons/actions/go-home.png" /> Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="bg-primary text-white">
    <div class="container text-center">
    <p><img src="../../img/logo.png" class="img-rounded" alt="Random Name" width="180" height="50"></p><hr>
      <h1>Bienvenido/a al registro de Usuario</h1>
      <p class="lead">A continuación le solicitaremos algunos datos que luego le posibilitarán operar dentro de la Web-App.</p><hr>
      <p><strong><img class="img-reponsive img-rounded" src="../icons/status/task-attempt.png" /> Sólo es necesario que se Registre en uno de los Entornos, luego si quiere darse de alta en los restantes lo podrá realizar desde el Panel de Control del usuario, cuando ingrese.</strong></p><hr>
      <p class="lead"><img class="img-reponsive img-rounded" src="../icons/emotes/face-smile.png" /> Comenzamos!?</p>
    </div>
  </header>
  <?php
  
  
  if($conn){
      
   if(isset($_POST['A'])){
  
  
  $nombre = mysqli_real_escape_string($conn,$_POST['nombre']);
  $dni = mysqli_real_escape_string($conn,$_POST['dni']);
  $direccion = mysqli_real_escape_string($conn,$_POST['direccion']);
  $direccion1 = mysqli_real_escape_string($conn,$_POST['direccion1']);
  $direccion2 = mysqli_real_escape_string($conn,$_POST['direccion2']);
  $tel = mysqli_real_escape_string($conn,$_POST['tel']);
  $movil = mysqli_real_escape_string($conn,$_POST['movil']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password1 = mysqli_real_escape_string($conn,$_POST['password1']);
  $password2 = mysqli_real_escape_string($conn,$_POST['password2']);
  $entorno = mysqli_real_escape_string($conn,$_POST['entorno']);
  $role = 1;
  
  if(strlen($password1) <= 15 || strlen($password2) <= 15){
    
    if(strcmp($password2,$password1) == 0){
        
        
        addUser($nombre,$password1,$email,$role,$entorno,$conn);
        addCliente($nombre,$dni,$direccion,$direccion1,$direccion2,$tel,$movil,$email,$conn);
        
        }else{
        
                echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../icons/status/task-attempt.png" /> Las Contraseñas no Coinciden. Intente Nuevamente!.';
			    echo "</div>";
			    echo "</div>";
        }
    }else{
        
                echo "<br>";
			    echo '<div class="container">';
			    echo '<div class="alert alert-warning" role="alert">';
			    echo '<img class="img-reponsive img-rounded" src="../icons/status/task-attempt.png" />El Password supera los 15 caracteres! Reintentelo.';
			    echo "</div>";
			    echo "</div>";
        
    }
  }
  }else{
  
    mysqli_error($conn);
  
  }
  
  
  ?>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
         <h2>Formulario de Registro</h2><hr>
        
        <div class="container">
		<div class="alert alert-warning" role="alert">
         <p><img class="img-reponsive img-rounded" src="../icons/status/task-attempt.png" /> Usted está por realizar el Registro para el Entorno: <strong><?php echo $descripcion; ?></strong></p>
         <p>Si no es el correcto, presione el botón "Home" ubicado en la barra superior y vuelva a seleccionar el entorno en el que desea realizar el registro.</p>
         </div></div>
         
         <div class="container">
            <div class="alert alert-info" role="alert">
          <p><img class="img-reponsive img-rounded" src="../icons/status/dialog-information.png" /><strong> Importante:</strong></p>
          <p>Respete las mayúsculas al inicio de Nombres y Apellidos como también en la Dirección.</p>
          </div></div>
          
          <div class="container">
            <form action="sign_up.php" method="POST">
            <input type="hidden" id="entorno" name="entorno" value="<?php echo $entorno ?>">
            
                
                <div class="form-group">
                <label for="email">Nombre y Apellido:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su Nombre y Apellido" required>
                </div>
                
                <div class="form-group">
                <label for="email">DNI:</label>
                <input type="text" class="form-control" id="dni" placeholder="Ingrese DNI sin separar por puntos" name="dni" required>
                </div>
                
                <div class="form-group">
                <label for="email">Dirección:</label>
                <input type="text" class="form-control" id="direccion" placeholder="Ingrese su Dirección" name="direccion" required>
                </div><hr>             
                
                
                <h1>Para Clientes de Alquiler de Equipos</h1>
                <p>En caso de tener más de una Dirección, complete las siguientes.</p>
                
                <div class="form-group">
                <label for="email">Dirección (2):</label>
                <input type="text" class="form-control" id="direccion1" placeholder="Ingrese Dirección Alternativa 2" name="direccion1">
                </div>
                
                <div class="form-group">
                <label for="email">Dirección (3):</label>
                <input type="text" class="form-control" id="direccion2" placeholder="Ingrese Dirección Alternativa 3" name="direccion2">
                </div><hr>
                
                <div class="form-group">
                <label for="email">Tel:</label>
                <input type="text" class="form-control" id="tel" placeholder="Ingrese su Teléfono sin separar por guiones" name="tel" required>
                </div>
                
                <div class="form-group">
                <label for="email">Móvil:</label>
                <input type="text" class="form-control" id="movil" placeholder="Ingrese su Celular sin separar por guiones" name="movil" required>
                </div>
                
                <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Ingrese su email" name="email" required>
                </div>
                               
                <h2>Datos de Usuario</h2><hr>
                
                <div class="container">
                <div class="alert alert-success" role="alert">
                <p><img class="img-reponsive img-rounded" src="../icons/actions/games-hint.png" /><strong> Consejo:</strong> Utilice mayúsculas y minusculas combinado con números para una contraseña segura. 
                <p><strong>No es aconsejable usar fechas de cumpleaños o datos personales.</strong></p>
                </div></div>
                
                <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Ingrese password (máximo 15 caracteres)" name="password1" required>
                </div>
                
                <div class="form-group">
                <label for="pwd">Repita Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Repita password (máximo 15 caracteres)" name="password2" required>
                </div><hr>
                
                </div>
                <button type="submit" class="btn btn-success btn-block" name="A">Aceptar</button>
                <button type="reset" class="btn btn-primary btn-block">Limpiar</button>
            </form>
        </div>
          
          
        </div>
      </div>
    </div>
  </section>

  
  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
     <p class="m-0 text-center text-white small">Desarrollo: DevelSlack</p>
      <p class="m-0 text-center text-white small">Contacto: <a href="mailto:develslack@gmail.com">develslack@gmail.com</a></p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>

</body>

</html>
