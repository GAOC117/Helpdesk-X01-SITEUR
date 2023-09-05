// const titulo = document.querySelector('#tituloDashboard').textContent + ' - '

document.addEventListener('DOMContentLoaded', function () {

    iniciarApp();
    


})




function iniciarApp() {

    filtrarSelect();
  
}


async function obtenerDepartamentosApi() {
    const idDepartamento = document.querySelector('#idDepartamento');
    const departamentoId = document.querySelector('#departamentoId');



    try {
        const url = 'http://localhost:3000/api/departamentos';
        const resultado = await fetch(url);
        const departamentos = await resultado.json();




        departamentos.forEach(departamento => {

            const { id, descripcion } = departamento;
            const option = document.createElement("option");
            option.value = id;
            option.text = id + ' ' + descripcion;
            // option.classList.add("opcionDepartamento");
            idDepartamento.appendChild(option);
        })





    } catch (error) {

        console.log(error);
    }

}



function filtrarSelect() {
    //con jquery para filtrar en el select con select2
    $('select').select2({    
        language: {
      
          noResults: function() {
      
            return "No hay resultados";        
          },
          searching: function() {
      
            return "Buscando...";
          }
        }
      });
   
}







