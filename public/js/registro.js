///<reference path="../../node_modules/@types/jquery/index.d.ts" />
function registro() {
    //recojo las contraseñas
    var password = $("#inputPassword").val().toString();
    var passwordRep = $("#inputConfirmPassword").val().toString();
    //cuando de errores
    var errores = false;
    var textoErrores = "Las contraseñas no coinciden<br>";
    try {
        //compruebo password
        if (password != passwordRep) {
            errores = true;
            throw textoErrores;
        }
    }
    catch (err) {
        $("#erroresTypescript").html("<div class='alert alert-danger text-center' role='alert'>" + textoErrores + " </div>");
        event.preventDefault();
    }
}
