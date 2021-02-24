///<reference path="../../node_modules/@types/jquery/index.d.ts" />


function registro() {

    //recojo las contraseñas
    let password: string = $("#inputPassword").val().toString()
    let passwordRep: string = $("#inputConfirmPassword").val().toString()
    //cuando de errores
    let errores: boolean = false
    let textoErrores: string = "Las contraseñas no coinciden<br>"

    try {
        //compruebo password
        if (password != passwordRep) {
            errores = true
            throw textoErrores
        }

    } catch (err) {
        $("#erroresTypescript").html("<div class='alert alert-danger text-center' role='alert'>" + textoErrores + " </div>")
        event.preventDefault()
    }


}
