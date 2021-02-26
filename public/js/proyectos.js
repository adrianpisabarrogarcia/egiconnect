$(document).ready(function () {
    //Asignamos la función correspondiente al formulario.
    try {
        $("#botonCrearProyecto").click(validarProyecto);
        $("#botonUnirseProyecto").click(validarCodigoProyecto);
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
function validarCodigoProyecto() {
    try {
        // @ts-ignore
        var textoErrores = "El codígo debe tener 5 carácteres";
        // @ts-ignore
        var cod = $("#codigoProyecto").val();
        var codUpper = cod.toUpperCase();
        $("#codigoProyecto").val(codUpper);
        if (cod.length == 5) {
            $("#formulario2").submit();
        }
        else {
            throw textoErrores;
        }
    }
    catch (e) {
        $("#erroresTypescript2").html("<div class='alert alert-danger text-center' role='alert'>" + e + " </div>");
        event.preventDefault();
    }
}
