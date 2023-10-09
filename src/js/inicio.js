
document.addEventListener('DOMContentLoaded', function () {

    getMonthlyTickets();

})



setInterval(function () {

    getMonthlyTickets();

}, 2000);





async function getMonthlyTickets() {
    try {
    
    const url = '/api/getMonthlyTickets';
    
    const resultado = await fetch(url);
    const result = await resultado.json();
    console.log(result);
    const abiertos = result.abiertos.abiertos;
    const pausados = result.pausados.pausados;
    const escalados = result.escalados.escalados;
    const cerrados = result.cerrados.cerrados;
    const totales = result.total.total;
    

    console.log("abiertos: "+abiertos+" pausados: "+pausados+" escalados: "+escalados+" cerrados: "+cerrados+" Totales: "+totales);
        const abierto = document.querySelector('#tickets--abiertos');
        const pausado = document.querySelector('#tickets--pausados');
        const escalado = document.querySelector('#tickets--escalados');
        const cerrado = document.querySelector('#tickets--cerrados');
        const total = document.querySelector('#tickets--totales');

       
        abierto.innerHTML = abiertos;
        pausado.innerHTML = pausados;
        escalado.innerHTML = escalados;
        cerrado.innerHTML = cerrados;
        total.innerHTML = totales;


    }
    

catch (error) {
    console.log(error);
}

}

