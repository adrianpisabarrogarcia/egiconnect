$(document).ready(function () {
    alert(screen.height);
    var alturaNumero = screen.height - 56 - 200 - 100;
    alert(alturaNumero);
    $('.messages').css('height', alturaNumero);
});
