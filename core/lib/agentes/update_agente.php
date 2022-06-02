<?php session_start();
        include "../../connection/connection.php";
        include "lib_agentes.php";
        include "../usuarios/lib_usuarios.php";
                        
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        $nombre = mysqli_real_escape_string($conn,$_POST['nombre']);
        $dni = mysqli_real_escape_string($conn,$_POST['dni']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $antiguedad = mysqli_real_escape_string($conn,$_POST['antiguedad']);
        $revista = mysqli_real_escape_string($conn,$_POST['revista']);
        updateAgente($id,$nombre,$dni,$email,$antiguedad,$revista,$conn,$dbase);
        
        
  
?>
