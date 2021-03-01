$(document).ready(function () {
    $("form").keypress(function (e) {
        if (e.which == 13) {
            return false;
        }
    });
    scroll();
});
function scroll() {
    //el texto para que cada vez que pongo el texto vaya para abajo
    $('.messages').scrollTop($('.messages').prop('scrollHeight'));
}
function envioDatosServidor() {
    $.ajax({
        url: "/proyecto/chat",
        method: "POST",
        data: $('#formulario').serialize()
    }).done(function () {
        location.reload();
        $('input[type="text"]').val('');
        //console.log("todo bien")
    }).fail(function () {
        console.log("todo mal");
    });
}
$('.send_message').click(function () {
    envioDatosServidor();
});
$('.message_input').keyup(function (e) {
    if (e.keyCode == 13) {
        envioDatosServidor();
        e.preventDefault();
    }
});
