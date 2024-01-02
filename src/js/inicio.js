
var abiertos = 0;
var pausados = 0;
var escalados = 0;
var cerrados = 0;
var abiertos1 = 0;
var pausados1 = 0;
var escalados1 = 0;
var cerrados1 = 0;
var abiertos2 = 0;
var pausados2 = 0;
var escalados2 = 0;
var cerrados2 = 0;
var totales = 0;
var totales1 = 0;
var totales2 = 0;
var mesAct = 0;
var alto = 0;
var ancho = 0;

var abiertoAux = 0;
var pausadoAux = 0;
var escaladoAux = 0;
var cerradoAux = 0;
var grafico;
var graficoB;
const barra = document.getElementById('myChart1');


document.addEventListener('DOMContentLoaded', function () {

  getMonthlyTickets();
  // abiertoAux = abiertos;
  // pausadoAux = pausados;
  // escaladoAux = escalados;
  // cerradoAux = cerrados;
  // console.log(totales + ' ' + totales1 + ' ' + totales2);
  // generarChart();
  // graficoBarras(mesAct,abiertos,abiertos1,abiertos2,pausados,pausados1,pausados2,escalados,escalados1,escalados2,totales,totales1,totales2);
  // console.log("abiertos: "+abiertos+" pausados: "+pausados+" escalados: "+escalados+" cerrados: "+cerrados);
  // console.log("abiertosAux: "+abiertoAux+" pausadosAux: "+pausadoAux+" escaladosAux: "+escaladoAux+" cerradosAux: "+cerradoAux);

})



setInterval(function () {

  getMonthlyTickets();




}, 2000);






async function getMonthlyTickets() {
  try {

    const url = '/api/getMonthlyTickets';

    const resultado = await fetch(url);
    const result = await resultado.json();

    abiertos = result.abiertos.abiertos;
    pausados = result.pausados.pausados;
    escalados = result.escalados.escalados;
    cerrados = result.cerrados.cerrados;
    totales = result.total.total;

    abiertos1 = result.abiertos1.abiertos1;
    pausados1 = result.pausados1.pausados1;
    escalados1 = result.escalados1.escalados1;
    cerrados1 = result.cerrados1.cerrados1;
    totales1 = result.total1.total1;

    abiertos2 = result.abiertos2.abiertos2;
    pausados2 = result.pausados2.pausados2;
    escalados2 = result.escalados2.escalados2;
    cerrados2 = result.cerrados2.cerrados2;
    totales2 = result.total2.total2;


    mesAct = result.mesActual;




    // console.log("abiertos: "+abiertos+" pausados: "+pausados+" escalados: "+escalados+" cerrados: "+cerrados+" Totales: "+totales);
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
    if (abiertoAux !== abiertos || pausadoAux !== pausados || escaladoAux !== escalados || cerradoAux !== cerrados) {
      //    console.log("abiertos: "+abiertos+" pausados: "+pausados+" escalados: "+escalados+" cerrados: "+cerrados);
      //      console.log("abiertosAux: "+abiertoAux+" pausadosAux: "+pausadoAux+" escaladosAux: "+escaladoAux+" cerradosAux: "+cerradoAux);
      // // console.log('memito');
      generarChart();
      graficoBarras(mesAct, abiertos, abiertos1, abiertos2, pausados, pausados1, pausados2, escalados, escalados1, escalados2, cerrados, cerrados1, cerrados2, totales, totales1, totales2);
      abiertoAux = abiertos;
      pausadoAux = pausados;
      escaladoAux = escalados;
      cerradoAux = cerrados;
    }

  }


  catch (error) {
    console.log(error);
  }

}





function generarChart() {

  setTimeout(() => {


    const ctx = document.getElementById('myChart');

    if (grafico)
      grafico.destroy();




    const data = {
      labels: [
        'Abiertos',
        'Pausados',
        'Escalados',
        'Cerrados'
      ],
      datasets: [{
        label: 'Tickets',
        data: [abiertos, pausados, escalados, cerrados],
        backgroundColor: [
          'rgb(248, 88, 88)',
          '#99998C',
          '#F6A215',
          '#3e8b41'
        ],
        hoverOffset: 4
      }]
    };

    //   const config = {
    //     type: 'doughnut',
    //     data: data,
    //   };
    grafico = new Chart(ctx, {
      type: 'pie',
      data: data,
      options: {
        responsive: false
      }
    });



    //   if(abiertoAux!==abiertos||pausadoAux!== pausados || escaladoAux!==escalados||cerradoAux!==cerrados)
    //   {

    //       abiertoAux = abiertos;
    //       pausadoAux = pausados;
    //       escaladoAux = escalados;
    //       cerradoAux = cerrados;

    //   }  




  }, 200);


}


function graficoBarras(mes, a, a1, a2, p, p1, p2, e, e1, e2, c, c1, c2, t, t1, t2) {

  setTimeout(() => {


    // console.log('a ver aqui ' + t + ' ' + t1 + ' ' + t2);
    meses = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    let mesActual = meses[mes];
    // console.log(meses[mes] + ' ' + meses[mes - 1] + ' ' + meses[mes - 2]);
    let mesAnterior, mesDobleAnterior;
    if (mes === 1) {

      mesAnterior = meses[12];
      mesDobleAnterior = meses[11];
    } else if (mes == 2) {

      mesAnterior = meses[1];
      mesDobleAnterior = meses[12];
    }
    else {
      mesAnterior = meses[mes - 1];
      mesDobleAnterior = meses[mes - 2];
    }

     console.log(mes+' '+mesActual+' '+mesAnterior+' '+mesDobleAnterior);



    if (graficoB)
      graficoB.destroy();

    let tablet = window.matchMedia("(width > 768px)");

    if (tablet.matches) {


      barra.height = 500;
      barra.width = 500;

    }
    else {


      barra.height = 300;
      barra.width = 300;


    }




    // console.log(barra.height + ' ' + barra.width);

    // if(graficoB)
    //         graficoB.destroy();

    const labels = [mesActual, mesAnterior, mesDobleAnterior]
    const data = {
      labels: labels,
      datasets: [{
        label: 'Abiertos',
        data: [a, a1, a2],
        backgroundColor: [
          'rgb(248, 88, 88)',
          'rgb(248, 88, 88)',
          'rgb(248, 88, 88)',


        ],
        borderColor: [
          'rgb(248, 88, 88)',
          'rgb(248, 88, 88)',
          'rgb(248, 88, 88)',

        ],
        borderWidth: 1
      },
      {
        label: 'Pausados',
        data: [p, p1, p2],
        backgroundColor: [
          '#99998C',
          '#99998C',
          '#99998C',


        ],
        borderColor: [
          '#99998C',
          '#99998C',
          '#99998C',

        ],
        borderWidth: 1
      },
      {
        label: 'Escalados',
        data: [e, e1, e2],
        backgroundColor: [
          '#F6A215',
          '#F6A215',
          '#F6A215',

        ],
        borderColor: [
          '#F6A215',
          '#F6A215',
          '#F6A215',

        ],
        borderWidth: 1
      },
      {
        label: 'Cerrados',
        data: [c, c1, c2],
        backgroundColor: [
          '#3e8b41',
          '#3e8b41',
          '#3e8b41',

        ],
        borderColor: [
          '#3e8b41',
          '#3e8b41',
          '#3e8b41',

        ],
        borderWidth: 1
      },
      {
        label: 'Totales',
        data: [t, t1, t2],
        backgroundColor: [
          'rgb(33,52,92)',
          'rgb(33,52,92)',
          'rgb(33,52,92)',


        ],
        borderColor: [
          'rgb(33,52,92)',
          'rgb(33,52,92)',
          'rgb(33,52,92)',

        ],
        borderWidth: 1
      }
      ]
    };

    graficoB = new Chart(barra, {
      type: 'bar',
      data: data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        responsive: false,
        maintainAspectRatio: false
      },
    });







    //             const labels = ['enero','feb','mar'];
    // const data = {
    //   labels: labels,
    //   datasets: [
    //     {
    //       label: 'Abiertos',
    //       data: [1,3,5],
    //       borderColor: 'rgb(248, 88, 88)',
    //       backgroundColor:'rgb(248, 88, 88)',
    //     },
    //     {
    //       label: 'Pausados',
    //       data: [2,6,9],
    //       borderColor:'rgb(248, 88, 88)',
    //       backgroundColor:'rgb(248, 88, 88)',
    //     },
    //     {
    //       label: 'Escalados',
    //       data: [3,7,12],
    //       borderColor: 'rgb(248, 88, 88)',
    //       backgroundColor: 'rgb(248, 88, 88)',
    //     },
    //     {
    //       label: 'Cerrados',
    //       data: [4,3,1],
    //       borderColor: 'rgb(248, 88, 88)',
    //       backgroundColor: 'rgb(248, 88, 88)',
    //     },
    //      {
    //       label: 'Totales',
    //       data: [4,35,12],
    //       borderColor: 'rgb(248, 88, 88)',
    //       backgroundColor: 'rgb(248, 88, 88)',
    //     }
    //   ]
    // };

    //     graficoB = new Chart(barra, {
    //         type: 'bar',
    //         data: data,
    //         options: {
    //           responsive: false,
    //           maintainAspectRatio: false,
    //           plugins: {
    //             legend: {
    //               position: 'top',
    //             },
    //             title: {
    //               display: true,
    //               text: 'Tickets de los ultimos 3 meses'
    //             }
    //           }
    //         },
    //       });


    //       const DATA_COUNT = 4;
    // const NUMBER_CFG = {count: 4, min: 0, max: 10};



  }, 200);
}


addEventListener('resize', () => {
  // let tablet = window.matchMedia("width > 768px)");
  //   if(tablet.matches===true){
  //     console.log('es vewrdad');
  //     graficoB.destroy();
  //     barra.height = 500;
  //     barra.width = 500;
  // graficoB.destroy();
  // setTimeout(() => {
  graficoBarras(mesAct, abiertos, abiertos1, abiertos2, pausados, pausados1, pausados2, escalados, escalados1, escalados2, cerrados, cerrados1, cerrados2, totales, totales1, totales2);

  // }, 2000);

  // }
  // else{
  //   console.log('es falso');
  //   graficoB.destroy();
  //   barra.height = 350;
  //   barra.width = 350;
  //   graficoBarras(mesAct,abiertos,abiertos1,abiertos2,pausados,pausados1,pausados2,escalados,escalados1,escalados2,cerrados,cerrados1,cerrados2, totales,totales1,totales2);

  // }
});


