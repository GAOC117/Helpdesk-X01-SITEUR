const titulo = document.querySelector('#tituloDashboard').textContent + ' - '
const animacion = 'fa-bounce';

document.addEventListener('DOMContentLoaded', function () {

    iniciarApp();
    
    
})

function iniciarApp() {
    
    
    titleScroller(titulo);
    hover();
   
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
                console.log(icono);
                icono.classList.add(animacion);

            })
        })


        botones.forEach(boton=>{
            boton.addEventListener('mouseleave', function(e){
               clase = '.'+e.target.className.split(' ')[0]+'-icono';
               
                 const icono = document.querySelector(clase);
                console.log(icono);
                icono.classList.remove(animacion);

            })
        })
}





// function dropdown() {
//     const fotoEmpleado = document.querySelector('.foto-empleado');
//     const cerrarSesion = document.querySelector('.dropdown');
//     cerrarSesion.style.display = 'flex';
//     fotoEmpleado.addEventListener('click', () => {
//         if (cerrarSesion.style.display === 'flex')
//             cerrarSesion.style.display = 'none';
//         else
//             cerrarSesion.style.display = 'flex';
//     })
// }