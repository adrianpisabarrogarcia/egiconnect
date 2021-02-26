$(document).ready(function (){
    //Asignamos la función correspondiente al formulario.
    try {
        $("#botonCrearProyecto").click(validarProyecto);
        $("#botonUnirseProyecto").click(validarCodigoProyecto);
    }catch (error){
        console.log(error)
    }

});


function validarProyecto():void {

    try {
        // @ts-ignore
        let textoErrores:Array<string> = ["Debes añadir un nombre al proyecto", "Debes añadir una descripción al proyecto"];
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


function validarCodigoProyecto():void {

    try {
        // @ts-ignore
        let textoErrores:string = "El codígo debe tener 5 carácteres";

        // @ts-ignore
        var cod: string = $("#codigoProyecto").val();
        var codUpper :string = cod.toUpperCase();
        $("#codigoProyecto").val(codUpper);

        if (cod.length == 5) {
            $("#formulario2").submit();
        }else {
            throw textoErrores;
        }

    }catch (e) {
        $("#erroresTypescript2").html("<div class='alert alert-danger text-center' role='alert'>" + e + " </div>")
        event.preventDefault()
    }

}


