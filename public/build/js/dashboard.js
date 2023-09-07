const titulo = document.querySelector('#tituloDashboard').textContent + ' - '
const animacion = 'fa-bounce';
const up = 'fa-chevron-up';
const down = 'fa-chevron-down';
document.addEventListener('DOMContentLoaded', function () {

    iniciarApp();
    
    
})

function iniciarApp() {
    
    
    titleScroller(titulo);
    hover();
    inicializador();
    clickSubmenu('ticket.dashboard__enlace', 'ul-tickets');
   
}

function inicializador(){
    const ticket = document.querySelector('.i-ticket');
    const empleado = document.querySelector('.i-user');
    const incidente = document.querySelector('.i-incidente');
    const departamento = document.querySelector('.i-departamentos');
    
    
    
    ticket.classList.add(down);
    empleado.classList.add(down);
    incidente.classList.add(down);
    departamento.classList.add(down);





}




function titleScroller(text) {
    document.title = text;
    setTimeout(function () {
        titleScroller(text.substring(1) + text.substring(0, 1));
    }, 200);
}

function hover()
{
    let clase ='';
    
    const botones = document.querySelectorAll('.dashboard__enlace');
        botones.forEach(boton=>{
            boton.addEventListener('mouseover', function(e){
               clase = '.'+e.target.className.split(' ')[0]+'-icono';
               
                 const icono = document.querySelector(clase);
              //  console.log(icono);
                icono.classList.add(animacion);

            })
        })


        botones.forEach(boton=>{
            boton.addEventListener('mouseleave', function(e){
               clase = '.'+e.target.className.split(' ')[0]+'-icono';
               
                 const icono = document.querySelector(clase);
                // console.log(icono);
                icono.classList.remove(animacion);

            })
        })
}


function clickSubmenu(claseMenu, claseSubmenu){
    const menu = document.querySelector('.'+claseMenu);
    const elemento = document.querySelector('.'+claseSubmenu);
    const menuIcono = document.querySelector('i-'+menu);

    // console.log(elemento);
    menu.addEventListener('click', function(){

        for(var i =0; i<=elemento.classList.length;i++)
        {
            if(elemento.classList[i].includes('-hidden')){
                // console.log("ya duermete");
                console.log(elemento.classList[i]+' '+i);
                elemento.classList.remove(claseSubmenu+'-hidden');
                elemento.classList.add(claseSubmenu+'-visible');
                
                break;
            }
            else if(elemento.classList[i].includes('-visible'))
            {
                console.log(elemento.classList[i]+' '+i);
                // console.log("no duermete");
                elemento.classList.add(claseSubmenu+'-hidden');
                elemento.classList.remove(claseSubmenu+'-visible');
                break;
            }
        }
 