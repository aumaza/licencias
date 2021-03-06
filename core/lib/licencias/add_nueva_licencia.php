<?php   session_start();
        include "../../connection/connection.php";
        include "lib_licencias.php";
                        
        
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
               insertLicenciaOrdinaria($nombre,$dni,$antiguedad,$revista,$descripcion,$f_desde,$f_hasta,$periodo,$fraccion,$conn,$dbase);
            }
        }
        
        
        // AUSENTE CON AVISO
        if($descripcion == 'Razones Particulares (Ausente con Aviso)'){
        
            if(($f_desde == '') || 
                        ($f_hasta == '')){
                echo 3; // cualquiera de los campos está vacio
            }else{
                insertAusenteAviso($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
            }
        
        }
        
        
        // NACIMIENTO
        if($descripcion == 'Nacimientos'){
            
            if(($f_desde == '') || 
                        ($f_hasta == '')){
                echo 3; // cualquiera de los campos está vacio
            }else{
                insertLicPaternidad($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
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
                insertLicFallecimiento($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$parentalidad,$conn,$dbase);
            }
        
        }
        
        
        // FUERZA MAYOR
        if($descripcion == 'Razones Especiales (Fuerza Mayor)'){
            
            if(($f_desde == '') || 
                        ($f_hasta == '')){
                echo 3; // cualquiera de los campos está vacio
            }else{
                insertFuerzaMayor($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
            }
        }
        
        // DONACION DE SANGRE
        if($descripcion == 'Donación de Sangre'){
                
                if(($f_desde == '') || 
                            ($f_hasta == '')){
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertDonarSangre($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
                }
                
            }
        
        // MESA EXAMINADORA
        if($descripcion == 'Mesas Examinadoras'){
        
            if(($f_desde == '') || 
                            ($f_hasta == '')){
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertMesaExaminadora($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
                }
            
        
        }
        
        // AUSENTE CON AVISO SIN GOCE DE HABERES
        if($descripcion == 'Otras Inasistencias (Ausente con aviso sin goce de haberes)'){
        
            if(($f_desde == '') || 
                            ($f_hasta == '')){
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertAusenteSinGoce($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
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
                    insertLicenciaHorEstudiante($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$cant_horas,$conn,$dbase);
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
                    insertLicenciaMadreLactante($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$cant_horas,$conn,$dbase);
                }
        
        }
        
        // ASISTENCIA A CONGRESOS
        if($descripcion == 'Asistencia a congresos'){
            
            if(($f_desde == '') || 
                    ($f_hasta == '')){
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertAsistenciaCongresos($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
                }
        }
        
        // AFECCIONES DE CORTO TRATAMIENTO 
        if($descripcion == 'Afecciones de corto tratamiento'){
        
            if(($f_desde == '') || 
                    ($f_hasta == '')){
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertCortoTratamiento($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
                }
        }
        
        // ENFERMEDAD EN HORAS DE LABOR
        if($descripcion == 'Enfermedad en horas de labor'){
        
            if(($f_desde == '') || 
                    ($f_hasta == '')){
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertEnfHorasLabor($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
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
                    
                    insertAfeccionLargoTratamiento($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$cant_anios,$conn,$dbase);
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
                    insertAccidenteTrabajo($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$cant_anios,$conn,$dbase);
                }
        }
        
        // INCAPACIDAD
        if($descripcion == 'Incapacidad'){
        
            if(($f_desde == '') || 
                    ($f_hasta == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertIncapacidad($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
                }
        
        }
        
        // ANTICIPO DE HABERES POR PASIVIDAD
        if($descripcion == 'Anticipo de haber por pasividad'){
        
            if(($f_desde == '') || 
                    ($f_hasta == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertAnticipoPasividad($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
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
                    insertMaternidad($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$parto_multiple,$conn,$dbase);
                }
        
        }
        
        // ADOPCION DE NIÑO HASTA 7 AÑOS DE EDAD
        if($descripcion == 'Tenencia para adopción'){
            
            $edad = mysqli_real_escape_string($conn,$_POST['edad_ninio']);
            
            if(($f_desde == '') || 
                    ($f_hasta == '') ||
                        ($edad == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertAdopcion($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$edad,$conn,$dbase);
                }
        
        }
        
        // MATERNIDAD (NACIMIENTO SIN VIDA) ART 135CCTG
        if($descripcion == 'Maternidad (Nac. sin vida)'){
            
            $parto_multiple = mysqli_real_escape_string($conn,$_POST['parto_multiple']);
            
            if(($f_desde == '') || 
                    ($f_hasta == '') ||
                        ($parto_multiple == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertNacimientoSinVida($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$parto_multiple,$conn,$dbase);
                }
        
        }
        
        // MATERNIDAD EXCEDENCIA
        if($descripcion == 'Maternidad Excedencia'){
            
            $opciones = mysqli_real_escape_string($conn,$_POST['opciones']);
            
            if(($f_desde == '') || 
                    ($f_hasta == '') ||
                        ($opciones == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertMaternidadExcedencia($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$opciones,$conn,$dbase);
                }
        
        }
        
        // PARA RENDIR EXAMENES
        if($descripcion == 'Para Rendir Examenes'){
            
            $cursando = mysqli_real_escape_string($conn,$_POST['cursando']);
            
            if(($f_desde == '') || 
                    ($f_hasta == '') ||
                        ($cursando == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertRendirExamen($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$cursando,$conn,$dbase);
                }
        
        }
        
        //PARA REALIZAR ESTUDIOS O INVESTIGACIONES
        if($descripcion == 'Para Realizar estudios o Investigaciones'){
            
            $anios_investigacion = mysqli_real_escape_string($conn,$_POST['anios_investigacion']);
            
            if(($f_desde == '') || 
                    ($f_hasta == '') ||
                        ($anios_investigacion == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertEstudiosInvestigaciones($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$anios_investigacion,$conn,$dbase);
                }
        
        }
        
        // PARA REALIZAR ESTUDIOS EN ESCUELA DE DEFENSA NACIONAL
        if($descripcion == 'Estudios en Escuela Defensa Nacional'){
                     
            if(($f_desde == '') || 
                    ($f_hasta == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertEstudiosDefensaNacional($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
                }
        
        }
        
        // MATRIMONIO DEL AGENTE O DE LOS HIJOS
        if($descripcion == 'Matrimonio del agente o hijos'){
             
             $matrimonio = mysqli_real_escape_string($conn,$_POST['matrimonio']);
                     
            if(($f_desde == '') || 
                    ($f_hasta == '') ||
                        ($matrimonio == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertCasamientoAgente($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$matrimonio,$conn,$dbase);
                }
        
        }
        
        // ACTIVIDADES DEPORTIVAS NO RENTADAS
        if($descripcion == 'Actividades Deportivas no rentadas'){
                     
            if(($f_desde == '') || 
                    ($f_hasta == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertActividadesDeportivas($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
                }
        
        }
        
        // EJERCICIO TRANSITORIO DE OTROS CARGOS
        if($descripcion == 'Ejercicio Transitorio de otros cargos'){
                     
            if(($f_desde == '') || 
                    ($f_hasta == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertCargosTransitorios($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
                }
        
        }
        
        // RAZONES PARTICULARES
        if($descripcion == 'Razones Particulares'){
             
             $meses = mysqli_real_escape_string($conn,$_POST['meses']);
                     
            if(($f_desde == '') || 
                    ($f_hasta == '') ||
                        ($meses == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertRazonesParticulares($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$meses,$conn,$dbase);
                }
        
        }
        
        // RAZONES DE ESTUDIOS
        if($descripcion == 'Razones de Estudio'){
             
             $anio = mysqli_real_escape_string($conn,$_POST['anio']);
                     
            if(($f_desde == '') || 
                    ($f_hasta == '') ||
                        ($anio == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertRazonesEstudio($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$anio,$conn,$dbase);
                }
        
        }
        
        // ACOMPAÑAR A CONYUGE
        if($descripcion == 'Acompañar Cónyuge'){
             
            if(($f_desde == '') || 
                    ($f_hasta == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertAcompañarConyuge($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
                }
        
        }
        
        // CARGOS Y HORAS CATEDRA
        if($descripcion == 'Cargos, horas Cátedra'){
             
            if(($f_desde == '') || 
                    ($f_hasta == '')) {
                    echo 3; // cualquiera de los campos está vacio
                }else{
                    insertHorasCatedra($nombre,$dni,$revista,$descripcion,$f_desde,$f_hasta,$conn,$dbase);
                }
        
        }
        
        // VERIFICACION DE QUE LA FECHA HASTA NO SEA MAYOR A FECHA DESDE
        }else if($diferencia == -1){
            echo 31; // la fecha hasta no puede ser menor a fecha desde            
        }
        
        
  
?>
