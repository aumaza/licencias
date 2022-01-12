<?php   session_start();
        include "../connection/connection.php";
        include "../lib/lib_licencias.php";
                        
        
        // datos del usuario

        $nombre = mysqli_real_escape_string($conn,$_POST['nombre']);
        $dni = mysqli_real_escape_string($conn,$_POST['dni']);
        $antiguedad = mysqli_real_escape_string($conn,$_POST['antiguedad']);
        $revista = mysqli_real_escape_string($conn,$_POST['revista']);
        $descripcion = mysqli_real_escape_string($conn,$_POST['licencia']);
        
        // datos de la licencia
        
        $f_desde = mysqli_real_escape_string($conn,$_POST['f_desde']);
        $f_hasta = mysqli_real_escape_string($conn,$_POST['f_hasta']);
        
        echo $f_desde .'<br>';
        echo $f_hasta .'<br>';
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
               insertLicenciaOrdinaria($nombre,$dni,$antiguedad,$revista,$descripcion,$f_desde,$f_hasta,$periodo,$fraccion,$conn);
            }
        }
        
        if($descripcion == 'Razones Particulares (Ausente con Aviso)'){
        
            if(($f_desde == '') || 
                        ($f_hasta == '')){
                echo 3; // cualquiera de los campos está vacio
            }else{
                insertAusenteAviso($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn);
            }
        
        }
        
        
  
?>
