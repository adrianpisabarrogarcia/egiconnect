import htmlString = JQuery.htmlString;

$(document).ready(function (){
    //Asignamos la función correspondiente al formulario.
    try {
        $("#botonCrearProyecto").click(validarProyecto);
        $("#botonGenerarCodigo").click(generarNuevoCodigo);
        $("#borrarProyecto").click(borrarProyecto);
        $("#botonUnirseProyecto").click(validarCodigoProyecto);
        $("#botonSubirArchivo").click(validarSubirArchivo);
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
        var cod: string = $("#codigoProyecto").val().toString();
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



$(".custom-file-input").on("change", function() {

var fileName = $(this).val().split("\\").pop();
$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
if(fileName=="") {
    $(this).siblings(".custom-file-label").addClass("selected").html("Selecciona un archivo");
}
});

function actualizarProyecto():void {

    try {
        // @ts-ignore
        let textoErrores:Array<string> = ["No has modificado ningún campo","Debes añadir un nombre al proyecto", "Debes añadir una descripción al proyecto"];
        // @ts-ignore
        let nombre: string = $("#nombre").val();
        // @ts-ignore
        let des: string = $("#descripcion2").val();
        // @ts-ignore
        let currentDes: string = $("#currentDes").val();
        // @ts-ignore
        let currentName: string = $("#currentName").val();

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


function validarSubirArchivo():void {

    validarFichero();

}


function validarFichero(){

    let campo:string = "#archivo";
    // @ts-ignore
    let nombreArchivo:string = $(campo).val();


    try{
        if (nombreArchivo != ""){
            let extension = nombreArchivo.substring(nombreArchivo.lastIndexOf('.'), nombreArchivo.length);
            extension = extension.substring(1,extension.length);


            if (extension == "jpg" || extension == "jpeg" || extension == "png" || extension == "pdf" || extension == "zip" || extension == "rar"){
                // @ts-ignore
                if(document.querySelector("#archivo").files[0].size <= 1024*1024){
                    $("#formularioFile").submit();
                }else{
                    throw "El archivo ha excedido el peso máximo";
                }
            }else{
                throw "Ese formato de archivo no se admite";
            }

        }else{
            throw "Primero debes seleccionar un archivo.";
        }

    }catch(e){
        event.preventDefault()
        $("#erroresTypescriptFile").html("<div class='mr-2 ml-2 alert alert-danger text-center' role='alert'>" + e + " </div>")

    }

}




function generarNuevoCodigo():void {
    $("#formularioCodigo").submit();
}

function borrarProyecto():void {
    $("#formularioBorrar").submit();
}


