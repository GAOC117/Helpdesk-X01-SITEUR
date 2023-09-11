const titulo = document.querySelector('#tituloDashboard').textContent + ' - '
const animacion = 'fa-bounce';
const down = 'fa-chevron-down';
const right = 'fa-chevron-right';
var menus = document.querySelectorAll('.menu-principal');
const botones = document.querySelectorAll('.dashboard__enlace');

document.addEventListener('DOMContentLoaded', function () {

    iniciarApp();
    toggleMenu();
    hover();
    revisarSubMenu();


})

function iniciarApp() {


    titleScroller(titulo);
    // inicializador();

    //clickSubmenu('.ticket.dashboard__enlace');

}

function inicializador() {
    const ticket = document.querySelector('.i-tickets');
    const empleado = document.querySelector('.i-empleado');
    const incidente = document.querySelector('.i-incidentes');
    const departamento = document.querySelector('.i-departamento');



    ticket.classList.add(right);
    empleado.classList.add(right);
    incidente.classList.add(right);
    departamento.classList.add(right);





}




function titleScroller(text) {
    document.title = text;
    setTimeout(function () {
        titleScroller(text.substring(1) + text.substring(0, 1));
    }, 200);
}

function hover() {
    var clase = '';


    botones.forEach(boton => {
        boton.addEventListener('mouseover', (e) => {

            clase = '.' + e.target.className.split(' ')[0] + '-icono';
            // console.log(clase);

            const icono = document.querySelector(clase);
            //   console.log(icono);
            icono.classList.add(animacion);

        })
    })


    botones.forEach(boton => {
        boton.addEventListener('mouseleave', function (e) {
            clase = '.' + e.target.className.split(' ')[0] + '-icono';

            const icono = document.querySelector(clase);
            // console.log(icono);
            icono.classList.remove(animacion);

        })
    })
}


function toggleMenu() {


    
    
    menus.forEach(menu => {
        menu.addEventListener('click', (e) => {
            
            var restoMenus = [];
            var claseUlActual = '';
            var claseIconActual = '';
            var menuActual = '';
            
            // console.log(restoMenus);
            //tengo el menu(clase) actual y sus ul, i correspondientes (en base a clases)
            menuActual = e.target.className.split(' ')[0];
            claseUlActual = 'ul-' + menuActual;
            claseIconActual = 'i-' + menuActual;

            //obtengo el html correspondiente al Ul actual y al menu(flecha) actual
            const uListActual = document.querySelector('.' + claseUlActual);
            const flechaActual = document.querySelector('.' + claseIconActual);

            //obtengo todas las flechas
            const arrows = document.querySelectorAll('.icono');



            // console.log(flecha);
            // console.log(claseIcon);
            arrows.forEach(arrow => { //por cada flecha

                if (!arrow.classList.contains(menuActual)) //si no contiene el menu actual (clase)
                {
                    //lo agrego al listado de no menus
                    restoMenus.push(arrow.classList[0]);
                }
                
            })

            // console.log(restoMenus);
            //cmabio el sentido de la flecha actual
            if(flechaActual.classList.contains(down)){

                flechaActual.classList.add(right);
                flechaActual.classList.remove(down);
            }
            else{
                flechaActual.classList.add(down);
                flechaActual.classList.remove(right);
            }
            //al igual que le agrego o quito la clase '-hidden'
            uListActual.classList.toggle(claseUlActual + '-hidden');

            //por cada menu restante
            restoMenus.forEach(resto => {
                var menuNoActual = resto;
                var claseUlNoActual = 'ul-' + menuNoActual;
                var claseIconNoActual = 'i-' + menuNoActual;

                const uListNoActual = document.querySelector('.' + claseUlNoActual);
                const flechaNoActual = document.querySelector('.' + claseIconNoActual);

                flechaNoActual.classList.add(right);
                flechaNoActual.classList.remove(down);
                //al igual que le agrego o quito la clase '-hidden'
                if(!uListNoActual.classList.contains(claseUlNoActual + '-hidden'))
                {
                    console.log("no contiene");
                    uListNoActual.classList.add(claseUlNoActual + '-hidden');
                    
                }
                
            })


          
        })
    })
}

function revisarSubMenu(claseMenuActual) {

    const arrows = document.querySelectorAll('.icono');

    arrows.forEach(arrow => {
        if (arrow.classList.contains(claseMenuActual))
            console.log(claseMenuActual);
    })

}