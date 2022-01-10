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


