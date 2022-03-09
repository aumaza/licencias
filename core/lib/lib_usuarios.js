/*
** agregar nuevo usuario
*/
$(document).ready(function(){
    $('#add_nuevo_usuario').click(function(){
        var datos=$('#fr_nuevo_usuario_ajax').serialize();
        $.ajax({
            type:"POST",
            url:"../lib/add_nuevo_usuario.php",
            data:datos,
            success:function(r){
                if(r==1){
                    alert("Agente y Usuario Creado Exitosamente!!");
                    $('#nombre').val('');
                    $('#dni').val('');
                    $('#email').val('');
                    $('#antiguedad').val('');
                    $('#revista').val('');
                    $('#nombre').focus();
                }else if(r==-1){
                    alert("Hubo un problema al intentar Crear el Agente y el Usuario");
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
** EDITAR AGENTE
*/
$(document).ready(function(){
    $('#edit_agente').click(function(){
        var datos=$('#fr_actualizar_agente_ajax').serialize();
        $.ajax({
            type:"POST",
            url:"../lib/update_agente.php",
            data:datos,
            success:function(r){
                if(r==1){
                    alert("Agente Actualizado Exitosamente!!");
                    console.log("Datos: " + datos);
                    document.location.href="main.php";
                }else if(r==-1){
                    alert("Hubo un problema al intentar Actualizar el Agente");
                    console.log("Datos: " + datos);
                }else if(r==2){
                    alert("Hay campos en los cuales ingresó caracteres no válidos");
                    console.log("Datos: " + datos);
                }
            }
        });

        return false;
    });
});


/*
 * * CAMBIAR PERMISOS DE USUARIOS
 */
$(document).ready(function(){
    $('#cambiar_permiso').click(function(){
        var datos=$('#frm_user_allow').serialize();
        $.ajax({
            type:"POST",
            url:"../lib/cambiar_permiso_usuario.php",
            data:datos,
            success:function(r){
                if(r==1){
                    alert("Permiso de Usuario Cambiado Exitosamente!!");
                     window.location.reload();
                }else if(r==-1){
                    alert("Hubo un problema al intentar cambiar el Permiso de Usuario");
                }
            }
        });

        return false;
    });
});


/*
 ** cambiar password
 */
$(document).ready(function(){
    $('#change_password').click(function(){
        var datos=$('#frm_change_password').serialize();
        $.ajax({
            type:"POST",
            url:"../lib/change_password.php",
            data:datos,
            success:function(r){
                if(r == 1){
                    alert("Password Actualizada Exitosamente!!");
                     window.location.reload();
                }else if(r == -1){
                    alert("Hubo un problema al intentar actualizar el Password");
                }else if(r == 0){
                    alert("Los Password no Conciden");
                    console.log("Datos: " + datos);
                }else if(r == 2){
                    alert("El password no puede tener menos o más de 15 caracteres");
                    console.log("Datos: " + datos);
                }else if(r == 3){
                    alert("El password contiene caracteres no válidos");
                    console.log("Datos: " + datos);
                }
                
            }
        });

        return false;
    });
});
