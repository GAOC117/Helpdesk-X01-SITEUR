const titulo = document.querySelector('#tituloDashboard').textContent + ' - '

document.addEventListener('DOMContentLoaded', function () {

    iniciarApp();
    


})

function iniciarApp() {


    titleScroller(titulo);
}




function titleScroller(text) {
    document.title = text;

    setTimeout(function () {
        titleScroller(text.substring(1) + text.substring(0, 1));
    }, 200);
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