
document.addEventListener('DOMContentLoaded', function () {
 

//   busqueda();

// mostrarMesEnCurso();
    
    
})



  




function mostrarMesEnCurso(){
    const fecha = new Date();
    var mes = fecha.getMonth()+1;
    const meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"]
    
    
    const inputFecha = document.querySelector('#idFecha');

    inputFecha.addEventListener()
    
    inputFecha.value = meses[mes-1];

   

}







function busqueda(){
    const   input = document.querySelector("#idfolio");
    input.addEventListener('keyup', kha);
   
}






function kha(){
	alert("memo");
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













// 	  $.fn.pageMe = function(opts){
//     var $this = this,
//         defaults = {
//             perPage: 10,
//             showPrevNext: false,
//             hidePageNumbers: false
//         },
//         settings = $.extend(defaults, opts);
    
//     var listElement = $this.find('tbody');
//     var perPage = settings.perPage; 
//     var children = listElement.children();
//     var pager = $('.pager');
    
//     if (typeof settings.childSelector!="undefined") {
//         children = listElement.find(settings.childSelector);
//     }
    
//     if (typeof settings.pagerSelector!="undefined") {
//         pager = $(settings.pagerSelector);
//     }
    
//     var numItems = children.size();
//     var numPages = Math.ceil(numItems/perPage);

//     pager.data("curr",0);
    
//     if (settings.showPrevNext){
//         $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
//     }
    
//     var curr = 0;
//     while(numPages > curr && (settings.hidePageNumbers==false)){
//         $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
//         curr++;
//     }
    
//     if (settings.showPrevNext){
//         $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
//     }
    
//     pager.find('.page_link:first').addClass('active');
//     pager.find('.prev_link').hide();
//     if (numPages<=1) {
//         pager.find('.next_link').hide();
//     }
//   	pager.children().eq(1).addClass("active");
    
//     children.hide();
//     children.slice(0, perPage).show();
    
//     pager.find('li .page_link').click(function(){
//         var clickedPage = $(this).html().valueOf()-1;
//         goTo(clickedPage,perPage);
//         return false;
//     });
//     pager.find('li .prev_link').click(function(){
//         previous();
//         return false;
//     });
//     pager.find('li .next_link').click(function(){
//         next();
//         return false;
//     });
    
//     function previous(){
//         var goToPage = parseInt(pager.data("curr")) - 1;
//         goTo(goToPage);
//     }
     
//     function next(){
//         goToPage = parseInt(pager.data("curr")) + 1;
//         goTo(goToPage);
//     }
    
//     function goTo(page){
//         var startAt = page * perPage,
//             endOn = startAt + perPage;
        
//         children.css('display','none').slice(startAt, endOn).show();
        
//         if (page>=1) {
//             pager.find('.prev_link').show();
//         }
//         else {
//             pager.find('.prev_link').hide();
//         }
        
//         if (page<(numPages-1)) {
//             pager.find('.next_link').show();
//         }
//         else {
//             pager.find('.next_link').hide();
//         }
        
//         pager.data("curr",page);
//       	pager.children().removeClass("active");
//         pager.children().eq(page+1).addClass("active");
    
//     }
// };

// $(document).ready(function(){
    
//   $('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:10});
    
// });