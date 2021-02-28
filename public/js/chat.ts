
(function ():void {
    $(function ():void {
        let mensaje = $('.message_input').val('').val().toString();
        envioDatosServidor(mensaje);
    });
}.call(this));


$( document ).ready(function():void {
    scroll()
})

function scroll():void{
    //el texto para que cada vez que pongo el texto vaya para abajo
    $('.messages').scrollTop( $('.messages').prop('scrollHeight') );
}

function envioDatosServidor(mensaje:string):void{
    $.ajax({
        url: "/proyecto/chat",
        method: "POST",
        data: mensaje
    }).done(function (res) {
        console.log(res)
    }).fail(function () {
        console.log("todo mal, nada bien")
    })
}
