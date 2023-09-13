

      <p>
          <?php 
          if($_SESSION['mensaje']){
          echo $_SESSION['mensaje']; $_SESSION['mensaje']='';
          }
          ?>
      </p>
      <div class="asignar-tickets__header">
              <h2 class="asignar-tickets__heading"><?php echo $titulo; ?></h2>
          </div>
<body>



<div class="jquery-script-clear"></div>


<div class='containerrrr'>
<div class='filters'>
<div class='filter-container'>
<input autocomplete='off' class='filter' name='folio' placeholder='folio' data-col='folio'/>
</div>
<div class='filter-container'>
<input autocomplete='off' class='filter' name='asigna' placeholder='asigna' data-col='asigna'/>
</div>
<div class='filter-container'>
<input autocomplete='off' class='filter' name='atiende' placeholder='atiende' data-col='atiende'/>
</div>
<div class='filter-container'>
<input autocomplete='off' class='filter' name='fecha' placeholder='fecha' data-col='fecha'/>
</div>
<div class='filter-container'>
<input autocomplete='off' class='filter' name='requiere' placeholder='requiere' data-col='requiere'/>
</div>
<div class='filter-container'>
<input autocomplete='off' class='filter' name='estado' placeholder='estado' data-col='estado'/>
</div>
<div class='filter-container'>
<input autocomplete='off' class='filter' name='clasificacion' placeholder='clasificacion' data-col='clasificación'/>
</div>
<div class='filter-container'>
<input autocomplete='off' class='filter' name='subclasificacion' placeholder='subclasificacion' data-col='subclasificación'/>
</div>
<div class='filter-container'>
<input autocomplete='off' class='filter' name='comentarios' placeholder='comentarios' data-col='comentarios'/>
</div>
<div class='clearfix'></div>
</div>
</div>
<div class='container'>



<table>
<thead>
<th>Folio#</th>
<th>Asigna</th>
<th>Atiende</th>
<th>Fecha de captura</th>
<th>Requiere</th>
<th>Estado</th>
<th>Clasificación</th>
<th>Subclasificación</th>
<th>Comentarios</th>
</thead>
</thead>
<tbody>
<?php
                foreach ($tickets as $ticket) : ?>

                    <tr>
                        <td><?php echo $ticket->idTicket; ?></td>
                        <td><?php echo $ticket->nombreAsigna; ?></td>
                        <td><?php echo $ticket->atiende; ?></td>
                        <td><?php echo date('d', strtotime($ticket->fechaCaptura)) . '/' . $meses[date('m', strtotime($ticket->fechaCaptura)) - 1] . '/' . date('Y', strtotime($ticket->fechaCaptura)); ?></td>
                        <td><?php echo $ticket->nombreRequiere; ?></td>
                        <td><?php echo $ticket->estadoTicket; ?></td>
                        <td><?php echo $ticket->clasificacion; ?></td>
                        <td><?php echo $ticket->subclasificacion; ?></td>
                        <td><?php echo $ticket->comentarios; ?></td>

                        <td >
                            <div class="tabla-tickets__botones">
                            <a href="/dashboard/historial-tickets?id=<?php echo $ticket->idTicket; ?>" class="boton-amarillo-block">Historial</a>
                                <?php if ($idRol === '1' || $idRol === '2') { ?>
                                    <?php if ($ticket->estadoTicket === 'Abierto' || $ticket->estadoTicket === 'Pausado' || $ticket->estadoTicket === 'Escalado') { ?>

                                        <a href="/dashboard/escalar-tickets?id=<?php echo $ticket->idTicket; ?>" class="boton-amarillo-block">Escalar</a>
                                        <a href="/dashboard/cerrar-tickets?id=<?php echo $ticket->idTicket; ?>" class="boton-amarillo-block">Cerrar</a>
                                    <?php } ?>
                                <?php } ?>

                                <?php if ($idRol === '3') { ?>
                                    <?php if ($ticket->estadoTicket === 'Abierto' || $ticket->estadoTicket === 'Pausado' || $ticket->estadoTicket === 'Escalado') { ?>


                                        <a href="/dashboard/cerrar-tickets?id=<?php echo $ticket->idTicket; ?>" class="boton-amarillo-block">Cerrar</a>
                                    <?php } ?>
                                <?php } ?>

                            </div>



                        </td>
                    </tr>
                <?php endforeach; ?>
            
</tbody>
</table>
</div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
</html>

<?php $script = "
<script src='/build/js/dashboard.js' defer></script>

"

?>
