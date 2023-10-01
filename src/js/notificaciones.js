
document.addEventListener('DOMContentLoaded', function () {

    obenerNotificaciones();

})


const alerta = document.querySelector('.notificaciones-icono');
const notificacionEnlace = document.querySelector('.notificaciones-enlace');

alerta.addEventListener('click', limpiarNotificaciones);
notificacionEnlace.addEventListener('click', limpiarNotificaciones);

setInterval(function () {

    obenerNotificaciones();

}, 2000);




async function obenerNotificaciones() {
    try {
    
    // par.innerHTML = '';
    // const url = 'http://'+direccion+':3000/api/obtenerEmpleado?idEmp=' + expedienteEmpleado.value;
    const url = '/api/obtenerNotificaciones';
    
    const resultado = await fetch(url);
    const result = await resultado.json();
    const idRol = result.idRol;
    const cantidad = result.cantidad;
    
    if (idRol !== '4') {
        
        const popup = document.querySelector('.notificaciones-icono');

        if (cantidad === '0') {

        
            popup.style.display = 'none';
        }

        else if (cantidad > 0 && cantidad <= 9) {
            popup.style.display = 'flex';
            popup.innerHTML = cantidad;
        }
        else if (cantidad > 9) {
            popup.style.display = 'flex';
            popup.innerHTML = '9+';

        }

    }
    







} catch (error) {
    console.log(error);
}


}



async function limpiarNotificaciones() {
    
    
    
    
    
    
    try {
    

    // par.innerHTML = '';
    // const url = 'http://'+direccion+':3000/api/obtenerEmpleado?idEmp=' + expedienteEmpleado.value;
    const url = '/api/limpiarNotificaciones';

    const resultado = await fetch(url);


    window.location.replace("/dashboard/ver-tickets");

} catch (error) {
    console.log(error);
}


}






