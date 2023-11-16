
var paginaActual=1;
var pagina_siguiente;
var pagina_anterior;
var html_siguiente;
const btnSiguiente = document.querySelector('#btnSiguiente');
const btnAnterior = document.querySelector('#btnAnterior');



limpiarNotificaciones();
document.addEventListener('DOMContentLoaded', function () {


    //   busqueda();

    // mostrarMesEnCurso();

    // alerta();
    llenarTablaTickets(paginaActual);

    btnSiguiente.addEventListener('click',function(){
        if(paginaActual<pagina_siguiente){
        
            paginaActual++;
        }

         llenarTablaTickets(paginaActual);
        
    
    })

    btnAnterior.addEventListener('click',function(){
        if(paginaActual>=pagina_anterior){
        
            paginaActual--;
        }

        llenarTablaTickets(paginaActual);
        
    
    })
})


// function alerta(){
//     const boton = document.querySelector('#botonsito');

//     boton.addEventListener('click',function(){
//         console.log(paginaActual);
//         paginaActual++;
//     });
// }



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
    if (folio.value === '' && atiende.value === '' && fecha.value === ''  && estado.value === ''  && subclasificacion.value === '') {
        // alert("vacio");
         llenarTablaTickets(paginaActual);
    }

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
    const input = document.querySelector("#idfolio");
    input.addEventListener('keyup', kha);

}


async function llenarTablaTickets(page) {

    const tBody = document.querySelector('.tabla__body.tickets');

    // const empleadoPromise = obtenerRol();

    try {

        // const empleado = await empleadoPromise;
        // const idRol = empleado.idRol;




        const url = '/api/obtenerTablaTickets?page='+page;
        


        const resultado = await fetch(url);
        const result = await resultado.json();
        const tablaRows = result.tablaRows;
        const idRol = result.idRol;
        const nombreLogueado = result.nombreLogueado;
         pagina_siguiente = result.pagina_siguiente;
         pagina_anterior = result.pagina_anterior;
         html_siguiente = result.html_siguiente;

        const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

        // alert(idRol);

        tBody.innerHTML = "";


        tablaRows.forEach(row => {
            //  console.log(row);
            const tr = document.createElement('tr');
            const td_idTicket = document.createElement('td');
            const td_fechaCaptura = document.createElement('td');
            // const td_nombreAsigna = document.createElement('td');
            const td_atiende = document.createElement('td');
            const td_nombreRequiere = document.createElement('td');
            const td_estadoTicket = document.createElement('td');
            const td_clasificacion = document.createElement('td');
            const td_subclasificacion = document.createElement('td');
            const td_comentarios = document.createElement('td');
            const td_comentariosSoporte = document.createElement('td');
            const td_acciones = document.createElement('td');
            const div_acciones = document.createElement('DIV');

            const { idTicket, fechaCaptura, atiende, nombreRequiere, estadoTicket, clasificacion, subclasificacion, comentarios, comentariosSoporte } = row;

            // console.log(fechaCaptura);
            tr.classList.add('tabla__row');



            // var mes;
            // if (fechaCaptura.split('-')[1] < 10)
            //     mes = fechaCaptura.split('-')[1][1];
            // else
            //     mes = fechaCaptura.split('-')[1];

            //     console.log(mes);


            td_idTicket.textContent = idTicket;
            // td_fechaCaptura.textContent = fechaCaptura.split('-')[2] + '/' + meses[mes - 1] + '/' + fechaCaptura.split('-')[0];
            td_fechaCaptura.textContent = fechaCaptura.split('-')[2] + '/' + fechaCaptura.split('-')[1] + '/' + fechaCaptura.split('-')[0];
            // td_nombreAsigna.textContent = nombreAsigna;
            td_atiende.textContent = atiende;
            td_nombreRequiere.textContent = nombreRequiere;
            td_estadoTicket.textContent = estadoTicket;
            td_clasificacion.textContent = clasificacion;
            td_subclasificacion.textContent = subclasificacion;
            td_comentarios.textContent = comentarios;
            td_comentariosSoporte.textContent = comentariosSoporte;

            td_idTicket.classList.add('tabla__td');
            td_fechaCaptura.classList.add('tabla__td');
            // td_nombreAsigna.classList.add('tabla__td');
            td_atiende.classList.add('tabla__td');
            td_nombreRequiere.classList.add('tabla__td');
            td_estadoTicket.classList.add('tabla__td');
            td_clasificacion.classList.add('tabla__td');
            td_subclasificacion.classList.add('tabla__td');
            td_comentarios.classList.add('tabla__td');
            td_comentariosSoporte.classList.add('tabla__td');
            td_acciones.classList.add('tabla__td');

            if(estadoTicket==='Abierto')
            td_estadoTicket.classList.add('estado-abierto');
            if(estadoTicket==='Pausado')
            td_estadoTicket.classList.add('estado-pausado');
            if(estadoTicket==='Escalado')
            td_estadoTicket.classList.add('estado-escalado');
            if(estadoTicket==='Cerrado')
            td_estadoTicket.classList.add('estado-cerrado');


            //aqui designar clases para los colores de abierto, cerrado, escalado, cerrado



            div_acciones.classList.add('tabla__tickets--botones');
            if (idRol === '4')
                div_acciones.classList.add('tabla__tickets--botones--colaborador');

            div_acciones.innerHTML = "<a href='/dashboard/historial-tickets?id=" + idTicket + "' title='Historial del ticket' class='tabla__boton-azul tabla__boton'><i class='fa-solid fa-calendar-days fa-xl'></i></a>";
            // div_acciones.innerHTML = "<a href='/dashboard/historial-tickets?id=" + idTicket + "' title='Historial del ticket' class='tabla__boton-azul tabla__boton'><i class='fa-solid fa-clock fa-xl'></i></a>";

            if ( idRol === '2')  //poner aqui al admin tambien si se requiere
            {
                if (estadoTicket === 'Abierto' || estadoTicket === 'Pausado' || estadoTicket === 'Escalado') 
                {
                    if (atiende === 'Sin asignar')
                     {
                        div_acciones.innerHTML += "<a href='/dashboard/asignar-tickets?id=" + idTicket + "' title='Asignar ticket' class='tabla__boton-verde-limon tabla__boton'><i class='fa-solid fa-person-walking-arrow-loop-left fa-xl'></i></i></a>";
                    }
                    if (atiende !== 'Sin asignar') 
                    {
                       
                        div_acciones.innerHTML += "<a href='/dashboard/pausar-tickets?id=" + idTicket + "' title='Pausar ticket' class='tabla__boton-gris tabla__boton'><i class='fa-solid fa-circle-pause fa-xl'></i></a>";
                        div_acciones.innerHTML += "<a href='/dashboard/escalar-tickets?id=" + idTicket + "' title='Escalar ticket' class='tabla__boton-naranja tabla__boton'><i class='fa-solid fa-arrow-trend-up fa-xl'></i></a>";

                        div_acciones.innerHTML += "<a href='/dashboard/cerrar-tickets?id=" + idTicket + "' title='Cerrar ticket' class='tabla__boton-verde tabla__boton'><i class='fa-solid fa-circle-check fa-xl'></i></a>";

                    }
                    
                }
                else 
                {
                    div_acciones.innerHTML += "<p class='tabla__cerrado'>Ticket cerrado</p>";
                }
            }
            if (idRol === '1' ||idRol === '3') //cambiar el rol 1 de aqui hacia arriba donde esta mesa
             {
                 if (estadoTicket === 'Abierto' || estadoTicket === 'Pausado' || estadoTicket === 'Escalado') 
                 {
                

                    if (atiende !== 'Sin asignar') 
                    {
                        
                        if(atiende === nombreLogueado)
                        {
                        div_acciones.innerHTML += "<a href='/dashboard/pausar-tickets?id=" + idTicket + "' title='Pausar ticket' class='tabla__boton-gris tabla__boton'><i class='fa-solid fa-circle-pause fa-xl'></i></a>";
                        
                        //si comento el if no puede escalar tickets propios el admin
                        if(idRol==='1') 
                        {
                            div_acciones.innerHTML += "<a href='/dashboard/escalar-tickets?id=" + idTicket + "' title='Escalar ticket' class='tabla__boton-naranja tabla__boton'><i class='fa-solid fa-arrow-trend-up fa-xl'></i></a>";  
                        }

                        div_acciones.innerHTML += "<a href='/dashboard/cerrar-tickets?id=" + idTicket + "' title='Cerrar ticket' class='tabla__boton-verde tabla__boton'><i class='fa-solid fa-circle-check fa-xl'></i></a>";
                        }
                    }
                    // if (atiende !== 'Sin asignar') {
                    //     div_acciones.innerHTML += "<a href='/dashboard/cerrar-tickets?id=" + idTicket + "' title='Cerrar ticket' class='tabla__boton-verde tabla__boton'><i class='fa-solid fa-circle-check fa-xl'></i></a>";
                    // }
                }
                else 
                {
                    div_acciones.innerHTML += "<p class='tabla__cerrado'>Ticket cerrado</p>";
                }
            }
            if (idRol === '4') 
            {
                if (estadoTicket === 'Cerrado')
                 {

                    div_acciones.innerHTML += "<p class='tabla__cerrado'>Ticket cerrado</p>";
                }

            }





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


            console.log('pagina siguiente: '+pagina_siguiente);
            console.log('pagina actual: '+paginaActual);
            
            if(pagina_siguiente){
               btnSiguiente.style.display = 'inline-block';
            
            }
            else{
                btnSiguiente.style.display = 'none';
            }

            if(pagina_anterior){
                btnAnterior.style.display = 'inline-block';
             
             }
             else{
                 btnAnterior.style.display = 'none';
             }
             
            
            
            
        });//try
        
       

    } catch (error) {
        console.log(error);
    }



    $(document).ready(function () {
        $('.filter').multifilter()
    })


}


function fadeOutAlerta(){
    $('.div-ver-tickets').fadeOut(1000);
}

// async function obtenerRol() {

//     let empleado;
//     try {

//         const url = '/api/obtenerEmpleadoRol';


//         const resultado = await fetch(url);
//         empleado = await resultado.json();



//     } catch (error) {
//         console.log(error);
//     }


//     return new Promise((res, rej) => res(empleado))

// }


