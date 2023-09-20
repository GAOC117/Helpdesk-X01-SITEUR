const titulo = document.querySelector('#tituloDashboard').textContent;
console.log(titulo.split('-')[1].trim());


document.addEventListener('DOMContentLoaded', function () {

    // marcarPaginaActual();

})



function marcarPaginaActual(){

    var clase = titulo.split('-')[1];
    clase = clase.toLowerCase().trim().split(' ');
    clase = '.'+clase[0]+'-'+clase[1];

    $(clase).parent().parent().find("ul").slideToggle(200);
    $(clase).parent().parent().addClass("activo");
    $(clase).addClass("activo");

}






$(".dashboard__sidebar-nav--menu > ul > li").click(function (e) {
    //remueve activo de quien ya lo tenga
    $(this).siblings().removeClass("activo");
    //agrega "activo" a lo clickeado
    $(this).toggleClass("activo");
    //si tiene un submenu abrelo
    $(this).find("ul").slideToggle(200);
    //cerrar otro submenu si esta abierto
    $(this).siblings().find("ul").slideUp();
    //remover clase activo de sub menu
    $(this).siblings().find("ul").find("li").removeClass("activo");
})


