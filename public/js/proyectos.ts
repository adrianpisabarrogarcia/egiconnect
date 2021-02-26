$(document).ready(function (){
    //Asignamos la función correspondiente al formulario.
    try {
        $("#botonCrearProyecto").click(validarProyecto);
    }catch (error){
        console.log(error)
    }

});


function validarProyecto():void {

    try {
        // @ts-ignore
        let textoErrores:Array<string> = ["Debes añadir un nombre al proyecto", "Debes añadir una descripción al proyecto"];

        // @ts-ignore
        var cod: string = generarCodigo();
        // @ts-ignore
        $("#codigo").val(cod);
        // @ts-ignore
        var nombre: string = $("#nombre").val();
        // @ts-ignore
        var des: string = $("#descripcion").val();


        if (nombre.length == 0 && des.length == 0) {
            throw textoErrores[0] + "<br>" + textoErrores[1] ;
        }else {
            if (nombre.length == 0) {
                throw textoErrores[0];
            }else {
                if (des.length == 0){
                    throw textoErrores[1];
                }else {
                    $("#formulario").submit();
                }
            }

        }

    }catch (e) {
        $("#erroresTypescript").html("<div class='alert alert-danger text-center' role='alert'>" + e + " </div>")
        event.preventDefault()
    }

}

function  generarCodigo():String {
    var caracteres:Array<string> = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
    var numeroAleatorio:number = 3;
    var cod:String = "";


    for(var i = 0; i<8; i++){
        numeroAleatorio = parseInt(String(Math.random() * caracteres.length));
        cod += caracteres[numeroAleatorio];
    }
    return cod;
}

