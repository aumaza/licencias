<?php session_start();
        include "../../connection/connection.php";
        include "lib_usuarios.php";
                        
                                
        $nombre = mysqli_real_escape_string($conn,$_POST['nombre']);
        $dni = mysqli_real_escape_string($conn,$_POST['dni']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $antiguedad = mysqli_real_escape_string($conn,$_POST['antiguedad']);
        $revista = mysqli_real_escape_string($conn,$_POST['revista']);
        if(($nombre == '') || ($dni == '') || ($email == '') || ($antiguedad == '') || ($revista == '')){
            echo 3;
        }else{
            agregarUser($nombre,$dni,$email,$antiguedad,$revista,$conn,$dbase);
        }
        
        
  
?>
