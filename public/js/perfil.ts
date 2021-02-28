
function actualizar():void {


    let user: string = $("#usuario").val().toString();
    let nombre: string = $("#nombre").val().toString();
    let ape: string = $("#apellidos").val().toString();
    let email: string = $("#email").val().toString();

    let textoErrores: string = "No puedes dejar campos vacios";

    try {
    if(user!="" && nombre!="" && ape!=" "&& email!=""){
          $("#formulario").submit();
    } else{
        throw textoErrores;
    }

    } catch (err) {
        $("#errorTypescript").html("<div class='alert alert-danger text-center' role='alert'>" + textoErrores + " </div>")
        event.preventDefault()
    }
}

function actualizarPass():void {

    let pass: string = $("#pass").val().toString();
    let pass2: string = $("#pass2").val().toString();

    let textoErrores: string = "";

    try {

    if(pass!="" && pass2!=""){
        if(pass!=pass2){
            textoErrores= "Las contraseñas no coinciden";
            throw textoErrores;
        } else{
            $("#formulario2").submit();
        }
    } else{
        textoErrores= "No puedes dejar campos vacios";
        throw textoErrores;
    }



} catch (err) {
    $("#erroresTypescript").html("<div class='alert alert-danger text-center' role='alert'>" + textoErrores + " </div>")
    event.preventDefault()
}

}

