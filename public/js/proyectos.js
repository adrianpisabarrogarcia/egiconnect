$(document).ready(function () {
    //Asignamos la función correspondiente al formulario.
    try {
        $("#botonCrearProyecto").click(validarProyecto);
        $("#botonGenerarCodigo").click(generarNuevoCodigo);
        $("#borrarProyecto").click(borrarProyecto);
        $("#botonUnirseProyecto").click(validarCodigoProyecto);
        $("#botonSubirArchivo").click(validarDatosObra);
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
$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    if (fileName == "") {
        $(this).siblings(".custom-file-label").addClass("selected").html("Selecciona un archivo");
    }
});
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
function validarDatosObra() {
    validarFichero();
}
function validarFichero() {
    var campo = "#archivo";
    // @ts-ignore
    var nombreArchivo = $(campo).val();
    try {
        if (nombreArchivo != "") {
            var extension = nombreArchivo.substring(nombreArchivo.lastIndexOf('.'), nombreArchivo.length);
            extension = extension.substring(1, extension.length);
            if (extension == "jpg" || extension == "jpeg" || extension == "png" || extension == "pdf" || extension == "zip" || extension == "rar") {
                // @ts-ignore
                if (document.querySelector("#archivo").files[0].size <= 1024 * 1024) {
                    $("#formularioFile").submit();
                }
                else {
                    throw "El archivo ha excedido el peso máximo";
                }
            }
            else {
                throw "Ese formato de archivo no se admite";
            }
        }
        else {
            throw "Primero debes seleccionar un archivo.";
        }
    }
    catch (e) {
        event.preventDefault();
        $("#erroresTypescriptFile").html("<div class='mr-2 ml-2 alert alert-danger text-center' role='alert'>" + e + " </div>");
    }
}
function generarNuevoCodigo() {
    $("#formularioCodigo").submit();
}
function borrarProyecto() {
    $("#formularioBorrar").submit();
}
