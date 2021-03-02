function annadirTareas(): void {

    try {
        let errores: string = "";
        let fechaVencimiento: string = $('#fecha-vencimiento').val().toString();

        if (fechaVencimiento == ""){
            errores = "Existen campos vacíos"
            throw errores
        }else{
            let fechaActual:Date = new Date();
            let fecaVencimientoDate:Date = new Date(fechaVencimiento);
            if (fecaVencimientoDate<fechaActual){
                errores = "La fecha de vencimiento no puede ser menor a la fecha actual"
                throw errores
            }
        }

    } catch (e) {
        $("#erroresTypescript").html("<div class='alert alert-danger text-center' role='alert'>" + e + " </div>")
        event.preventDefault();
    }
}
