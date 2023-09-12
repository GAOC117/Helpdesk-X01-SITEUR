


const ticket = {
    expedienteReporte: '',
    extensionReporta: '',
    nombreReporta: '',
    expedienteRequiere: '',
    extensionRequiere: '',
    nombreRequiere: '',
    idClasificacion: '',
    idSubclasificacion: '',
    comentarios: ''

}



document.addEventListener('DOMContentLoaded', function () {
    setTimeout(() => {

        //obtiene por primera vez al empleado
        obtenerEmpleado('#idEmpReporta', '#extensionReporta', '#nombreReporta');
        obtenerEmpleado('#idEmpRequiere', '#extensionRequiere', '#nombreRequiere');
    }, 100);

    //busca al empleado tecleado
    buscarEmpleado('#idEmpReporta', '#extensionReporta', '#nombreReporta');
    buscarEmpleado('#idEmpRequiere', '#extensionRequiere', '#nombreRequiere');


    obtenerSubclasificacionAlInicio();
    obtenerSubclasificacionIniciando();

    eliminarBordeComentario()
    iniciarApp();
    registrarTicket();
    
    
    
})

function iniciarApp() {
    

}

function eliminarBordeComentario(){
    const comentariosReporte = document.querySelector('#comentariosReporte');
    comentariosReporte.addEventListener('input',()=>{
        comentariosReporte.style.outline = 'none';
    })

}

function buscarEmpleado(campoExpediente, campoExtension, campoNombre) {
    const expediente = document.querySelector(campoExpediente);
    const extension = document.querySelector(campoExtension);
    const nombre = document.querySelector(campoNombre);

   
    expediente.addEventListener('input', () => {
        if(expediente.value!=='' && expediente.value !='0'){
            console.log("de aqui soy");
            obtenerEmpleado(campoExpediente, campoExtension, campoNombre);
        }

    });
}



async function obtenerEmpleado(campoExpediente, campoExtension, campoNombre) {

    const expedienteEmpleado = document.querySelector(campoExpediente);
    const ExtensionEmpleado = document.querySelector(campoExtension);
    const NombreEmpleado = document.querySelector(campoNombre);
    if (campoExpediente.value !== '') {


        try {

            // par.innerHTML = '';
            // const url = 'http://'+direccion+':3000/api/obtenerEmpleado?idEmp=' + expedienteEmpleado.value;
            const url = '/api/obtenerEmpleado?idEmp=' + expedienteEmpleado.value;

            const resultado = await fetch(url);
            const empleado = await resultado.json();

            if (empleado !== null) {

                const { nombre, apellidoPaterno, apellidoMaterno, extension } = empleado;
                ExtensionEmpleado.value = extension;
                NombreEmpleado.value = nombre + ' ' + apellidoPaterno + ' ' + apellidoMaterno;
                expedienteEmpleado.style.outline = 'none';
                // ExtensionEmpleado.style.outline = 'none';
                // NombreEmpleado.style.outline = 'none';

            }
            else {


                ExtensionEmpleado.value = '';
                NombreEmpleado.value = '';
                expedienteEmpleado.style.outline = '1px solid red';
                // ExtensionEmpleado.style.outline = '1px solid red';
                // NombreEmpleado.style.outline = '1px solid red';

            }



        } catch (error) {
            console.log(error);
        }


    }
}




async function obtenerSubclasificacion() {

    const padreClasificacion = document.querySelector('#formulario-fieldset--clasificacion');
    const hijoClasificacion = padreClasificacion.querySelector('#formulario-fieldset--clasificacion > span');

    hijoClasificacion.style.outline = 'none';
    

    

    try {
        const Clasificacion = document.querySelector('#idClasificacionProblema').value;
        console.log(Clasificacion);
        const subClasificacion = document.querySelector('#idSubclasificacionProblema');

        // par.innerHTML = '';
        // const url = 'http://'+direccion+':3000/api/obtenerSubclasificacion?idClasificacion=' + Clasificacion;
        const url = '/api/obtenerSubclasificacion?idClasificacion=' + Clasificacion;


        const resultado = await fetch(url);
        const subclasificaciones = await resultado.json();


        subClasificacion.innerHTML = "";
        const option = document.createElement("option");
        option.text = '--Seleccionar--';
        option.selected = true;
        option.disabled = true;
        subClasificacion.appendChild(option);
        subclasificaciones.forEach(subC => {

            const option = document.createElement("option");
            const { id, idClasificacion, descripcion } = subC;
            option.text = descripcion;
            option.value = id;
            subClasificacion.appendChild(option);


        });


    } catch (error) {
        console.log(error);
    }



}


function obtenerSubclasificacionAlInicio() {
    const Clasificacion = document.querySelector('#idClasificacionProblema').value;
    setTimeout(() => {

        if ($.isNumeric(Clasificacion)) {
            obtenerSubclasificacion();
        }





    }, 100);

}

function obtenerSubclasificacionIniciando() {
    const idSubC = sessionStorage.getItem('idClasificacion');
    if (idSubC) {

        setTimeout(() => {

            $('#idSubclasificacionProblema').val(idSubC).trigger('change'); //si es exito reiniciar el sessionStorage
        }, 300);

    }
}


$('#idClasificacionProblema').on('select2:select', obtenerSubclasificacion);
$('#idSubclasificacionProblema').on('select2:select', getIdSubclasificacion);

function getIdSubclasificacion() {

    const padreSublasificacion = document.querySelector('#formulario-fieldset--subclasificacion');
    const hijoSubclasificacion = padreSublasificacion.querySelector('#formulario-fieldset--subclasificacion > span');

    hijoSubclasificacion.style.outline = 'none';

    const idSub = document.querySelector('#idSubclasificacionProblema').value;


    sessionStorage.setItem('idClasificacion', idSub);
    // $('#idSubclasificacionProblema').select2('val','1')

}


function registrarTicket() {
    const botonRegistrar = document.querySelector('#botonRegistrar');
    botonRegistrar.addEventListener('click', obtenerDatosTicket);
}
function msg(){
    alert("el mesnaej");
}


async function obtenerDatosTicket() {
    
    var mensaje = "Los siguientes campos (marcados en rojo) deben ser llenados:<br><br>";
    const expReporta = document.querySelector('#idEmpReporta');
    const extReporta = document.querySelector('#extensionReporta');
    const nombreReporta = document.querySelector('#nombreReporta');
    const expRequiere = document.querySelector('#idEmpRequiere');
    const extRequiere = document.querySelector('#extensionRequiere');
    const nombreRequiere = document.querySelector('#extensionRequiere');
    const idClasificacion = document.querySelector('#idClasificacionProblema');
    const idSubclasificacion = document.querySelector('#idSubclasificacionProblema');
    const comentariosReporte = document.querySelector('#comentariosReporte');

    const padreClasificacion = document.querySelector('#formulario-fieldset--clasificacion');
    const hijoClasificacion = padreClasificacion.querySelector('#formulario-fieldset--clasificacion > span');
    
    const padreSublasificacion = document.querySelector('#formulario-fieldset--subclasificacion');
    const hijoSubclasificacion = padreSublasificacion.querySelector('#formulario-fieldset--subclasificacion > span');


    const text = expReporta + " " + extReporta + " " + nombreReporta + " " + expRequiere + " " + extRequiere + " " + nombreRequiere;

    if (expReporta.value == "")
    {
    mensaje+="-Expediente de quién reporta.<br>";
    expReporta.style.outline = '1px solid red';
    }
    

    if (expRequiere.value == "")
    {
    mensaje+="-Expediente de quién requiere.<br>";
    expRequiere.style.outline = '1px solid red';
    }

    if (idClasificacion.value == "--Seleccionar--")
    {
    mensaje+="-Clasificación del problema presentado.<br>";
    hijoClasificacion.style.outline = '1px solid red';
    }

    if (idSubclasificacion.value == "--Seleccionar--"|| idSubclasificacion.value == "")
    {
    mensaje+="-Subclasificación del problema presentado.<br>";
    hijoSubclasificacion.style.outline = '1px solid red';
    }

    if (comentariosReporte.value == "")
    {
    mensaje+="-Un comentario sobre el problema presentado.<br>";
    comentariosReporte.style.outline = '1px solid red';
    }

    


    if (expReporta.value !== "" && extReporta.value !== "" && nombreReporta.value !== "" && expRequiere.value !== "" && extRequiere.value !== "" && nombreRequiere.value && idClasificacion.value !== "--Seleccionar--" && idSubclasificacion.value !=="--Seleccionar--" && comentariosReporte.value!="") 
    {
     
        const datos = new FormData();
        datos.append('idEmpReporta', expReporta.value);
        datos.append('idEmpRequiere', expRequiere.value);
        datos.append('idClasificacionProblema', idClasificacion.value);
        datos.append('idSubclasificacionProblema', idSubclasificacion.value);
        datos.append('comentariosReporte', comentariosReporte.value);

        datos.forEach(dato =>{
            console.log(dato);
        })

        try{
            const url ='/api/generar-ticket';

            const respuesta = await fetch(url,{
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();
            console.log(resultado);
            if(resultado){
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    html: 'El ticket fue registrado con éxito con el folio #<span class="folio">'+resultado.id+'</span> guardalo para cualquier duda o aclaración',
                    button: 'OK'    
                    // footer: '<a href="">Why do I have this issue?</a>'
                }).then(()=>{
                    setTimeout(() => {
                        window.location.replace("/dashboard");
                        // window.location.replace("Pagina a redirigir")
                        
                    }, 1000);
                })


            }


        }
        catch(error){
            console.log(error);
        }
    }
    else{
        Swal.fire({
            icon: 'warning',
            title: 'Atención',
            html: mensaje,//+resultado.id,
            button: 'OK'    
            // footer: '<a href="">Why do I have this issue?</a>'
        })
    }



}


