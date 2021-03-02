function annadirTareas() {
    try {
        var errores = "";
        var fechaVencimiento = $('#fecha-vencimiento').val().toString();
        if (fechaVencimiento == "") {
            errores = "Existen campos vacíos";
            throw errores;
        }
        else {
            var fechaActual = new Date();
            var fecaVencimientoDate = new Date(fechaVencimiento);
            if (fecaVencimientoDate < fechaActual) {
                errores = "La fecha de vencimiento no puede ser menor a la fecha actual";
                throw errores;
            }
        }
    }
    catch (e) {
        $("#erroresTypescript").html("<div class='alert alert-danger text-center' role='alert'>" + e + " </div>");
        event.preventDefault();
    }
}
