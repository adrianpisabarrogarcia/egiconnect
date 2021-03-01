$(document).ready(function (){
    //Asignamos la función correspondiente al formulario.
    try {
        $("#botonCrearProyecto").click(validarProyecto);
        $("#botonGenerarCodigo").click(generarNuevoCodigo);
        $("#borrarProyecto").click(borrarProyecto);
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

function actualizarProyecto():void {

    try {
        // @ts-ignore
        let textoErrores:Array<string> = ["No has modificado ningún campo","Debes añadir un nombre al proyecto", "Debes añadir una descripción al proyecto"];
        // @ts-ignore
        var nombre: string = $("#nombre").val();
        // @ts-ignore
        var des: string = $("#descripcion").val();
        // @ts-ignore
        var currentDes: string = $("#currentDes").val();
        // @ts-ignore
        var currentName: string = $("#currentName").val();

        if(nombre==currentName && des==currentDes){
            throw textoErrores[0];
        }else {
            if (nombre.length == 0 && des.length == 0) {
                throw textoErrores[1] + "<br>" + textoErrores[2] ;
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
        }


    }catch (e) {
        $("#erroresTypescriptActualizar").html("<div class='alert alert-danger text-center' role='alert'>" + e + " </div>")
        event.preventDefault()
    }

}


function generarNuevoCodigo():void {
    $("#formularioCodigo").submit();
}

function borrarProyecto():void {
    $("#formularioBorrar").submit();
}


