function iniciarApp(){}function eliminarBordeComentario(){const e=document.querySelector("#comentariosReporte");e.addEventListener("input",()=>{e.style.outline="none"})}function buscarEmpleado(e,o,i){const n=document.querySelector(e);document.querySelector(o),document.querySelector(i);n.addEventListener("input",()=>{""!==n.value&&"0"!=n.value&&(console.log("de aqui soy"),obtenerEmpleado(e,o,i))})}async function obtenerEmpleado(e,o,i){const n=document.querySelector(e),c=document.querySelector(o),t=document.querySelector(i);if(""!==e.value)try{const e="/api/obtenerEmpleado?idEmp="+n.value,o=await fetch(e),i=await o.json();if(null!==i){const{nombre:e,apellidoPaterno:o,apellidoMaterno:a,extension:l}=i;c.value=l,t.value=e+" "+o+" "+a,n.style.outline="none"}else c.value="",t.value="",n.style.outline="1px solid red"}catch(e){console.log(e)}}async function obtenerSubclasificacion(){document.querySelector("#formulario-fieldset--clasificacion").querySelector("#formulario-fieldset--clasificacion > span").style.outline="none";try{const e=document.querySelector("#idClasificacionProblema").value;console.log(e);const o=document.querySelector("#idSubclasificacionProblema"),i="/api/obtenerSubclasificacion?idClasificacion="+e,n=await fetch(i),c=await n.json();o.innerHTML="";const t=document.createElement("option");t.text="--Seleccionar--",t.selected=!0,t.disabled=!0,o.appendChild(t),c.forEach(e=>{const i=document.createElement("option"),{id:n,idClasificacion:c,descripcion:t}=e;i.text=t,i.value=n,o.appendChild(i)})}catch(e){console.log(e)}}function obtenerSubclasificacionAlInicio(){const e=document.querySelector("#idClasificacionProblema").value;setTimeout(()=>{$.isNumeric(e)&&obtenerSubclasificacion()},100)}function obtenerSubclasificacionIniciando(){const e=sessionStorage.getItem("idClasificacion");e&&setTimeout(()=>{$("#idSubclasificacionProblema").val(e).trigger("change")},300)}function getIdSubclasificacion(){document.querySelector("#formulario-fieldset--subclasificacion").querySelector("#formulario-fieldset--subclasificacion > span").style.outline="none";const e=document.querySelector("#idSubclasificacionProblema").value;sessionStorage.setItem("idClasificacion",e)}function registrarTicket(){document.querySelector("#botonRegistrar").addEventListener("click",obtenerDatosTicket)}function msg(){alert("el mesnaej")}async function obtenerDatosTicket(){var e="Los siguientes campos (marcados en rojo) deben ser llenados:<br><br>";const o=document.querySelector("#idEmpReporta"),i=document.querySelector("#extensionReporta"),n=document.querySelector("#nombreReporta"),c=document.querySelector("#idEmpRequiere"),t=document.querySelector("#extensionRequiere"),a=document.querySelector("#extensionRequiere"),l=document.querySelector("#idClasificacionProblema"),r=document.querySelector("#idSubclasificacionProblema"),u=document.querySelector("#comentariosReporte"),s=document.querySelector("#formulario-fieldset--clasificacion").querySelector("#formulario-fieldset--clasificacion > span"),d=document.querySelector("#formulario-fieldset--subclasificacion").querySelector("#formulario-fieldset--subclasificacion > span");if(""==o.value&&(e+="-Expediente de quién reporta.<br>",o.style.outline="1px solid red"),""==c.value&&(e+="-Expediente de quién requiere.<br>",c.style.outline="1px solid red"),"--Seleccionar--"==l.value&&(e+="-Clasificación del problema presentado.<br>",s.style.outline="1px solid red"),"--Seleccionar--"!=r.value&&""!=r.value||(e+="-Subclasificación del problema presentado.<br>",d.style.outline="1px solid red"),""==u.value&&(e+="-Un comentario sobre el problema presentado.<br>",u.style.outline="1px solid red"),""!==o.value&&""!==i.value&&""!==n.value&&""!==c.value&&""!==t.value&&a.value&&"--Seleccionar--"!==l.value&&"--Seleccionar--"!==r.value&&""!=u.value){const e=new FormData;e.append("idEmpReporta",o.value),e.append("idEmpRequiere",c.value),e.append("idClasificacionProblema",l.value),e.append("idSubclasificacionProblema",r.value),e.append("comentariosReporte",u.value),e.forEach(e=>{console.log(e)});try{const o="/api/generar-ticket",i=await fetch(o,{method:"POST",body:e}),n=await i.json();console.log(n),n&&Swal.fire({icon:"success",title:"Éxito",html:'El ticket fue registrado con éxito con el folio <span class="folio">#'+n.id+"</span> guardalo para cualquier duda o aclaración",button:"OK"}).then(()=>{setTimeout(()=>{sessionStorage.clear,window.location.replace("/dashboard/asignar-tickets?id="+n.id)},1e3)})}catch(e){console.log(e)}}else Swal.fire({icon:"warning",title:"Atención",html:e,button:"OK"})}document.addEventListener("DOMContentLoaded",(function(){setTimeout(()=>{obtenerEmpleado("#idEmpReporta","#extensionReporta","#nombreReporta"),obtenerEmpleado("#idEmpRequiere","#extensionRequiere","#nombreRequiere")},100),buscarEmpleado("#idEmpReporta","#extensionReporta","#nombreReporta"),buscarEmpleado("#idEmpRequiere","#extensionRequiere","#nombreRequiere"),obtenerSubclasificacionAlInicio(),obtenerSubclasificacionIniciando(),eliminarBordeComentario(),iniciarApp(),registrarTicket()})),$("#idClasificacionProblema").on("select2:select",obtenerSubclasificacion),$("#idSubclasificacionProblema").on("select2:select",getIdSubclasificacion);