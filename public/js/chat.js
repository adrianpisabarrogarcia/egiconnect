//variable global con el mensaje que escriba el usuario conectado
var mensaje = "";
//código de una api
(function () {
    var Message;
    Message = function (arg) {
        this.text = arg.text, this.message_side = arg.message_side;
        this.draw = function (_this) {
            return function () {
                var $message;
                $message = $($('.message_template').clone().html());
                $message.addClass(_this.message_side).find('.text').html(_this.text);
                $('.messages').append($message);
                return setTimeout(function () {
                    return $message.addClass('appeared');
                }, 0);
            };
        }(this);
        return this;
    };
    $(function () {
        var getMessageText, message_side, sendMessage;
        message_side = 'right';
        getMessageText = function () {
            var $message_input;
            $message_input = $('.message_input');
            //varible global con el mensaje - @author: adrian
            mensaje = $(".message_input").val().toString();
            return $message_input.val();
        };
        sendMessage = function (text) {
            var $messages, message;
            if (text.trim() === '') {
                return;
            }
            $('.message_input').val('');
            $messages = $('.messages');
            /***
             * @author: adrian y victor
             * comentarios para deshabilitar funcionalidades de la api
             */
            //no queremos que los mensajes que nosotros escribimos salgan a la izquierda
            //message_side = message_side === 'left' ? 'right' : 'left';
            message = new Message({
                text: text,
                message_side: message_side
            });
            message.draw();
            /**
             * @author: adrian y victor
             * de estas 2 líneas de código
             */
            //el texto para que cada vez que pongo el texto vaya para abajo
            scroll();
        };
        $('.send_message').click(function (e) {
            return sendMessage(getMessageText());
        });
        $('.message_input').keyup(function (e) {
            if (e.which === 13) {
                return sendMessage(getMessageText());
            }
        });
        envioDatosServidor();
    });
}.call(this));
/***
 * @author adrian y víctor a partir de aquí
 */
$(document).ready(function () {
    imprimirMensajes();
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
        data: mensaje
    }).done(function (res) {
        console.log(res);
    }).fail(function () {
        console.log("todo mal, nada bien");
    });
}
function imprimirMensajes() {
}
