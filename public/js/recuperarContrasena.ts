$(document).ready(function (){
    //Asignamos la función correspondiente al formulario.
    try {
        $("#botonRecuperarContrasena").click(validarCorreoUsuario);
    }catch (error){
        console.log(error)
    }

});


function validarCorreoUsuario():void {

    // @ts-ignore
    var pass:string = generarContrasena();
    // @ts-ignore
    $("#pass").val(pass);
    $("#formulario").submit()

}

function  generarContrasena():String {
    var caracteres:Array<string> = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","0","1","2","3","4","5","6","7","8","9"];
    var numeroAleatorio:number = 3;
    var pass:String = "";


    for(var i = 0; i<8; i++){
        numeroAleatorio = parseInt(String(Math.random() * caracteres.length));
        pass += caracteres[numeroAleatorio];
    }
    return pass;
}


