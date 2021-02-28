function actualizar() {
    var user = $("#usuario").val().toString();
    var nombre = $("#nombre").val().toString();
    var ape = $("#apellidos").val().toString();
    var email = $("#email").val().toString();
    var textoErrores = "No puedes dejar campos vacios";
    try {
        if (user != "" && nombre != "" && ape != " " && email != "") {
            $("#formulario").submit();
        }
        else {
            throw textoErrores;
        }
    }
    catch (err) {
        $("#errorTypescript").html("<div class='alert alert-danger text-center' role='alert'>" + textoErrores + " </div>");
        event.preventDefault();
    }
}
function actualizarPass() {
    var pass = $("#pass").val().toString();
    var pass2 = $("#pass2").val().toString();
    var textoErrores = "";
    try {
        if (pass != "" && pass2 != "") {
            if (pass != pass2) {
                textoErrores = "Las contraseñas no coinciden";
                throw textoErrores;
            }
            else {
                $("#formulario2").submit();
            }
        }
        else {
            textoErrores = "No puedes dejar campos vacios";
            throw textoErrores;
        }
    }
    catch (err) {
        $("#erroresTypescript").html("<div class='alert alert-danger text-center' role='alert'>" + textoErrores + " </div>");
        event.preventDefault();
    }
}
