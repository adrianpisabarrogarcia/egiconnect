
$( document ).ready(function():void {
    //evitar que al pulsar enter en un formulario no haga nada
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
    //nada más cargar la página hacer scroll hacia abajo
    scroll()
})

function scroll():void{
    //el texto para que cada vez que pongo el texto vaya para abajo
    $('.messages').scrollTop( $('.messages').prop('scrollHeight') );
}

//Enviar los datos mediante ajax
function envioDatosServidor():void{
    $.ajax({
        url: "/proyecto/chat",
        method: "POST",
        data:$('#formularioChat').serialize()
    }).done(function(){
        location.reload();
        $('input[type="text"]').val('');
        //console.log("todo bien")
    }).fail(function(){
        console.log("todo mal")
    })
}

//cuando le demos a enviar
$('.send_message').click(function():void {
    envioDatosServidor()
})

//cuando pulsemos enter eb el formulario de chat en específico
$('.message_input').keyup(function(e){
    if(e.keyCode == 13)
    {
        envioDatosServidor()
        e.preventDefault();
    }
});

