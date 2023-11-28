var segundos = 0;
var minutos = 0;
var intervalo;
var toastBootstrap;
var cantidadAuxiliar;




const alerta = document.querySelector('#notificacion-boton-texto');
const notificacionEnlace = document.querySelector('#notificaciones-enlace');
const btnCloseToast = document.querySelector('#btnCloseToast');
const toastTrigger = document.getElementById('liveToastBtn');
const toastLiveExample = document.getElementById('liveToast');
const btnToast = document.querySelector('.btn-toast');
const mensaje = document.querySelector('#mensaje-notificacion');
const timeAgo = document.querySelector('.tiempo-ago');

document.addEventListener('DOMContentLoaded', function () {

    obenerNotificaciones();


})





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


        const popup = document.querySelector('#notificacion-boton-texto');
        const popupHamburguesa = document.querySelector('#notificacion-boton-hamburguesa');

        if (idRol === '4')
            popupHamburguesa.style.display = 'none';




        if (idRol !== '4') {




            if (cantidad === '0') {


                popup.style.display = 'none';
                popupHamburguesa.style.display = 'none';
                if (toastBootstrap) {
                    console.log('1');
                    if (toastBootstrap.isShown()) {
                        timeAgo.innerHTML = '';
                        mensaje.innerHTML = '';
                        toastBootstrap.dispose();
                        clearInterval(intervalo);
                        console.log('2');

                    }
                }


            }

            else if (cantidad > 0 && cantidad <= 9) {
                popup.style.display = 'flex';
                popup.innerHTML = cantidad;
                popupHamburguesa.style.display = 'flex';

                if (cantidadAuxiliar !== cantidad) {
                    console.log('6');
                    mostrarToast(cantidad);
                    cantidadAuxiliar = cantidad;
                }
            }
            else if (cantidad > 9) {
                popup.style.display = 'flex';
                popup.innerHTML = '9+';
                popupHamburguesa.style.display = 'flex';

                if (cantidadAuxiliar !== cantidad) {

                    mostrarToast(cantidad);
                    cantidadAuxiliar = cantidad;
                }
            }



        }








    } catch (error) {
        console.log(error);
    }


}

async function limpiarNotificacionesBtnCerrar() {
    try {


        // par.innerHTML = '';
        // const url = 'http://'+direccion+':3000/api/obtenerEmpleado?idEmp=' + expedienteEmpleado.value;
        const url = '/api/limpiarNotificaciones';

        const resultado = await fetch(url);



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

        // if (!window.location.href.includes('ver-tickets'))
        window.location.replace("/dashboard/ver-tickets");

    } catch (error) {
        console.log(error);
    }


}


btnCloseToast.addEventListener('click', () => {



    timeAgo.innerHTML = '';
    mensaje.innerHTML = '';
    toastBootstrap = undefined;
    clearInterval(intervalo);
    console.log('7');
    if (window.location.href.includes('ver-tickets')) {

        cantidadAuxiliar = undefined;
        limpiarNotificacionesBtnCerrar();
        obenerNotificaciones();
    }
})





function mostrarToast(cantidad) {

    // toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
    minutos = 0;
    segundos = 0;

    if (toastBootstrap) {
        console.log('3');
        if (toastBootstrap.isShown()) {
            timeAgo.innerHTML = '';
            mensaje.innerHTML = '';
            toastBootstrap.dispose();
            clearInterval(intervalo);
            console.log('4');

        }
    }
    console.log('5');
    toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
    timeAgo.innerHTML = 'Justo ahora';
    if (cantidad > 0 && cantidad <= 9) {
        if (parseInt(cantidad) === 1){
            // alert("nuevo tickete")
            mensaje.innerHTML = 'Tienes 1 ticket nuevo';
        }
        else{
            // alert("entre aca");
            mensaje.innerHTML = 'Tienes ' + cantidad + ' tickets nuevos';
        }
    }
    else if (parseInt(cantidad) > 9) {
        mensaje.innerHTML = 'Tienes más de 10 tickets nuevos';
    }

    toastBootstrap.show();
    intervalo = setInterval(() => {
        segundos++;
        if (segundos % 60 === 0) {
            minutos++;
            if (minutos === 1) {
                timeAgo.innerHTML = 'Hace ' + minutos + ' minuto';
            }
            else {

                timeAgo.innerHTML = 'Hace ' + minutos + ' minutos';
            }
        }
        // console.log(segundos);
    }, 1000);

}



