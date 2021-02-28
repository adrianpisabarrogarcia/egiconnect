$(document).ready(function () {
    //Asignamos la función correspondiente al formulario.
    try {
        $("#botonCrearProyecto").click(validarProyecto);
        $("#botonGenerarCodigo").click(generarNuevoCodigo);
        $("#borrarProyecto").click(borrarProyecto);
    }
    catch (error) {
        console.log(error);
    }
});
function validarProyecto() {
    try {
        // @ts-ignore
        var textoErrores = ["Debes añadir un nombre al proyecto", "Debes añadir una descripción al proyecto"];
        // @ts-ignore
        var nombre = $("#nombre").val();
        // @ts-ignore
        var des = $("#descripcion").val();
        if (nombre.length == 0 && des.length == 0) {
            throw textoErrores[0] + "<br>" + textoErrores[1];
        }
        else {
            if (nombre.length == 0) {
                throw textoErrores[0];
            }
            else {
                if (des.length == 0) {
                    throw textoErrores[1];
                }
                else {
                    $("#formulario").submit();
                }
            }
        }
    }
    catch (e) {
        $("#erroresTypescript").html("<div class='alert alert-danger text-center' role='alert'>" + e + " </div>");
        event.preventDefault();
    }
}
function actualizarProyecto() {
    try {
        // @ts-ignore
        var textoErrores = ["No has modificado ningún campo", "Debes añadir un nombre al proyecto", "Debes añadir una descripción al proyecto"];
        // @ts-ignore
        var nombre = $("#nombre").val();
        // @ts-ignore
        var des = $("#descripcion").val();
        // @ts-ignore
        var currentDes = $("#currentDes").val();
        // @ts-ignore
        var currentName = $("#currentName").val();
        if (nombre == currentName && des == currentDes) {
            throw textoErrores[0];
        }
        else {
            if (nombre.length == 0 && des.length == 0) {
                throw textoErrores[1] + "<br>" + textoErrores[2];
            }
            else {
                if (nombre.length == 0) {
                    throw textoErrores[0];
                }
                else {
                    if (des.length == 0) {
                        throw textoErrores[1];
                    }
                    else {
                        $("#formulario").submit();
                    }
                }
            }
        }
    }
    catch (e) {
        $("#erroresTypescriptActualizar").html("<div class='alert alert-danger text-center' role='alert'>" + e + " </div>");
        event.preventDefault();
    }
}
function generarNuevoCodigo() {
    $("#formularioCodigo").submit();
}
function borrarProyecto() {
    $("#formularioBorrar").submit();
}
