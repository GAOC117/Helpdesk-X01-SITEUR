
document.addEventListener('DOMContentLoaded', function () {
   
    // filtrarTabla();
    // filtrarTablaComentario();
    busqueda();
    // x();
    
    
})


function busqueda(){
    const   input = document.getElementById("myInput");
    input.addEventListener('keyup', memo);
   
}

// function x(){
//     const   input1 = document.getElementById("myInput1");
//     input1.addEventListener('input', filtrarTablaClas);
// }

// function filtrarTablaComentario()
// {

//     const tabla = document.querySelector('#tabla-tickets-body');
//     const tablaAux = document.querySelector('#tabla-tickets-body');
   
//     var input, filter, table, tr, td, i, txtValue;
//     input = document.getElementById("myInput");
//     filter = input.value.toUpperCase();
//     table = document.getElementById("tabla-tickets-body");
//     tr = table.getElementsByTagName("tr");
//     for (i = 0; i < tr.length; i++) {
//       td = tr[i].getElementsByTagName("td")[7]; //columna a buscar
//       if (td) {
//         txtValue = td.textContent || td.innerText;
//         if (txtValue.toUpperCase().indexOf(filter) > -1) {
//           tr[i].style.display = "";
//         } else {
//           tr[i].style.display = "none";
//         }
//       }       
//     }
    
// }



// function filtrarTablaClas()
// {

//     const tabla = document.querySelector('#tabla-tickets');
//     // tabla.innerHTML = "";
//     var input1, filter, table, tr, td, i, txtValue;
//     input1 = document.getElementById("myInput1");
//     filter = input1.value.toUpperCase();
//     table = document.getElementById("tabla-tickets-body");
//     tr = table.getElementsByTagName("tr");
//     for (i = 0; i < tr.length; i++) {
//       td = tr[i].getElementsByTagName("td")[3]; //columna a buscar
//       if (td) {
//         txtValue = td.textContent || td.innerText;
//         if (txtValue.toUpperCase().indexOf(filter) > -1) {
//           tr[i].style.display = "";
//         } else {
//           tr[i].style.display = "none";
//         }
//       }       
//     }
    
// }



// single column
// var searchBox_1 = document.getElementById("searchBox-1");
// searchBox_1.addEventListener("keyup", function(){
// 	var keyword = this.value;
// 	keyword = keyword.toUpperCase();
// 		var table_1 = document.getElementById("table-1");
// 		var all_tr = table_1.getElementsByTagName("tr");
// 		for(var i=0; i<all_tr.length; i++){
// 			var name_column = all_tr[i].getElementsByTagName("td")[0];
// 			if(name_column){
// 				var name_value = name_column.textContent || name_column.innerText;
// 				name_value = name_value.toUpperCase();
// 				if(name_value.indexOf(keyword) > -1){
// 					all_tr[i].style.display = ""; // show
// 				}else{
// 					all_tr[i].style.display = "none"; // hide
// 				}
// 			}
// 		}
// });

// multiple column
// var searchBox_2 = document.getElementById("searchBox-2");
// searchBox_2.addEventListener("keyup",function(){
// 	var keyword = this.value;
// 	keyword = keyword.toUpperCase();
// 	var table_2 = document.getElementById("table-2");
// 	var all_tr = table_2.getElementsByTagName("tr");
// 	for(var i=0; i<all_tr.length; i++){
// 			var name_column = all_tr[i].getElementsByTagName("td")[0];
// 		  var email_column = all_tr[i].getElementsByTagName("td")[1];
// 			if(name_column && email_column){
// 				var name_value = name_column.textContent || name_column.innerText;
// 				var email_value = email_column.textContent || email_column.innerText;
// 				name_value = name_value.toUpperCase();
// 				email_value = email_value.toUpperCase();
// 				if((name_value.indexOf(keyword) > -1) || (email_value.indexOf(keyword) > -1)){
// 					all_tr[i].style.display = ""; // show
// 				}else{
// 					all_tr[i].style.display = "none"; // hide
// 				}
// 			}
// 		}
// })



// All column
function memo(){

	var keyword = this.value;
	keyword = keyword.toUpperCase();
	var table_3 = document.getElementById("tabla-tickets-body");
	var all_tr = table_3.getElementsByTagName("tr");
	for(var i=0; i<all_tr.length; i++){
			var all_columns = all_tr[i].getElementsByTagName("td");
		  for(j=0;j<all_columns.length; j++){
				if(all_columns[j]){
					var column_value = all_columns[j].textContent || all_columns[j].innerText;
					
					column_value = column_value.toUpperCase();
					if(column_value.indexOf(keyword) > -1){
						all_tr[i].style.display = ""; // show
						break;
					}else{
						all_tr[i].style.display = "none"; // hide
					}
				}
			}
		}

    }

