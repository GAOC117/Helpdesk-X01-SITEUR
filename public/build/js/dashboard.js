const titulo=document.querySelector("#tituloDashboard").textContent+" - ";function iniciarApp(){titleScroller(titulo)}function titleScroller(t){document.title=t,setTimeout((function(){titleScroller(t.substring(1)+t.substring(0,1))}),200)}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));