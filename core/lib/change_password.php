<?php session_start();
        include "../connection/connection.php";
        include "../lib/lib_usuarios.php";
                        
        $id = mysqli_real_escape_string($conn,$_POST['bookId']);
        $password_1 = mysqli_real_escape_string($conn,$_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn,$_POST['password_2']);
        changePass($id,$password_1,$password_2,$conn);
        
        
  
?>
