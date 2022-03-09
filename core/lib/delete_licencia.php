<?php session_start();
        include "../connection/connection.php";
        include "../lib/lib_licencias.php";
                        
        
        // verica conexion
        if($conn){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            deleteLicencia($id,$conn);
        }else{
            echo 7; //
        }
        
  
?>
