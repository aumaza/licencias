<?php session_start();
        include "../../connection/connection.php";
        include "lib_licencias.php";
                        
        
        // verica conexion
        if($conn){
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            deleteLicencia($id,$conn,$dbase);
        }else{
            echo 7; //
        }
        
  
?>
