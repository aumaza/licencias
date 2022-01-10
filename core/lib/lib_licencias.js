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
                else if(r == ''){
                    console.log("Datos: " + datos);
                }
                
                
            }
        });

        return false;
    });
});
