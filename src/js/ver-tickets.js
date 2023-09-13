
document.addEventListener('DOMContentLoaded', function () {
 

//   busqueda();

    
    
})


function busqueda(){
    const   input = document.getElementById("inputBusqueda");
    input.addEventListener('keyup', filtarTabla);
   
}






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
// 			var name_column = all_tr[i].getElementsByTagName("td")[0]; ///aqui agregar las columnas
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
function filtarTabla(){

	var textoBuscado = this.value;
	textoBuscado = textoBuscado.toUpperCase();
	var tablaTickets = document.getElementById("tabla-tickets__body");
	var all_tr = tablaTickets.getElementsByTagName("tr");
	for(var i=0; i<all_tr.length; i++){
			var all_columns = all_tr[i].getElementsByTagName("td");
		  for(j=0;j<all_columns.length; j++){
				if(all_columns[j]){
					var column_value = all_columns[j].textContent || all_columns[j].innerText;
					
					column_value = column_value.toUpperCase();
					if(column_value.indexOf(textoBuscado) > -1){
						all_tr[i].style.display = ""; // show
						break;
					}else{
						all_tr[i].style.display = "none"; // hide
					}
				}
			}
		}

    }





	(function($) {
		"use strict";
		$.fn.multifilter = function(options) {
		  var settings = $.extend( {
			'target'        : $('table'),
			'method'    : 'thead' // This can be thead or class
		  }, options);
	  
		  jQuery.expr[":"].Contains = function(a, i, m) {
			return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
		  };
	  
		  this.each(function() {
			var $this = $(this);
			var container = settings.target;
			var row_tag = 'tr';
			var item_tag = 'td';
			var rows = container.find($(row_tag));
	  
			if (settings.method === 'thead') {
			  // Match the data-col attribute to the text in the thead
			  var col = container.find('th:Contains(' + $this.data('col') + ')');
			  var col_index = container.find($('thead th')).index(col);
			};
	  
			if (settings.method === 'class') {
			  // Match the data-col attribute to the class on each column
			  var col = rows.first().find('td.' + $this.data('col') + '');
			  var col_index = rows.first().find('td').index(col);
			};
	  
			$this.change(function() {
			  var filter = $this.val();
			  rows.each(function() {
				var row = $(this);
				var cell = $(row.children(item_tag)[col_index]);
				if (filter) {
				  if (cell.text().toLowerCase().indexOf(filter.toLowerCase()) !== -1) {
					cell.attr('data-filtered', 'positive');
				  } else {
					cell.attr('data-filtered', 'negative');
				  }
				  if (row.find(item_tag + "[data-filtered=negative]").size() > 0) {
					 row.hide();
				  } else {
					if (row.find(item_tag + "[data-filtered=positive]").size() > 0) {
					  row.show();
					}
				  }
				} else {
				  cell.attr('data-filtered', 'positive');
				  if (row.find(item_tag + "[data-filtered=negative]").size() > 0) {
					row.hide();
				  } else {
					if (row.find(item_tag + "[data-filtered=positive]").size() > 0) {
					  row.show();
					}
				  }
				}
			  });
			  return false;
			}).keyup(function() {
			  $this.change();
			});
		  });
		};
	  })(jQuery);
	  