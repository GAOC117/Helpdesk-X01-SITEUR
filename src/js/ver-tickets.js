
var paginaActual = 1;
var folioBusqueda = '';
var fechaBusqueda = '';
var clasificacionBusqueda = '';
var subclasificacionBusqueda = '';
var atiendeBusqueda = '';
var requiereBusqueda = '';
var estadoBusqueda = '';
var rangoChecked = false;

var pagina_siguiente;
var pagina_anterior;
var html_siguiente;
const btnSiguiente = document.querySelector('#btnSiguiente');
const btnAnterior = document.querySelector('#btnAnterior');
const rangoCheck = document.querySelector("#checkFechas");
const limpiarFiltros = document.querySelector('#limpiarFiltros');



rangoCheck.addEventListener('change', function () {
    if (rangoCheck.checked)
        rangoChecked = true;
    else
        rangoChecked = false;

        llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda,rangoChecked,fechaDesde.value,fechaHasta.value);

})
var total_registros_anterior = 0;
var folioModal;



limpiarNotificaciones();
busqueda();
// paginas();
document.addEventListener('DOMContentLoaded', function () {


    var date = new Date();

    // Get year, month, and day part from the date
    var year = date.toLocaleString("default", { year: "numeric" });
    var month = date.toLocaleString("default", { month: "2-digit" });
    var day = date.toLocaleString("default", { day: "2-digit" });

    // Generate yyyy-mm-dd date string
    var hoy = year + "-" + month + "-" + day;

    const fechaDesde = document.querySelector('#fechaDesde');
    const fechaHasta = document.querySelector('#fechaHasta');

    fechaDesde.value = hoy;
    fechaHasta.value = hoy;

    fechaDesde.addEventListener('change',function(){

        llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda,rangoChecked,fechaDesde.value,fechaHasta.value);
        
    })
    fechaHasta.addEventListener('change',function(){
        
        llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda,rangoChecked,fechaDesde.value,fechaHasta.value);
        
    })


    limpiarFiltros.addEventListener('click', function () {

        const folio = document.querySelector("#folioBusqueda");
        const fecha = document.querySelector("#fechaBusqueda");
        const atiende = document.querySelector("#atiendeBusqueda");
        const requiere = document.querySelector("#requiereBusqueda");
        const estado = document.querySelector("#estadoBusqueda");
        const clasificacion = document.querySelector("#clasificacionBusqueda");
        const subclasificacion = document.querySelector("#subclasificacionBusqueda");

        folio.value='';
        fecha.value='';
        atiende.value='';
        requiere.value='';
        estado.value='';
        clasificacion.value='';
        subclasificacion.value='';
        fechaDesde.value=hoy;
        fechaHasta.value=hoy;
        rangoCheck.checked=false;
        

        paginaActual = 1;
        folioBusqueda = '';
        fechaBusqueda = '';
        clasificacionBusqueda = '';
        subclasificacionBusqueda = '';
        atiendeBusqueda = '';
        requiereBusqueda = '';
        estadoBusqueda = '';
        rangoChecked = false;

        llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda,rangoChecked,fechaDesde.value,fechaHasta.value);

    })
   
 



    llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda,rangoChecked,fechaDesde.value,fechaHasta.value);
    btnSiguiente.addEventListener('click', function () {
        if (paginaActual < pagina_siguiente) {

            paginaActual++;
        }

        llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda, rangoChecked,fechaDesde.value,fechaHasta.value);


    })

    btnAnterior.addEventListener('click', function () {
        if (paginaActual >= pagina_anterior) {

            paginaActual--;
        }

        llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda, rangoChecked,fechaDesde.value,fechaHasta.value);



    })






})


function modal() {
    const botonesFolios = document.querySelectorAll('.btnFolio');
    botonesFolios.forEach(botonFolio => {
        botonFolio.addEventListener('click', function (e) {

            folioModal = parseInt(e.target.dataset.folio);
            abrirModal(folioModal);
        })

    })
}

// setTimeOut(function () {
//         paginas();


//     }, 300);

// function alerta(){
//     const boton = document.querySelector('#botonsito');

//     boton.addEventListener('click',function(){
//         console.log(paginaActual);
//         paginaActual++;
//     });
// }

function prueba() {

}



const folio = document.querySelector('#idFolio');
// const asigna = document.querySelector('#idAsigna');
const atiende = document.querySelector('#idAtiende');
const fecha = document.querySelector('#idFecha');
const requiere = document.querySelector('#idRequiere');
const estado = document.querySelector('#idEstado');
const clasificacion = document.querySelector('#idClasificacion');
const subclasificacion = document.querySelector('#idSubclasificacion');
const comentarios = document.querySelector('#idComentarios');
const comentariosSoporte = document.querySelector('#idComentariosSoporte');

setInterval(function () {
    //  if (folio.value === '' && atiende.value === '' && fecha.value === '' && estado.value === '' && subclasificacion.value === '') {
    // alert("vacio");
    // llenarTablaTickets(paginaActual, folioBusqueda);
    // }

    llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda,rangoChecked,fechaDesde.value,fechaHasta.value);

}, 2000);


setTimeout(function () {

    fadeOutAlerta();

}, 2000);




async function limpiarNotificaciones() {

    try {


        // par.innerHTML = '';
        // const url = 'http://'+direccion+':3000/api/obtenerEmpleado?idEmp=' + expedienteEmpleado.value;
        const url = '/api/limpiarNotificaciones';

        const resultado = await fetch(url);
        // const result = await resultado.json();

        // if(result.idRol!=='4'){
        //     const popup = document.querySelector('.notificaciones-icono');
        // }






    } catch (error) {
        console.log(error);
    }


}









function mostrarMesEnCurso() {
    const fecha = new Date();
    var mes = fecha.getMonth() + 1;
    const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]


    const inputFecha = document.querySelector('#idFecha');

    inputFecha.addEventListener()

    inputFecha.value = meses[mes - 1];



}







function busqueda() {
    const folio = document.querySelector("#folioBusqueda");
    const fecha = document.querySelector("#fechaBusqueda");
    const atiende = document.querySelector("#atiendeBusqueda");
    const requiere = document.querySelector("#requiereBusqueda");
    const estado = document.querySelector("#estadoBusqueda");
    const clasificacion = document.querySelector("#clasificacionBusqueda");
    const subclasificacion = document.querySelector("#subclasificacionBusqueda");

    folio.addEventListener('keyup', function () {
        folioBusqueda = folio.value;
        paginaActual = 1;
        llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda,rangoChecked,fechaDesde.value,fechaHasta.value);
    });

    fecha.addEventListener('keyup', function () {
        fechaBusqueda = fecha.value;
        paginaActual = 1;
        llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda,rangoChecked,fechaDesde.value,fechaHasta.value);
    });

    atiende.addEventListener('keyup', function () {
        atiendeBusqueda = atiende.value;
        paginaActual = 1;
        llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda,rangoChecked,fechaDesde.value,fechaHasta.value);
    });

    requiere.addEventListener('keyup', function () {
        requiereBusqueda = requiere.value;
        paginaActual = 1;
        llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda,rangoChecked,fechaDesde.value,fechaHasta.value);
    });

    estado.addEventListener('keyup', function () {
        estadoBusqueda = estado.value;
        paginaActual = 1;
        llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda, rangoChecked,fechaDesde.value,fechaHasta.value);
    });

    clasificacion.addEventListener('keyup', function () {
        clasificacionBusqueda = clasificacion.value;
        paginaActual = 1;
        llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda,rangoChecked,fechaDesde.value,fechaHasta.value);
    });

    subclasificacion.addEventListener('keyup', function () {
        subclasificacionBusqueda = subclasificacion.value;
        paginaActual = 1;
        llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda,rangoChecked,fechaDesde.value,fechaHasta.value);
    });

}


async function llenarTablaTickets(page, folio, fecha, atiende, requiere, estado, clasificacion, subclasificacion, rangoBusqueda,desde,hasta) {

    const tBody = document.querySelector('.tabla__body.tickets');
    const paginas = document.querySelector('#paginas');

    // const empleadoPromise = obtenerRol();

    try {

        // const empleado = await empleadoPromise;
        // const idRol = empleado.idRol;




        const url = '/api/obtenerTablaTickets?page=' + page + '&folio=' + folio + '&fecha=' + String(fecha) + '&atiende=' + atiende + '&requiere=' + requiere + '&estado=' + estado + '&clasificacion=' + clasificacion + '&subclasificacion=' + subclasificacion +'&rangoChecked='+rangoBusqueda+'&fechaDesde='+desde+'&fechaHasta='+hasta;
        // console.log(url);





        const resultado = await fetch(url);
        const result = await resultado.json();


        const tablaRows = result.tablaRows;
        const total_registros_actual = result.total_registros;
        const total_paginas = result.total_paginas;

        const paginacion = document.querySelector('.paginacion');
        if (total_paginas === 0 || total_paginas === 1) {
            paginacion.style.visibility = 'hidden';
        }
        else {

            paginacion.style.visibility = 'visible';
        }

        const idRol = result.idRol;
        const nombreLogueado = result.nombreLogueado;
        pagina_siguiente = result.pagina_siguiente;
        pagina_anterior = result.pagina_anterior;
        html_siguiente = result.html_siguiente;

        if (total_registros_actual > total_registros_anterior) {
            total_registros_anterior = total_registros_actual;
            paginaActual = 1;
        }

        // const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

        // alert(idRol);

        tBody.innerHTML = "";


        tablaRows.forEach(row => {

            const tr = document.createElement('tr');
            const td_idTicket = document.createElement('td');
            const btnId = document.createElement('button');
            const td_fechaCaptura = document.createElement('td');
            // const td_nombreAsigna = document.createElement('td');
            const td_atiende = document.createElement('td');
            const td_nombreRequiere = document.createElement('td');
            const td_estadoTicket = document.createElement('td');
            const p_estadoTicket = document.createElement('p');
            const td_clasificacion = document.createElement('td');
            const td_subclasificacion = document.createElement('td');
            const td_comentarios = document.createElement('td');
            const td_comentariosSoporte = document.createElement('td');
            const td_acciones = document.createElement('td');
            const div_acciones = document.createElement('DIV');

            const { idTicket, fechaCaptura, atiende, nombreRequiere, estadoTicket, clasificacion, subclasificacion, comentarios, comentariosSoporte } = row;

            // console.log(fechaCaptura);
            // tr.classList.add('tabla__row');





            // td_idTicket.textContent = idTicket;
            btnId.textContent = idTicket;
            btnId.setAttribute('value', idTicket);
            btnId.setAttribute('data-folio', idTicket);
            btnId.setAttribute('data-bs-toggle', 'modal');
            btnId.setAttribute('data-bs-target', '#infoModal');
            // td_fechaCaptura.textContent = fechaCaptura.split('-')[2] + '/' + meses[mes - 1] + '/' + fechaCaptura.split('-')[0];
            td_fechaCaptura.textContent = fechaCaptura;//.split('-')[2] + '/' + fechaCaptura.split('-')[1] + '/' + fechaCaptura.split('-')[0];
            // td_nombreAsigna.textContent = nombreAsigna;
            td_atiende.textContent = atiende;
            td_nombreRequiere.textContent = nombreRequiere;
            p_estadoTicket.textContent = estadoTicket;
            td_clasificacion.textContent = clasificacion;
            td_subclasificacion.textContent = subclasificacion;
            td_comentarios.textContent = comentarios;
            td_comentariosSoporte.textContent = comentariosSoporte;

            td_idTicket.classList.add('text-center');
            btnId.classList.add('btn', 'btn-info', 'text-center', 'btnFolio', 'fs-4');
            td_fechaCaptura.classList.add('tabla__td', 'text-center');
            // td_nombreAsigna.classList.add('tabla__td');
            td_atiende.classList.add('tabla__td', 'text-center');
            td_nombreRequiere.classList.add('tabla__td', 'text-center');
            td_estadoTicket.classList.add('tabla__td', 'text-center');
            td_clasificacion.classList.add('tabla__td', 'text-center');
            td_subclasificacion.classList.add('tabla__td', 'text-center');
            td_comentarios.classList.add('tabla__td', 'text-center');
            td_comentariosSoporte.classList.add('tabla__td', 'text-center');
            td_acciones.classList.add('tabla__td', 'text-center');

            if (estadoTicket === 'Abierto')
                p_estadoTicket.classList.add('text-white', 'bg-danger', 'bg-opacity-75', 'rounded-5', 'w-50', 'm-auto');
            if (estadoTicket === 'Pausado')
                p_estadoTicket.classList.add('text-white', 'bg-secondary', 'bg-opacity-75', 'rounded-5', 'w-50', 'm-auto');
            if (estadoTicket === 'Escalado')
                p_estadoTicket.classList.add('text-white', 'bg-warning', 'bg-opacity-75', 'rounded-5', 'w-50', 'm-auto');
            if (estadoTicket === 'Cerrado')
                p_estadoTicket.classList.add('text-white', 'bg-success', 'bg-opacity-75', 'rounded-5', 'w-50', 'm-auto');

            td_estadoTicket.appendChild(p_estadoTicket);
            //aqui designar clases para los colores de abierto, cerrado, escalado, cerrado



            // div_acciones.classList.add('tabla__tickets--botones');
            // if (idRol === '4')
            //     div_acciones.classList.add('tabla__tickets--botones--colaborador');
            div_acciones.classList.add('container', 'd-flex', 'gap-2');
            if (idRol === '4')
                div_acciones.classList.add('container', 'd-flex', 'gap-2');
            // div_acciones.innerHTML = "<a href='/dashboard/historial-tickets?id=" + idTicket + "' title='Historial del ticket' class='tabla__boton-azul tabla__boton'><i class='fa-solid fa-calendar-days fa-xl'></i></a>";
            div_acciones.innerHTML = "<a href='/dashboard/historial-tickets?id=" + idTicket + "' title='Historial del ticket' class='fs-2 btn btn-primary btn-sm'><i class='bi bi-calendar2-week'></i></a>";


            if (idRol === '2')  //poner aqui al admin tambien si se requiere
            {
                if (estadoTicket === 'Abierto' || estadoTicket === 'Pausado' || estadoTicket === 'Escalado') {
                    if (atiende === 'Sin asignar') {
                        // div_acciones.innerHTML += "<a href='/dashboard/asignar-tickets?id=" + idTicket + "' title='Asignar ticket' class='tabla__boton-verde-limon tabla__boton'><i class='fa-solid fa-person-walking-arrow-loop-left fa-xl'></i></i></a>";
                        // div_acciones.innerHTML += "<a href='/dashboard/asignar-tickets?id=" + idTicket + "' title='Asignar ticket' class='tabla__boton-verde-limon tabla__boton'><i class='fa-solid fa-person-walking-arrow-loop-left fa-xl'></i></i></a>";
                        div_acciones.innerHTML += "<a href='/dashboard/asignar-tickets?id=" + idTicket + "' title='Asignar ticket' class='fs-2 btn btn-info btn-sm'><i class='bi bi-person-up'></i></i></a>";
                    }
                    if (atiende !== 'Sin asignar') {

                        // div_acciones.innerHTML += "<a href='/dashboard/pausar-tickets?id=" + idTicket + "' title='Pausar ticket' class='tabla__boton-gris tabla__boton'><i class='fa-solid fa-circle-pause fa-xl'></i></a>";
                        div_acciones.innerHTML += "<a href='/dashboard/pausar-tickets?id=" + idTicket + "' title='Pausar ticket' class='fs-2 btn btn-secondary btn-sm'><i class='bi bi-pause-circle'></i></a>";
                        // div_acciones.innerHTML += "<a href='/dashboard/escalar-tickets?id=" + idTicket + "' title='Escalar ticket' class='tabla__boton-naranja tabla__boton'><i class='fa-solid fa-arrow-trend-up fa-xl'></i></a>";
                        div_acciones.innerHTML += "<a href='/dashboard/escalar-tickets?id=" + idTicket + "' title='Escalar ticket' class='fs-2 btn btn-warning btn-sm'><i class='bi bi-bezier2'></i></a>";

                        // div_acciones.innerHTML += "<a href='/dashboard/cerrar-tickets?id=" + idTicket + "' title='Cerrar ticket' class='tabla__boton-verde tabla__boton'><i class='fa-solid fa-circle-check fa-xl'></i></a>";
                        div_acciones.innerHTML += "<a href='/dashboard/cerrar-tickets?id=" + idTicket + "' title='Cerrar ticket' class='fs-2 btn btn-success btn-sm'><i class='bi bi-check2-circle'></i></a>";

                    }

                }
                else {
                    div_acciones.innerHTML += "<p class='text-white bg-success bg-opacity-75 rounded-5 w-75 m-auto'>Ticket cerrado</p>";
                }
            }
            if (idRol === '1' || idRol === '3') //cambiar el rol 1 de aqui hacia arriba donde esta mesa
            {
                if (estadoTicket === 'Abierto' || estadoTicket === 'Pausado' || estadoTicket === 'Escalado') {


                    if (atiende !== 'Sin asignar') {

                        if (atiende === nombreLogueado) {
                            // div_acciones.innerHTML += "<a href='/dashboard/pausar-tickets?id=" + idTicket + "' title='Pausar ticket' class='tabla__boton-gris tabla__boton'><i class='fa-solid fa-circle-pause fa-xl'></i></a>";
                            div_acciones.innerHTML += "<a href='/dashboard/pausar-tickets?id=" + idTicket + "' title='Pausar ticket' class='fs-2 btn btn-secondary btn-sm'><i class='bi bi-pause-circle'></i></a>";

                            //si comento el if no puede escalar tickets propios el admin
                            if (idRol === '1') {
                                // div_acciones.innerHTML += "<a href='/dashboard/escalar-tickets?id=" + idTicket + "' title='Escalar ticket' class='tabla__boton-naranja tabla__boton'><i class='fa-solid fa-arrow-trend-up fa-xl'></i></a>";
                                div_acciones.innerHTML += "<a href='/dashboard/escalar-tickets?id=" + idTicket + "' title='Escalar ticket' class='fs-2 btn btn-warning btn-sm'><i class='bi bi-bezier2'></i></a>";
                            }

                            // div_acciones.innerHTML += "<a href='/dashboard/cerrar-tickets?id=" + idTicket + "' title='Cerrar ticket' class='tabla__boton-verde tabla__boton'><i class='fa-solid fa-circle-check fa-xl'></i></a>";

                            div_acciones.innerHTML += "<a href='/dashboard/cerrar-tickets?id=" + idTicket + "' title='Cerrar ticket' class='fs-2 btn btn-success btn-sm'><i class='bi bi-check2-circle'></i></a>";
                        }
                    }
                    // if (atiende !== 'Sin asignar') {
                    //     div_acciones.innerHTML += "<a href='/dashboard/cerrar-tickets?id=" + idTicket + "' title='Cerrar ticket' class='tabla__boton-verde tabla__boton'><i class='fa-solid fa-circle-check fa-xl'></i></a>";
                    // }
                }
                else {
                    div_acciones.innerHTML += "<p class='text-white bg-success bg-opacity-75 rounded-5 w-75 mx-auto m-auto'>Ticket cerrado</p>";
                }
            }
            if (idRol === '4') {
                if (estadoTicket === 'Cerrado') {

                    div_acciones.innerHTML += "<p class='tabla__cerrado'>Ticket cerrado</p>";
                }

            }





            td_idTicket.appendChild(btnId);
            tr.appendChild(td_idTicket);
            tr.appendChild(td_fechaCaptura);
            // tr.appendChild(td_nombreAsigna);
            tr.appendChild(td_atiende);
            tr.appendChild(td_nombreRequiere);
            tr.appendChild(td_estadoTicket);
            tr.appendChild(td_clasificacion);
            tr.appendChild(td_subclasificacion);
            tr.appendChild(td_comentarios);
            tr.appendChild(td_comentariosSoporte);
            td_acciones.appendChild(div_acciones);

            tr.appendChild(td_acciones);
            tBody.appendChild(tr);




            if (pagina_siguiente) {
                btnSiguiente.disabled = false;

            }
            else {
                btnSiguiente.disabled = true;
            }

            if (pagina_anterior) {
                btnAnterior.disabled = false;

            }
            else {
                btnAnterior.disabled = true;
            }


            var html = '';
            const numeroPaginasMostrar = 5 //el numero de botones que quiero mostrar


            var valorInicial = 1;
            var valorFinal = total_paginas;

            if (total_paginas > 5) {
                if (paginaActual <= numeroPaginasMostrar) {
                    valorInicial = 1;
                    valorFinal = numeroPaginasMostrar;
                    // console.log("primer if");
                }
                else if (paginaActual + 2 === total_paginas || paginaActual + 2 > total_paginas) {
                    valorInicial = total_paginas - 4;
                    valorFinal = total_paginas;

                    // console.log("segundo if");
                }
                else {
                    var valorInicial = paginaActual - 2;
                    var valorFinal = paginaActual + 2;

                }
            }





            // console.log('pagina actual: ' + paginaActual + ' total paginas: ' + total_paginas + ' valor Inicial: ' + valorInicial + ' valor Final: ' + valorFinal);


            for (var i = valorInicial; i <= valorFinal; i++) {
                html += ' <button  class="btn btn-outline-primary fs-3 botonPaginas" data-pagina =' + i + '>' + i + ' </button>'
            }

            paginas.innerHTML = html;





            const botones = document.querySelectorAll('.botonPaginas');


            botones.forEach(boton => {
                boton.addEventListener('click', function (e) {

                    pagina = parseInt(e.target.dataset.pagina);
                    paginaActual = pagina;
                    llenarTablaTickets(paginaActual, folioBusqueda, fechaBusqueda, atiendeBusqueda, requiereBusqueda, estadoBusqueda, clasificacionBusqueda, subclasificacionBusqueda,rangoChecked,fechaDesde.value,fechaHasta.value);


                })

                if (parseInt(boton.dataset.pagina) === parseInt(paginaActual)) {

                    //    console.log('si'); 
                    boton.classList.remove('btn-outline-primary');
                    boton.classList.add('btn-primary');
                }

                else {
                    boton.classList.add('btn-outline-primary');
                    boton.classList.remove('btn-primary');
                }


            })







        });//foreach

        modal();


    } catch (error) {
        console.log(error);
    }



    // $(document).ready(function () {
    //     $('.filter').multifilter()
    // })


}




function fadeOutAlerta() {
    $('.div-ver-tickets').fadeOut(1000);
}




function paginas() {
    const botones = document.querySelectorAll('.botonPaginas');

    botones.forEach(boton => {
        boton.addEventListener('click', function (e) {
            console.log("memo");
            //         pagina = parseInt(e.target.dataset.pagina);
            //         paginaActual = pagina;
            //         llenarTablaTickets(paginaActual);
        })

        //      if (parseInt(boton.dataset.pagina) === parseInt(paginaActual))
        // //    console.log('si'); 

        //     else

        //         boton.classList.remove('botonPaginaActivo');


    })
}


//HACER FUNCION QUE SE LLAME CUANDO SE PRESIONA BOTON, UNA VEZ HECHO ESTO EXPORTAR EXCEL CON DICHA FUNCION


async function abrirModal(folio) {

    let modalInfoTicket = document.querySelector('#infoModal');

    try {


        const url = '/api/modal?folio=' + folio;

        const resultado = await fetch(url);
        const result = await resultado.json();
        const infoTicket = result.infoTicket;

        console.log(infoTicket);

        modalInfoTicket.addEventListener('shown.bs.modal', e => {
            let inputFolio = modalInfoTicket.querySelector('.modal-body #folio');
            let inputRequiere = modalInfoTicket.querySelector('.modal-body #requiere');
            let departamento = modalInfoTicket.querySelector('.modal-body #departamento');
            let extension = modalInfoTicket.querySelector('.modal-body #extension');
            let email = modalInfoTicket.querySelector('.modal-body #email');
            let clasificacion = modalInfoTicket.querySelector('.modal-body #clasificacion');
            let subclasificacion = modalInfoTicket.querySelector('.modal-body #subclasificacion');
            let comentariosReporte = modalInfoTicket.querySelector('.modal-body #comentariosReporte');
            let comentariosSoporte = modalInfoTicket.querySelector('.modal-body #comentariosSoporte');
            let atiende = modalInfoTicket.querySelector('.modal-body #atiende');

            inputFolio.value = infoTicket.idTicket;
            inputRequiere.value = infoTicket.nombreRequiere;
            departamento.value = infoTicket.departamento;
            extension.value = infoTicket.extension;
            email.value = infoTicket.email;
            clasificacion.value = infoTicket.clasificacion;
            subclasificacion.value = infoTicket.subclasificacion;
            comentariosReporte.value = infoTicket.comentariosReporte;
            comentariosSoporte.value = infoTicket.comentariosSoporte;
            atiende.value = infoTicket.atiende;
        })



    } catch (error) {
        console.log(error);
    }


}


