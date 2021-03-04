//comprobar los campos
function actualizar():void {

    let currentUser: string = $("#userMostrar").val().toString();
    let currentNombre: string = $("#nombreMostrar").val().toString();
    let currentApe: string = $("#apellidosMostrar").val().toString();
    let currentEmail: string = $("#emailMostrar").val().toString();

    let user: string = $("#usuario").val().toString();
    let nombre: string = $("#nombre").val().toString();
    let ape: string = $("#apellidos").val().toString();
    let email: string = $("#email").val().toString();

    let textoErrores: string = "";

    try {

      if(currentUser==user && currentNombre==nombre && currentApe==ape && currentEmail==email ){
          textoErrores = "Debes modificar alguno de los campos";
          throw textoErrores;
      } else {
          if(user!="" && nombre!="" && ape!=" "&& email!=""){
              $("#formulario").submit();
          } else{
              textoErrores = "No puedes dejar campos vacios";
              throw textoErrores;
          }
      }

    } catch (err) {
        $("#errorTypescript").html("<div class='alert alert-danger text-center' role='alert'>" + textoErrores + " </div>")
        event.preventDefault()
    }
}

//comprobar campos de contraseñas y repetición
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

