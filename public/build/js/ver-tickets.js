document.addEventListener("DOMContentLoaded",(function(){llenarTablaTickets()}));const folio=document.querySelector("#idFolio"),atiende=document.querySelector("#idAtiende"),fecha=document.querySelector("#idFecha"),requiere=document.querySelector("#idRequiere"),estado=document.querySelector("#idEstado"),clasificacion=document.querySelector("#idClasificacion"),subclasificacion=document.querySelector("#idSubclasificacion"),comentarios=document.querySelector("#idComentarios"),comentariosSoporte=document.querySelector("#idComentariosSoporte");function mostrarMesEnCurso(){var a=(new Date).getMonth()+1;const e=document.querySelector("#idFecha");e.addEventListener(),e.value=["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"][a-1]}function busqueda(){document.querySelector("#idfolio").addEventListener("keyup",kha)}async function llenarTablaTickets(){const a=document.querySelector(".tabla__body.tickets");try{const e="/api/obtenerTablaTickets",t=await fetch(e),o=await t.json(),i=o.tablaRows,d=o.idRol,s=o.nombreLogueado;a.innerHTML="",i.forEach(e=>{const t=document.createElement("tr"),o=document.createElement("td"),i=document.createElement("td"),c=document.createElement("td"),l=document.createElement("td"),n=document.createElement("td"),r=document.createElement("td"),u=document.createElement("td"),b=document.createElement("td"),_=document.createElement("td"),m=document.createElement("td"),f=document.createElement("DIV"),{idTicket:p,fechaCaptura:h,atiende:L,nombreRequiere:k,estadoTicket:C,clasificacion:T,subclasificacion:E,comentarios:S,comentariosSoporte:v}=e;t.classList.add("tabla__row"),h.split("-")[1]<10?h.split("-")[1][1]:h.split("-")[1],o.textContent=p,i.textContent=h.split("-")[2]+"/"+h.split("-")[1]+"/"+h.split("-")[0],c.textContent=L,l.textContent=k,n.textContent=C,r.textContent=T,u.textContent=E,b.textContent=S,_.textContent=v,o.classList.add("tabla__td"),i.classList.add("tabla__td"),c.classList.add("tabla__td"),l.classList.add("tabla__td"),n.classList.add("tabla__td"),r.classList.add("tabla__td"),u.classList.add("tabla__td"),b.classList.add("tabla__td"),_.classList.add("tabla__td"),m.classList.add("tabla__td"),"Abierto"===C&&n.classList.add("estado-abierto"),"Pausado"===C&&n.classList.add("estado-pausado"),"Escalado"===C&&n.classList.add("estado-escalado"),"Cerrado"===C&&n.classList.add("estado-cerrado"),f.classList.add("tabla__tickets--botones"),"4"===d&&f.classList.add("tabla__tickets--botones--colaborador"),f.innerHTML="<a href='/dashboard/historial-tickets?id="+p+"' title='Historial del ticket' class='tabla__boton-azul tabla__boton'><i class='fa-solid fa-calendar-days fa-xl'></i></a>","1"!==d&&"2"!==d||("Abierto"===C||"Pausado"===C||"Escalado"===C?("Sin asignar"===L&&(f.innerHTML+="<a href='/dashboard/asignar-tickets?id="+p+"' title='Asignar ticket' class='tabla__boton-verde-limon tabla__boton'><i class='fa-solid fa-person-walking-arrow-loop-left fa-xl'></i></i></a>"),"Sin asignar"!==L&&(f.innerHTML+="<a href='/dashboard/pausar-tickets?id="+p+"' title='Pausar ticket' class='tabla__boton-gris tabla__boton'><i class='fa-solid fa-circle-pause fa-xl'></i></a>",f.innerHTML+="<a href='/dashboard/escalar-tickets?id="+p+"' title='Escalar ticket' class='tabla__boton-naranja tabla__boton'><i class='fa-solid fa-arrow-trend-up fa-xl'></i></a>",f.innerHTML+="<a href='/dashboard/cerrar-tickets?id="+p+"' title='Cerrar ticket' class='tabla__boton-verde tabla__boton'><i class='fa-solid fa-circle-check fa-xl'></i></a>")):f.innerHTML+="<p class='tabla__cerrado'>Ticket cerrado</p>"),"3"===d&&("Abierto"===C||"Pausado"===C||"Escalado"===C?"Sin asignar"!==L&&L===s&&(f.innerHTML+="<a href='/dashboard/pausar-tickets?id="+p+"' title='Pausar ticket' class='tabla__boton-gris tabla__boton'><i class='fa-solid fa-circle-pause fa-xl'></i></a>",f.innerHTML+="<a href='/dashboard/cerrar-tickets?id="+p+"' title='Cerrar ticket' class='tabla__boton-verde tabla__boton'><i class='fa-solid fa-circle-check fa-xl'></i></a>"):f.innerHTML+="<p class='tabla__cerrado'>Ticket cerrado</p>"),"4"===d&&"Cerrado"===C&&(f.innerHTML+="<p class='tabla__cerrado'>Ticket cerrado</p>"),t.appendChild(o),t.appendChild(i),t.appendChild(c),t.appendChild(l),t.appendChild(n),t.appendChild(r),t.appendChild(u),t.appendChild(b),t.appendChild(_),m.appendChild(f),t.appendChild(m),a.appendChild(t)})}catch(a){console.log(a)}$(document).ready((function(){$(".filter").multifilter()}))}setInterval((function(){""===folio.value&&""===atiende.value&&""===fecha.value&&""===requiere.value&&""===estado.value&&""===clasificacion.value&&""===subclasificacion.value&&""===comentarios.value&&""===comentariosSoporte.value&&llenarTablaTickets()}),2e3);