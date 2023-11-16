var pagina_siguiente,pagina_anterior,html_siguiente,paginaActual=1;const btnSiguiente=document.querySelector("#btnSiguiente"),btnAnterior=document.querySelector("#btnAnterior");limpiarNotificaciones(),document.addEventListener("DOMContentLoaded",(function(){llenarTablaTickets(paginaActual),btnSiguiente.addEventListener("click",(function(){paginaActual<pagina_siguiente&&paginaActual++,llenarTablaTickets(paginaActual)})),btnAnterior.addEventListener("click",(function(){paginaActual>=pagina_anterior&&paginaActual--,llenarTablaTickets(paginaActual)}))}));const folio=document.querySelector("#idFolio"),atiende=document.querySelector("#idAtiende"),fecha=document.querySelector("#idFecha"),requiere=document.querySelector("#idRequiere"),estado=document.querySelector("#idEstado"),clasificacion=document.querySelector("#idClasificacion"),subclasificacion=document.querySelector("#idSubclasificacion"),comentarios=document.querySelector("#idComentarios"),comentariosSoporte=document.querySelector("#idComentariosSoporte");async function limpiarNotificaciones(){try{const a="/api/limpiarNotificaciones";await fetch(a)}catch(a){console.log(a)}}function mostrarMesEnCurso(){var a=(new Date).getMonth()+1;const e=document.querySelector("#idFecha");e.addEventListener(),e.value=["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"][a-1]}function busqueda(){document.querySelector("#idfolio").addEventListener("keyup",kha)}async function llenarTablaTickets(a){const e=document.querySelector(".tabla__body.tickets");try{const t="/api/obtenerTablaTickets?page="+a,i=await fetch(t),n=await i.json(),o=n.tablaRows,c=n.idRol,l=n.nombreLogueado;pagina_siguiente=n.pagina_siguiente,pagina_anterior=n.pagina_anterior,html_siguiente=n.html_siguiente;e.innerHTML="",o.forEach(a=>{const t=document.createElement("tr"),i=document.createElement("td"),n=document.createElement("td"),o=document.createElement("td"),s=document.createElement("td"),r=document.createElement("td"),d=document.createElement("td"),u=document.createElement("td"),b=document.createElement("td"),_=document.createElement("td"),p=document.createElement("td"),f=document.createElement("DIV"),{idTicket:m,fechaCaptura:g,atiende:h,nombreRequiere:k,estadoTicket:L,clasificacion:C,subclasificacion:T,comentarios:y,comentariosSoporte:E}=a;t.classList.add("tabla__row"),i.textContent=m,n.textContent=g.split("-")[2]+"/"+g.split("-")[1]+"/"+g.split("-")[0],o.textContent=h,s.textContent=k,r.textContent=L,d.textContent=C,u.textContent=T,b.textContent=y,_.textContent=E,i.classList.add("tabla__td"),n.classList.add("tabla__td"),o.classList.add("tabla__td"),s.classList.add("tabla__td"),r.classList.add("tabla__td"),d.classList.add("tabla__td"),u.classList.add("tabla__td"),b.classList.add("tabla__td"),_.classList.add("tabla__td"),p.classList.add("tabla__td"),"Abierto"===L&&r.classList.add("estado-abierto"),"Pausado"===L&&r.classList.add("estado-pausado"),"Escalado"===L&&r.classList.add("estado-escalado"),"Cerrado"===L&&r.classList.add("estado-cerrado"),f.classList.add("tabla__tickets--botones"),"4"===c&&f.classList.add("tabla__tickets--botones--colaborador"),f.innerHTML="<a href='/dashboard/historial-tickets?id="+m+"' title='Historial del ticket' class='tabla__boton-azul tabla__boton'><i class='fa-solid fa-calendar-days fa-xl'></i></a>","2"===c&&("Abierto"===L||"Pausado"===L||"Escalado"===L?("Sin asignar"===h&&(f.innerHTML+="<a href='/dashboard/asignar-tickets?id="+m+"' title='Asignar ticket' class='tabla__boton-verde-limon tabla__boton'><i class='fa-solid fa-person-walking-arrow-loop-left fa-xl'></i></i></a>"),"Sin asignar"!==h&&(f.innerHTML+="<a href='/dashboard/pausar-tickets?id="+m+"' title='Pausar ticket' class='tabla__boton-gris tabla__boton'><i class='fa-solid fa-circle-pause fa-xl'></i></a>",f.innerHTML+="<a href='/dashboard/escalar-tickets?id="+m+"' title='Escalar ticket' class='tabla__boton-naranja tabla__boton'><i class='fa-solid fa-arrow-trend-up fa-xl'></i></a>",f.innerHTML+="<a href='/dashboard/cerrar-tickets?id="+m+"' title='Cerrar ticket' class='tabla__boton-verde tabla__boton'><i class='fa-solid fa-circle-check fa-xl'></i></a>")):f.innerHTML+="<p class='tabla__cerrado'>Ticket cerrado</p>"),"1"!==c&&"3"!==c||("Abierto"===L||"Pausado"===L||"Escalado"===L?"Sin asignar"!==h&&h===l&&(f.innerHTML+="<a href='/dashboard/pausar-tickets?id="+m+"' title='Pausar ticket' class='tabla__boton-gris tabla__boton'><i class='fa-solid fa-circle-pause fa-xl'></i></a>","1"===c&&(f.innerHTML+="<a href='/dashboard/escalar-tickets?id="+m+"' title='Escalar ticket' class='tabla__boton-naranja tabla__boton'><i class='fa-solid fa-arrow-trend-up fa-xl'></i></a>"),f.innerHTML+="<a href='/dashboard/cerrar-tickets?id="+m+"' title='Cerrar ticket' class='tabla__boton-verde tabla__boton'><i class='fa-solid fa-circle-check fa-xl'></i></a>"):f.innerHTML+="<p class='tabla__cerrado'>Ticket cerrado</p>"),"4"===c&&"Cerrado"===L&&(f.innerHTML+="<p class='tabla__cerrado'>Ticket cerrado</p>"),t.appendChild(i),t.appendChild(n),t.appendChild(o),t.appendChild(s),t.appendChild(r),t.appendChild(d),t.appendChild(u),t.appendChild(b),t.appendChild(_),p.appendChild(f),t.appendChild(p),e.appendChild(t),console.log("pagina siguiente: "+pagina_siguiente),console.log("pagina actual: "+paginaActual),btnSiguiente.style.display=pagina_siguiente?"inline-block":"none",btnAnterior.style.display=pagina_anterior?"inline-block":"none"})}catch(a){console.log(a)}$(document).ready((function(){$(".filter").multifilter()}))}function fadeOutAlerta(){$(".div-ver-tickets").fadeOut(1e3)}setInterval((function(){""===folio.value&&""===atiende.value&&""===fecha.value&&""===estado.value&&""===subclasificacion.value&&llenarTablaTickets(paginaActual)}),2e3),setTimeout((function(){fadeOutAlerta()}),2e3);