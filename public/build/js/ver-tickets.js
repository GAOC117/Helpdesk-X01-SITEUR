function busqueda(){document.getElementById("myInput").addEventListener("keyup",memo)}function memo(){var e=this.value;e=e.toUpperCase();for(var t=document.getElementById("tabla-tickets-body").getElementsByTagName("tr"),n=0;n<t.length;n++){var a=t[n].getElementsByTagName("td");for(j=0;j<a.length;j++)if(a[j]){var d=a[j].textContent||a[j].innerText;if((d=d.toUpperCase()).indexOf(e)>-1){t[n].style.display="";break}t[n].style.display="none"}}}document.addEventListener("DOMContentLoaded",(function(){busqueda()}));