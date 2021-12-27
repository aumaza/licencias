<?php session_start();
        include "../connection/connection.php";
        include "../lib/lib_usuarios.php";
        include "../lib/lib_licencias.php";
                        
        
        // datos del usuario

        $nombre = mysqli_real_escape_string($conn,$_POST['nombre']);
        $dni = mysqli_real_escape_string($conn,$_POST['dni']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $antiguedad = mysqli_real_escape_string($conn,$_POST['antiguedad']);
        $revista = mysqli_real_escape_string($conn,$_POST['revista']);
        $descripcion = mysqli_real_escape_string($conn,$_POST['descripcion']);
        
        // datos de la licencia
        
        $f_desde = mysqli_real_escape_string($conn,$_POST['f_desde']);
        $f_hasta = mysqli_real_escape_string($conn,$_POST['f_hasta']);
        
        // evalua tipo de licencia
        
        if($descripcion == 'Licencia Anual Ordinaria'){
        
            $periodo = mysqli_real_escape_string($conn,$_POST['periodo']);
            $fraccion = mysqli_real_escape_string($conn,$_POST['fraccion']);
              
        
            if(($periodo == '') || 
                    ($f_desde == '') || 
                        ($f_hasta == '') ||
                            ($fraccion == '')){
                echo 3; // cualquiera de los campos está vacio
            }else{
                //function insertLicenciaOrdinaria($nombre,$dni,$antiguedad,$revista,$descripcion,$f_desde,$f_hasta,$periodo,$fraccion,$conn);
            }
        }
        
        
  
?>
