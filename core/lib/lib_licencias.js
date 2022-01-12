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
                }else if(r == 3){
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
                    alert("Solo Planta Permanente y Ley Marco pueden solicitar Ausente con Aviso!!");
                }else if(r == 23){
                    alert("Solo puede tomar 2 días seguidos de Ausente con Aviso!!");
                    console.log("Datos: " + datos);
                }else if(r == 25){
                    alert("Ya no le quedan días para usar!!");
                }else if(r == 27){
                    alert("No puede tomar Ausente con Aviso dos veces en el mismo mes!!");
                }else if(r == 29){
                    alert("Las fechas no son válidas!!");
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
