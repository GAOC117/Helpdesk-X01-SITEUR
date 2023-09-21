const titulo = document.querySelector('#tituloDashboard').textContent;


const menuBtn = document.querySelector('.dashboard__sidebar__menu-btn');
let menuClosed = false;

menuBtn.addEventListener('click',()=>{
    if(!menuClosed){
        menuBtn.classList.add('close');
        menuClosed=true;
    }
    else{
        menuBtn.classList.remove('close');
        menuClosed=false;
    }


    $(".dashboard__sidebar-contenedor").toggleClass("activo");
    $(".dashboard__grid").toggleClass("activo");
    
    

})


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




