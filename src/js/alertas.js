$(document).ready(function () {
    $('.filter').multifilter()
})


setTimeout(function () {

    quitarAlerta();

}, 2000);


function quitarAlerta(){
  if(document.querySelector(".div-alerta")){
    // var div_alerta = document.querySelector(".div-alerta");
    $(".div-alerta").fadeOut(1000);

    // div_alerta.style.display = 'none';

}

}