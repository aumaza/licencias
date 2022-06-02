<?php include "../connection/connection.php";
      include "lib/lib_regestry.php";

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="icon" type="image/png" href="../icons/status/task-recurring.png" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Recuperación de Password</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"><img class="img-reponsive img-rounded" src="../icons/status/appointment-recurring.png" /> Recuperar Password</h3></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted">Ingrese su usuario para poder blanquear su Password.</div>
                                        
                                        <form action="reset_password.php" method="POST">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Usuario</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" aria-describedby="emailHelp" name="user" placeholder="usuario_organismo" />
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                               <button type="submit" class="btn btn-primary btn-sm btn-block" name="A"><img class="img-reponsive img-rounded" src="../icons/apps/accessories-text-editor.png" /> Blanquear Password</button><hr>
                                            </div>
                                        </form>
                                    
                                    </div>
                                    <div class="card-footer text-center">
                                    
                                        <?php
                                        if($conn){
					  
					  if(isset($_POST['A'])){
					    mysqli_select_db('licor');
					    $usuario = mysqli_real_escape_string($conn, $_POST['user']);
					    if(empty($usuario)){
					      echo "<br>";
					      echo '<div class="container">';
					      echo '<div class="alert alert-warning" role="alert">';
					      echo '<p><img class="img-reponsive img-rounded" src="../icons/status/task-attempt.png" /> Debe ingresar un usuario!</p>';
					      echo "</div>";
					      echo "</div>";
					    }else{
						resetPass($conn,$usuario,$dbase);
					    }
                                          }
                                          }else{
					      mysqli_error($conn);
                                          }
                                        
                                        mysqli_close($conn);
                                        
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div><br>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                        <a href="../../#"><button class="btn btn-success navbar-btn"><img class="img-reponsive img-rounded" src="../icons/status/dialog-password.png" /> Iniciar Sesión</button></a>
                            <button class="btn btn-default navbar-btn"><img class="img-reponsive img-rounded" src="../icons/apps/clock.png" /> <?php echo "<strong>Hora Actual:</strong> " . date("H:i"); ?></button>
			      <?php setlocale(LC_ALL,"es_ES"); ?>
				<button class="btn btn-default navbar-btn"><img class="img-reponsive img-rounded" src="../icons/actions/view-calendar-day.png" /> <?php echo "<strong>Fecha Actual:</strong> ". strftime("%d de %b de %Y"); ?></button>
                           </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
