var camposError:Array<string> = []; //array para guardar aquellos campos que no pasen validación
var mensajesError:Array<string> =[]; //array donde se guarda el mensaje de error de cada campo erróneo
var idsCampos:Array<string> = [];

$(document).ready(function (){
    //Asignamos la función correspondiente al formulario.
    try {
        $("#botonRecuperarContrasena").click(validarCorreoUsuario);
    }catch (error){
        console.log(error)
    }

});


function validarCorreoUsuario():void {

    idsCampos = ["#email"];


    camposError = [];
    mensajesError = [];
    idsCampos.forEach(c => establecerEstiloNormal(c));

    validarEmail();
    var pass:String = generarContrasena();
    // @ts-ignore
    $("#pass").val(pass);


    comprobarYEstablecerEstilos();
    if (mensajesError.length == 0) {
        $("#formulario").submit()
    }
}


function validarEmail(){
    let campo :string= "#email"
    // @ts-ignore
    let email:string = $(campo).val();
    let patron = RegExp("^([A-z0-9]+[._]?)+[A-z0-9]+@([a-z]+.)+.[a-z]{2,4}$");
    try {
        if (email == "") {
            throw "Debes insertar tu email.";
        }
        if (!patron.test(email)) {
            throw "Email no válido.";
        }
    }
    catch(err){
        mensajesError.push(err);
        camposError.push(campo);
    }
}

function comprobarYEstablecerEstilos(){

    if (camposError.length>0){
        aplicarEstiloError();
    }
}

function aplicarEstiloError(){
    camposError.forEach(c => $(c).css("border"," red solid 1px"));
    camposError.forEach(c => $(c).css("color"," red"));
}


function  generarContrasena():String {
    var caracteres:Array<string> = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","0","1","2","3","4","5","6","7","8","9"];
    var numeroAleatorio:number = 3;
    var pass:String = "";

    // paso 2 - escribir x caracteres

    for(var i = 0; i<8; i++){
        numeroAleatorio = parseInt(String(Math.random() * caracteres.length));
        pass += caracteres[numeroAleatorio];
    }
    return pass;
}


function establecerEstiloNormal(parametro){

    $(parametro).css("color"," black");
    $(parametro).css("border"," 1px solid #d1d3e2");
    $(".custom-file").css("border"," none");
    $(".custom-file-label").css("color"," black");

}



