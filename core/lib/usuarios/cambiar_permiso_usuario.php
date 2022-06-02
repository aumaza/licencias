<?php session_start();
        include "../../connection/connection.php";
        include "lib_usuarios.php";
                        
                                
        $id = mysqli_real_escape_string($conn,$_POST['bookId']);
        $role = mysqli_real_escape_string($conn,$_POST['permisos']);
        cambiarPermisos($id,$role,$conn,$dbase);
        
        
  
?>
