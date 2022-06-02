/*
** funcion que inserta registro a base de datos
*/
    
$(document).ready(function(){
    $('#add_nueva_licencia').click(function(){
        
        var datos=$('#fr_nueva_licencia_ajax').serialize();
       
        
        $.ajax({
            type:"POST",
            url:"../lib/licencias/add_nueva_licencia.php",
            data:datos,
            success:function(r){
                if(r == 1){
                    alert("Licencia Agregada Exitosamente!!");
                    console.log("Datos: " + datos);
                    document.location.href="main.php";
                }else if(r == -1){
                    alert("Hubo un problema al intentar agregar la licencia");
                    console.log("Datos: " + datos);
                }else if(r == 2){
                    alert("Hay campos en los cuales ingresó caracteres no válidos");
                    console.log("Datos: " + datos);
                }
                // licencia anual ordinaria
                else if(r == 3){
                    alert("No ha ingresado datos aún!!");
                }else if(r == 4){
                    alert("La Cantidad de días a tomar es mayor de los que dispone!!");
                }else if(r == 11){
                    alert("Ya utilizó la Primera Fracción!!");
                }else if(r == 13){
                    alert("Debe solicitar permiso a su superior para utilizar la Tercera Fracción!!");
                }else if(r == 15){
                    alert("Agotó todas las fracciones para dicho período!!");
                }else if(r == 17){
                    alert("Antes debe utilizar la segunda fracción!!");
                }else if(r == 19){
                    alert("Ya no posee más días para dicho período!!");
                }
                // licencia ausente con aviso
                else if(r == 21){
                    alert("Solo Planta Permanente y Ley Marco pueden solicitar Ausente con Aviso o Ausente con Aviso SGH!!");
                }else if(r == 23){
                    alert("Solo puede tomar 2 días seguidos de Ausente con Aviso!!");
                    console.log("Datos: " + datos);
                }else if(r == 25){
                    alert("Ya no le quedan días para usar!!");
                    console.log("Datos: " + datos);
                }else if(r == 27){
                    alert("No puede tomar Ausente con Aviso dos veces en el mismo mes!!");
                }else if(r == 29){
                    alert("Las fechas no son válidas!!");
                }else if(r == 31){
                    alert("Fecha Hasta no puede ser anterior a Fecha Desde!!");
                }
                
                // licencia por paternidad
                else if(r == 33){
                    alert("La cantidad de días no puede ser menor o mayor a 3!!");
                    console.log("Datos: " + datos);
                }
                
                // licencia por fallecimiento
                else if(r == 35){
                    alert("Fallecimiento de conyuge, hijos, padres o hermanos, la cantidad de días no puede ser menor ni mayor a 5 días hábiles!!");
                    console.log("Datos: " + datos);
                }else if(r == 37){
                    alert("Fallecimiento de tíos, sobrinos, etc. La cantidad de días no puede ser menor o mayor a 3 días hábiles!!");
                    console.log("Datos: " + datos);
                }
                
                // LICENCIA POR DONACION DE SANGRE
                else if(r == 39){
                    alert("Sólo corresponde 1 Día!!");
                    console.log("Datos: " + datos);
                }
                
                // DIAS POR MESA EXAMINADORA
                else if(r == 41){
                    alert("Sólo un total de 12 Días al Año!!");
                    console.log("Datos: " + datos);
                }else if(r == 43){
                    alert("Ya no le quedan días por usar!!");
                    console.log("Datos: " + datos);
                }else if(r == 45){
                    alert("La cantidad de días solicitados excede los que quedan!!");
                    console.log("Datos: " + datos);
                }
                
                // AUSENTE CON AVISO SIN GOCE DE HABERES
                else if(r == 47){
                    alert("Solo puede tomar 2 días seguidos de Ausente con Aviso sin goce de haberes!!");
                    console.log("Datos: " + datos);
                }else if(r == 49){
                    alert("Ya no tiene más días para usar!!");
                    console.log("Datos: " + datos);
                }else if(r == 51){
                    alert("No puede tomar Ausente con Aviso SH dos veces en el mismo mes!!");
                    console.log("Datos: " + datos);
                }else if(r == 53){
                    alert("Aún le quedan días de Ausente con Aviso con goce de haberes!!");
                    console.log("Datos: " + datos);
                }
                
                // FRANQUICIAS //
                // HORARIOS PARA ESTUDIANTES
                else if(r == 55){
                    alert("La Cantidad de Horas no pueden ser Mayor o Menor a 2!!");
                    console.log("Datos: " + datos);
                }
                else if(r == 56){
                    alert("El valor de la hora debe ser un valor numérico!!");
                    console.log("Datos: " + datos);
                }
                
                // MADRES LACTANTES
                else if(r == 57){
                    alert("La cantidad de horas no puede ser mayor a 1!!");
                    console.log("Datos: " + datos);
                }
                else if(r == 59){
                    alert("La Cantidad de días a tomar no puede exceder los 240!!");
                    console.log("Datos: " + datos);
                }
                
                // ENFEREMEDAD CORTO TRATAMIENTO
                else if(r == 61){
                    alert("La Cantidad de días a tomar no puede exceder los 45!!");
                    console.log("Datos: " + datos);
                }
                else if(r == 63){
                    alert("La Cantidad de días a tomar excede la cantidad de días que quedan!!");
                    console.log("Datos: " + datos);
                }
                
                // AFECCIONES DE LARGO TRATAMIENTO Y ACCIDENTE DE TRABAJO
                else if(r == 65){
                    alert("La Cantidad de Años es mayor a los que quedan por usar!!");
                    console.log("Datos: " + datos);
                }
                else if(r == 67){
                    alert("Agotó la cantidad de años a usufructuar!!");
                    console.log("Datos: " + datos);
                }
                else if(r == 69){
                    alert("El cantidad de días entre Fecha desde y Fecha hasta debe coincidir con la cantidad de años elegidos!!");
                    console.log("Datos: " + datos);
                }
                
                // INCAPACIDAD
                else if(r == 71){
                    alert("El cantidad de días entre Fecha desde y Fecha hasta no puede ser menor o mayor a 365!!");
                    console.log("Datos: " + datos);
                }
                else if(r == 73){
                    alert("Ya está usufructuando de Licencia por Incapacidad!!");
                    console.log("Datos: " + datos);
                }
                
                // ANTICIPO POR PASIVIDAD
                else if(r == 75){
                    alert("El cantidad de días entre Fecha desde y Fecha hasta no puede ser menor o mayor a 365!!");
                    console.log("Datos: " + datos);
                }
                else if(r == 77){
                    alert("Ya está usufructuando de Licencia Anticipo de haberes por pasividad!!");
                    console.log("Datos: " + datos);
                }else if(r == -5){
                    alert("No se pudo realizar la comprobación");
                    console.log("Datos: " + datos);
                }
                
                // MATERNIDAD
                else if(r == 79){
                    alert("Si el Parto es Múltiple la cantidad de días no puede ser mayor o menor a 110 días!!");
                    console.log("Datos: " + datos);
                }
                else if(r == 81){
                    alert("Si el parto es simple la cantidad de días no puede ser mayor o menor a 100 días!!");
                    console.log("Datos: " + datos);
                }
                
                // ADOPCION DE MENOR HASTA 7 AÑOS DE EDAD
                else if(r == 83){
                    alert("La cantidad de días no puede ser menor a 60 días!!");
                    console.log("Datos: " + datos);
                }
                else if(r == 85){
                    alert("La edad del niño no puede ser mayor a 7 años!!");
                    console.log("Datos: " + datos);
                }
                
                // MATERNIDAD (NACIMIENTO SIN VIDA) ART135CCTG
                else if(r == 87){
                    alert("Si el Parto es Múltiple la cantidad de días no puede ser mayor o menor a 111 días!!");
                    console.log("Datos: " + datos);
                }
                else if(r == 89){
                    alert("Si el parto es simple la cantidad de días no puede ser mayor o menor a 101 días!!");
                    console.log("Datos: " + datos);
                }
                
                // MTERNIDAD EXCEDENCIA
                else if(r == 91){
                    alert("Si la cantidad de meses es de 3, el rango de fechas no puede ser menor o mayor a 90 días!!");
                    console.log("Datos: " + datos);
                }
                else if(r == 92){
                    alert("Si la cantidad de meses es de 6, el rango de fechas no puede ser mayor o menor a 180 días!!");
                    console.log("Datos: " + datos);
                }
                
                // DIAS PARA RENDIR EXAMENES NIVEL SECUNDARIO
                else if(r == 95){
                    alert("Si la cantidad de días a tomar no puede ser mayor a 3!!");
                    console.log("Datos: " + datos);
                }
                else if(r == 97){
                    alert("Ya no posee más días para usufructuar!!");
                    console.log("Datos: " + datos);
                }
                else if(r == 99){
                    alert("La cantidad de días restantes son insufientes, seleccione una cantidad menor a 3");
                    console.log("Datos: " + datos);
                }
                
                // PARA RENDIR EXAMENES NIVEL TERCIARIO / UNIVERSITARIO / POSTGRADO
                else if(r == 101){
                    alert("Si la cantidad de días a tomar no puede ser mayor a 6!!");
                    console.log("Datos: " + datos);
                }
                else if(r == 103){
                    alert("La cantidad de días restantes son insufientes, seleccione una cantidad menor a 6");
                    console.log("Datos: " + datos);
                }
                else if(r == 105){
                    alert("Ya no posee más días para usufructuar!!");
                    console.log("Datos: " + datos);
                }
                
                // PARA REALIZAR ESTUDIOS O INVESTIGACIONES
                else if(r == 109){
                    alert("Aún no tiene la Antiguedad para solicitar dicha licencia");
                    console.log("Datos: " + datos);
                }
                else if(r == 107){
                    alert("Si seleccionó 1 Año de licencia, la cantidad de días entre fecha desde y fecha hasta no puede ser inferior ni superior a 365");
                    console.log("Datos: " + datos);
                }
                else if(r == 111){
                    alert("Si seleccionó 2 Años de licencia, la cantidad de días entre fecha desde y fecha hasta no puede ser inferior ni superior a 730");
                    console.log("Datos: " + datos);
                }
                else if(r == 113){
                    alert("Ha agotado la cantidad de años de dicha licencia");
                    console.log("Datos: " + datos);
                }
                else if(r == 115){
                    alert("Ha seleccionado 2 Años de investigación y solo le queda 1 año más, por favor reduzca el plazo de la licencia a solicitar!!");
                    console.log("Datos: " + datos);
                }
                
                // PARA REALIZAR ESTUDIOS EN ESCUELA DE DEFENSA NACIONAL
                else if(r == 117){
                    alert("Licencia sólo permitida para personal de Planta Permanente");
                    console.log("Datos: " + datos);
                }
                
                // MATRIMONIO DEL AGENTE O HIJOS
                else if(r == 119){
                    alert("Debe tener en cuenta los sábados y domingos que sumarán días, para que sean 10 días laborables");
                    console.log("Datos: " + datos);
                }
                else if(r == 121){
                    alert("Debe tener en cuenta los sábados y domingos que sumarán días, para que sean 3 días laborables");
                    console.log("Datos: " + datos);
                }
                
                // EJERCICIO TRANSITORIO DE OTROS CARGOS && RAZONES PARTICULARES
                else if(r == 123){
                    alert("Licencia sólo disponible para personal de Planta Permanente!!");
                    console.log("Datos: " + datos);
                }
                
                // RAZONES PARTICULARES
                else if(r == 124){
                    alert("La Cantidad de días no puede ser inferior o superior a 180");
                    console.log("Datos: " + datos);
                }
                else if(r == 125){
                    alert("Desde la fecha de finalización de dicha licencia hasta la fecha de inicio de una nueva solicitud, deben transcurrir 10 años!!");
                    console.log("Datos: " + datos);
                }
                
                // RAZONES DE ESTUDIOS
                else if(r == 127){
                    alert("La Cantidad de días no puede ser inferior o superior a 365");
                    console.log("Datos: " + datos);
                }
                
                // ACOMPAÑAR A CONYUGE
                else if(r == 129){
                    alert("La Cantidad de días no puede ser inferior a 60");
                    console.log("Datos: " + datos);
                }
                
                
                
                // SI NO RETORNA VALOR
                else if(r == ''){
                    console.log("Datos: " + datos);
                }
                
                
                
                
            }
        });

        return false;
    });
});


/*
** eliina registro de licencia de base de datos
*/
    
$(document).ready(function(){
    $('#delete_licencia').click(function(){
        
        var datos=$('#fr_delete_licencia_ajax').serialize();
        
        $.ajax({
            type:"POST",
            url:"../lib/licencias/delete_licencia.php",
            data:datos,
            success:function(r){
                if(r == 1){
                    alert("Licencia Eliminada Exitosamente!!");
                    document.location.href="main.php";
                }else if(r == -1){
                    alert("Hubo un problema al intentar eliminar la licencia");
                }else if(r == 7){
                    alert("Error de Conexion a la Base de Datos");
                }
                
                
            }
        });

        return false;
    });
});


/*
** AGREGAR NUEVO TIPO DE LICENCIA
*/
$(document).ready(function(){
    $('#add_tipo_licencia').click(function(){
        var datos=$('#fr_nuevo_tipo_licencia_ajax').serialize();
        $.ajax({
            type:"POST",
            url:"../lib/licencias/add_nuevo_tipo_licencia.php",
            data:datos,
            success:function(r){
                if(r==1){
                    alert("Tipo de Licencia Agregada Exitosamente!!");
                    $('#clase_licencia').val('');
                    $('#descripcion').val('');
                    $('#articulo').val('');
                    $('#revista').val('');
                    $('#tiempo').val('');
                    $('#goce_haberes').val('');
                    $('#obligatoriedad').val('');
                    $('#particularidad').val('');
                    $('#clase_licencia').focus();
                }else if(r==-1){
                    alert("Hubo un problema al intentar agregar el tipo de licencia");
                    console.log("Datos: " + datos);
                }else if(r==2){
                    alert("Hay campos en los cuales ingresó caracteres no válidos");
                    console.log("Datos: " + datos);
                }else if(r == 3){
                    alert("No ha ingresado datos aún!!");
                }
            }
        });

        return false;
    });
});


/*
** EDITAR NUEVO TIPO DE LICENCIA
*/
$(document).ready(function(){
    $('#edit_tipo_licencia').click(function(){
        var datos=$('#fr_edit_tipo_licencia_ajax').serialize();
        $.ajax({
            type:"POST",
            url:"../lib/licencias/update_nuevo_tipo_licencia.php",
            data:datos,
            success:function(r){
                if(r==1){
                    alert("Tipo de Licencia Actualizada Exitosamente!!");
                    document.location.href="main.php";
                }else if(r==-1){
                    alert("Hubo un problema al intentar actualizar el tipo de licencia");
                    console.log("Datos: " + datos);
                }else if(r==2){
                    alert("Hay campos en los cuales ingresó caracteres no válidos");
                    console.log("Datos: " + datos);
                }else if(r == 3){
                    alert("No ha ingresado datos aún!!");
                }
            }
        });

        return false;
    });
});



/*
** BLOQUEA LOS CAMPOS A EDITAR HASTA QUE EL USUARIO SELECCIONE EL QUE DESEA
*/
 var callEditLicencia = function(x){
            
    if((x == 'edit_descripcion') || 
                (x == 'edit_articulo') || 
                    (x == 'edit_tiempo') ||
                            (x == 'edit_particularidad')){
                
        document.getElementById(x).readOnly = false;
    
    }else if((x == 'edit_clase_licencia') ||
                (x == 'edit_revista') ||
                    (x == 'edit_goce_haberes') ||
                        (x == 'edit_obligatoriedad')){ 
        document.getElementById(x).disabled = false;
    }
}
