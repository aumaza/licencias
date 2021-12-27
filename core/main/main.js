/*
** funcion que completa select con lo filtrado de otro select
*/

function CargarLicencias(val){
    $.ajax({
        type: "POST",
        url: '../lib/consulta_licencia.php',
        data: 'tipo_licencia='+val,
        success: function(resp){
            $('#descripcion').html(resp);
            $('#respuesta').html("");
            console.log(resp);
        }
    });
}


/*
** funcion que inserta registro a base de datos
*/
function guardarLicencia(){
    
$(document).ready(function(){
    $('#add_nueva_licencia').click(function(){
        var datos=$('#fr_nueva_licencia_ajax').serialize();
        $.ajax({
            type:"POST",
            url:"../lib/add_nueva_licencia.php",
            data:datos,
            success:function(r){
                if(r==1){
                    alert("Licencia Agregada Exitosamente!!");
                    document.location.href="main.php";
                }else if(r==-1){
                    alert("Hubo un problema al intentar agregar la licencia");
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
}
