function actualizar() {
    var currentUser = $("#userMostrar").val().toString();
    var currentNombre = $("#nombreMostrar").val().toString();
    var currentApe = $("#apellidosMostrar").val().toString();
    var currentEmail = $("#emailMostrar").val().toString();
    var user = $("#usuario").val().toString();
    var nombre = $("#nombre").val().toString();
    var ape = $("#apellidos").val().toString();
    var email = $("#email").val().toString();
    var textoErrores = "";
    try {
        if (currentUser == user && currentNombre == nombre && currentApe == ape && currentEmail == email) {
            textoErrores = "Debes modificar alguno de los campos";
            throw textoErrores;
        }
        else {
            if (user != "" && nombre != "" && ape != " " && email != "") {
                $("#formulario").submit();
            }
            else {
                textoErrores = "No puedes dejar campos vacios";
                throw textoErrores;
            }
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
