const ticket={expedienteReporte:"",extensionReporta:"",nombreReporta:"",expedienteRequiere:"",extensionRequiere:"",nombreRequiere:"",idClasificacion:"",idSubclasificacion:"",comentarios:""};function iniciarApp(){}function eliminarBordeComentario(){const e=document.querySelector("#comentariosReporte");e.addEventListener("input",()=>{e.style.outline="none"})}function buscarEmpleado(e,o,i){const t=document.querySelector(e);document.querySelector(o),document.querySelector(i);t.addEventListener("input",()=>{obtenerEmpleado(e,o,i)})}async function obtenerEmpleado(e,o,i){const t=document.querySelector(e),n=document.querySelector(o),c=document.querySelector(i);if(""!==e.value)try{const e="/api/obtenerEmpleado?idEmp="+t.value,o=await fetch(e),i=await o.json();if(null!==i){const{nombre:e,apellidoPaterno:o,apellidoMaterno:a,extension:r}=i;n.value=r,c.value=e+" "+o+" "+a,t.style.outline="none"}else n.value="",c.value="",t.style.outline="1px solid red"}catch(e){console.log(e)}}async function obtenerSubclasificacion(){document.querySelector("#formulario-fieldset--clasificacion").querySelector("#formulario-fieldset--clasificacion > span").style.outline="none";try{const e=document.querySelector("#idClasificacionProblema").value;console.log(e);const o=document.querySelector("#idSubclasificacionProblema"),i="/api/obtenerSubclasificacion?idClasificacion="+e,t=await fetch(i),n=await t.json();o.innerHTML="";const c=document.createElement("option");c.text="--Seleccionar--",c.selected=!0,c.disabled=!0,o.appendChild(c),n.forEach(e=>{const i=document.createElement("option"),{id:t,idClasificacion:n,descripcion:c}=e;i.text=c,i.value=t,o.appendChild(i)})}catch(e){console.log(e)}}function obtenerSubclasificacionAlInicio(){const e=document.querySelector("#idClasificacionProblema").value;setTimeout(()=>{$.isNumeric(e)&&obtenerSubclasificacion()},100)}function obtenerSubclasificacionIniciando(){const e=sessionStorage.getItem("idClasificacion");e&&setTimeout(()=>{$("#idSubclasificacionProblema").val(e).trigger("change")},300)}function getIdSubclasificacion(){document.querySelector("#formulario-fieldset--subclasificacion").querySelector("#formulario-fieldset--subclasificacion > span").style.outline="none";const e=document.querySelector("#idSubclasificacionProblema").value;sessionStorage.setItem("idClasificacion",e)}function registrarTicket(){document.querySelector("#botonRegistrar").addEventListener("click",obtenerDatosTicket)}async function obtenerDatosTicket(){var e="Los siguientes campos (marcados en rojo) deben ser llenados:<br><br>";const o=document.querySelector("#idEmpReporta"),i=document.querySelector("#extensionReporta"),t=document.querySelector("#nombreReporta"),n=document.querySelector("#idEmpRequiere"),c=document.querySelector("#extensionRequiere"),a=document.querySelector("#extensionRequiere"),r=document.querySelector("#idClasificacionProblema"),l=document.querySelector("#idSubclasificacionProblema"),u=document.querySelector("#comentariosReporte"),s=document.querySelector("#formulario-fieldset--clasificacion").querySelector("#formulario-fieldset--clasificacion > span"),d=document.querySelector("#formulario-fieldset--subclasificacion").querySelector("#formulario-fieldset--subclasificacion > span");if(""==o.value&&(e+="-Expediente de quién reporta.<br>",o.style.outline="1px solid red"),""==n.value&&(e+="-Expediente de quién requiere.<br>",n.style.outline="1px solid red"),"--Seleccionar--"==r.value&&(e+="-Clasificación del problema presentado.<br>",s.style.outline="1px solid red"),"--Seleccionar--"!=l.value&&""!=l.value||(e+="-Subclasificación del problema presentado.<br>",d.style.outline="1px solid red"),""==u.value&&(e+="-Un comentario sobre el problema presentado.<br>",u.style.outline="1px solid red"),""!==o.value&&""!==i.value&&""!==t.value&&""!==n.value&&""!==c.value&&a.value&&"--Seleccionar--"!==r.value&&"--Seleccionar--"!==l.value&&""!=u.value){const e=new FormData;e.append("expReporta",o),e.append("extReporta",i),e.append("idClasificacion",r),e.append("idSubclasificacion",l),e.append("comentariosReporte",u),e.forEach(e=>{console.log(e)});try{const o="/api/generar-ticket",i=await fetch(o,{method:"POST",body:e}),t=await i.json();alert(t),Swal.fire({icon:"success",title:"Exito",text:"Cita creada con éxito con el id",button:"OK"}).then(()=>{setTimeout(()=>{window.location.replace("https://www.google.com")},3e3)})}catch(e){console.log(e)}}else Swal.fire({icon:"warning",title:"Atención",html:e,button:"OK"})}document.addEventListener("DOMContentLoaded",(function(){setTimeout(()=>{obtenerEmpleado("#idEmpReporta","#extensionReporta","#nombreReporta"),obtenerEmpleado("#idEmpRequiere","#extensionRequiere","#nombreRequiere")},100),buscarEmpleado("#idEmpReporta","#extensionReporta","#nombreReporta"),buscarEmpleado("#idEmpRequiere","#extensionRequiere","#nombreRequiere"),obtenerSubclasificacionAlInicio(),obtenerSubclasificacionIniciando(),registrarTicket(),eliminarBordeComentario(),iniciarApp()})),$("#idClasificacionProblema").on("select2:select",obtenerSubclasificacion),$("#idSubclasificacionProblema").on("select2:select",getIdSubclasificacion);