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
        $diferencia = dateDifferent($f_desde,$f_hasta);
        
        // evalua que las fecha hasta no sea menor a fecha desde
        
        if(($diferencia == 1) || ($diferencia == 0)){
               
        // evalua tipo de licencia
        
        // LICENCIA ANUAL ORDINARIA
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
        
        
        // AUSENTE CON AVISO
        if($descripcion == 'Razones Particulares (Ausente con Aviso)'){
        
            if(($f_desde == '') || 
                        ($f_hasta == '')){
                echo 3; // cualquiera de los campos está vacio
            }else{
                insertAusenteAviso($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn);
            }
        
        }
        
        
        // NACIMIENTO
        if($descripcion == 'Nacimientos'){
            
            if(($f_desde == '') || 
                        ($f_hasta == '')){
                echo 3; // cualquiera de los campos está vacio
            }else{
                insertLicPaternidad($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn);
            }
        
        }
        
        
        // FALLECIMIENTO
        if($descripcion == 'Fallecimiento'){
        
            $parentalidad = mysqli_real_escape_string($conn,$_POST['parentalidad']);
        
            if(($f_desde == '') || 
                        ($f_hasta == '') ||
                            ($parentalidad == '')){
                echo 3; // cualquiera de los campos está vacio
            }else{
                insertLicFallecimiento($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$parentalidad,$conn);
            }
        
        }
        
        
        // FUERZA MAYOR
        if($descripcion == 'Razones Especiales (Fuerza Mayor)'){
            
            if(($f_desde == '') || 
                        ($f_hasta == '')){
                echo 3; // cualquiera de los campos está vacio
            }else{
                insertFuerzaMayor($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn);
            }
        }
        
        // DONACION DE SANGRE
        if($descripcion == 'Donación de Sangre'){
                
                if(($f_desde == '') || 
                            ($f_hasta == '')){
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertDonarSangre($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn);
                }
                
            }
        
        // MESA EXAMINADORA
        if($descripcion == 'Mesas Examinadoras'){
        
            if(($f_desde == '') || 
                            ($f_hasta == '')){
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertMesaExaminadora($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn);
                }
            
        
        }
        
        // AUSENTE CON AVISO SIN GOCE DE HABERES
        if($descripcion == 'Otras Inasistencias (Ausente con aviso sin goce de haberes)'){
        
            if(($f_desde == '') || 
                            ($f_hasta == '')){
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertAusenteSinGoce($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn);
                }
            
        
        }
        
        // HORARIOS PARA ESTUDIANTES
        if($descripcion == 'Horarios para estudiantes'){
            
            $cant_horas = mysqli_real_escape_string($conn,$_POST['cant_horas']);
            
            if(($f_desde == '') || 
                            ($f_hasta == '') ||
                                ($cant_horas == '')){
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertLicenciaHorEstudiante($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$cant_horas,$conn);
                }
        
        }
        
        // MADRES LACTANTES
        if($descripcion == 'Reducción horaria para agentes madres de lactantes'){
        
            $cant_horas = mysqli_real_escape_string($conn,$_POST['cant_horas']);
            
            if(($f_desde == '') || 
                            ($f_hasta == '') ||
                                ($cant_horas == '')){
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertLicenciaMadreLactante($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$cant_horas,$conn);
                }
        
        }
        
        // ASISTENCIA A CONGRESOS
        if($descripcion == 'Asistencia a congresos'){
            
            if(($f_desde == '') || 
                    ($f_hasta == '')){
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertAsistenciaCongresos($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn);
                }
        }
        
        // AFECCIONES DE CORTO TRATAMIENTO 
        if($descripcion == 'Afecciones de corto tratamiento'){
        
            if(($f_desde == '') || 
                    ($f_hasta == '')){
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertCortoTratamiento($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn);
                }
        }
        
        // ENFERMEDAD EN HORAS DE LABOR
        if($descripcion == 'Enfermedad en horas de labor'){
        
            if(($f_desde == '') || 
                    ($f_hasta == '')){
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertEnfHorasLabor($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn);
                }
        
        }
        
        // AFFECCIONES DE LARGO TRATAMIENTO
        if($descripcion == 'Afecciones largo tratamiento'){
            
            $cant_anios = mysqli_real_escape_string($conn,$_POST['cant_anios']);
            
            if(($f_desde == '') || 
                    ($f_hasta == '') ||
                        ($cant_anios == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    
                    insertAfeccionLargoTratamiento($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$cant_anios,$conn);
                }
        }
        
        // ACCIDENTE DE TRABAJO
        if($descripcion == 'Accidente de trabajo'){
            
            $cant_anios = mysqli_real_escape_string($conn,$_POST['cant_anios']);
            
            if(($f_desde == '') || 
                    ($f_hasta == '') ||
                        ($cant_anios == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertAccidenteTrabajo($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$cant_anios,$conn);
                }
        }
        
        // INCAPACIDAD
        if($descripcion == 'Incapacidad'){
        
            if(($f_desde == '') || 
                    ($f_hasta == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertIncapacidad($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn);
                }
        
        }
        
        // ANTICIPO DE HABERES POR PASIVIDAD
        if($descripcion == 'Anticipo de haber por pasividad'){
        
            if(($f_desde == '') || 
                    ($f_hasta == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertAnticipoPasividad($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn);
                }
        
        }
        
        // MATERNIDAD
        if($descripcion == 'Maternidad'){
            
            $parto_multiple = mysqli_real_escape_string($conn,$_POST['parto_multiple']);
            
            if(($f_desde == '') || 
                    ($f_hasta == '') ||
                        ($parto_multiple == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertMaternidad($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$parto_multiple,$conn);
                }
        
        }
        
        
        
        }else if($diferencia == -1){
            echo 31; // la fecha hasta no puede ser menor a fecha desde            
        }
        
        
  
?>
