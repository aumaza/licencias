/*
** funcion que inserta registro a base de datos
*/
    
$(document).ready(function(){
    $('#add_nueva_licencia').click(function(){
        
        var datos=$('#fr_nueva_licencia_ajax').serialize();
        
        $.ajax({
            type:"POST",
            url:"../lib/add_nueva_licencia.php",
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
            url:"../lib/delete_licencia.php",
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
