

const botonRegistrar = document.querySelector('#botonRegistrar');

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


    iniciarApp();



})

function iniciarApp() {


}


function buscarEmpleado(campoExpediente, campoExtension, campoNombre) {
    const expediente = document.querySelector(campoExpediente);
    const extension = document.querySelector(campoExtension);
    const nombre = document.querySelector(campoNombre);

    expediente.addEventListener('input', () => {
        obtenerEmpleado(campoExpediente, campoExtension, campoNombre);
        
    });
}



async function obtenerEmpleado(campoExpediente, campoExtension, campoNombre) {

    const expedienteEmpleado = document.querySelector(campoExpediente);
    const ExtensionEmpleado = document.querySelector(campoExtension);
    const NombreEmpleado = document.querySelector(campoNombre);
    if (campoExpediente.value !== '') {


        try {

            // par.innerHTML = '';
            const url = 'http://localhost:3000/api/obtenerEmpleado?idEmp=' + expedienteEmpleado.value;

            const resultado = await fetch(url);
            const empleado = await resultado.json();

            if (empleado !== null) {

                const { nombre, apellidoPaterno, apellidoMaterno, extension } = empleado;
                ExtensionEmpleado.value = extension;
                NombreEmpleado.value = nombre + ' ' + apellidoPaterno + ' ' + apellidoMaterno;
                expedienteEmpleado.style.outline = 'none';
                ExtensionEmpleado.style.outline = 'none';
                NombreEmpleado.style.outline = 'none';

            }
            else {


                ExtensionEmpleado.value = '';
                NombreEmpleado.value = '';
                expedienteEmpleado.style.outline = '1px solid red';
                ExtensionEmpleado.style.outline = '1px solid red';
                NombreEmpleado.style.outline = '1px solid red';

            }



        } catch (error) {
            console.log(error);
        }


    }
}




async function obtenerSubclasificacion() {

    try {
        const Clasificacion = document.querySelector('#idClasificacionProblema').value;
        console.log(Clasificacion);
        const subClasificacion = document.querySelector('#idSubclasificacionProblema');

        // par.innerHTML = '';
        const url = 'http://localhost:3000/api/obtenerSubclasificacion?idClasificacion=' + Clasificacion;


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

function obtenerSubclasificacionIniciando()
{
     const idSubC = sessionStorage.getItem('idClasificacion');
        if(idSubC){
         
         setTimeout(()=>{

             $('#idSubclasificacionProblema').val(idSubC).trigger('change'); //si es exito reiniciar el sessionStorage
         },200);

        }
}


$('#idClasificacionProblema').on('select2:select', obtenerSubclasificacion);
$('#idSubclasificacionProblema').on('select2:select',getIdSubclasificacion);

function getIdSubclasificacion(){
    const idSub = document.querySelector('#idSubclasificacionProblema').value;
    

    sessionStorage.setItem('idClasificacion',idSub);
    // $('#idSubclasificacionProblema').select2('val','1')

}