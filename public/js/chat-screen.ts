$(document).ready(function (){
    alert(screen.height)
    let alturaNumero:number = screen.height - 56 - 200 - 100;
    alert(alturaNumero)
    $('.messages').css('height', alturaNumero)

});
