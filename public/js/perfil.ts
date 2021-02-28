$(document).ready(function (){
    //Asignamos la función correspondiente al formulario.
    try {


        $("#botonActualizarPerfil").click(actualizar);
        $("#botonActualizarContrasena").click(actualizarPass);
    }catch (error){
        console.log(error)
    }

});

function actualizar():void {
    $("#formulario").submit();
}

function actualizarPass():void {
    $("#formulario2").submit();
}
