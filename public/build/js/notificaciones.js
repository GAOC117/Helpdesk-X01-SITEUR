document.addEventListener("DOMContentLoaded",(function(){obenerNotificaciones()}));const alerta=document.querySelector(".notificaciones-icono"),notificacionEnlace=document.querySelector(".notificaciones-enlace");async function obenerNotificaciones(){try{const i="/api/obtenerNotificaciones",e=await fetch(i),n=await e.json(),c=n.idRol,o=n.cantidad;if("4"!==c){const i=document.querySelector(".notificaciones-icono");"0"===o?i.style.display="none":o>0&&o<=9?(i.style.display="flex",i.innerHTML=o):o>9&&(i.style.display="flex",i.innerHTML="9+")}}catch(i){console.log(i)}}async function limpiarNotificaciones(){try{const i="/api/limpiarNotificaciones";await fetch(i);window.location.replace("/dashboard/ver-tickets")}catch(i){console.log(i)}}alerta.addEventListener("click",limpiarNotificaciones),notificacionEnlace.addEventListener("click",limpiarNotificaciones),setInterval((function(){obenerNotificaciones()}),2e3);