<?php session_start();
        include "../../connection/connection.php";
        include "../lib/usuarios/lib_usuarios.php";
        include "lib_licencias.php";
                        
                                
        $clase_licencia = mysqli_real_escape_string($conn,$_POST['clase_licencia']);
        $descripcion = mysqli_real_escape_string($conn,$_POST['descripcion']);
        $articulo = mysqli_real_escape_string($conn,$_POST['articulo']);
        $revista = mysqli_real_escape_string($conn,$_POST['revista']);
        $tiempo = mysqli_real_escape_string($conn,$_POST['tiempo']);
        $goce_haberes = mysqli_real_escape_string($conn,$_POST['goce_haberes']);
        $obligatoriedad = mysqli_real_escape_string($conn,$_POST['obligatoriedad']);
        $particularidad = mysqli_real_escape_string($conn,$_POST['particularidad']);
        
        if(($clase_licencia == '') || 
                ($descripcion == '') || 
                    ($articulo == '') || 
                        ($revista == '') || 
                            ($tiempo == '') || 
                                ($goce_haberes == '') || 
                                    ($obligatoriedad == '') ||
                                        ($particularidad == '')){
            echo 3; // cualquiera de los campos está vacio
        }else{
            addTipoLicencia($clase_licencia,$descripcion,$articulo,$revista,$tiempo,$goce_haberes,$obligatoriedad,$particularidad,$conn,$dbase);
        }
        
        
  
?>
