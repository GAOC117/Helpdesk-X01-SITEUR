<p>
    <?php
    if ($_SESSION['mensaje']) {
        echo $_SESSION['mensaje'];
        $_SESSION['mensaje'] = '';
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
                <label>Folio: </label>
                <input type="number" autocomplete='off' class='filter' name='folio' placeholder='Buscar folio' data-col='folio' id="idFolio" />
            </div>
            <div class='filter-container'>
                <label>Quién asigna: </label>
                <input autocomplete='off' class='filter' name='asigna' placeholder='Buscar quién asigna el ticket' data-col='asigna' id="idAsigna" />
            </div>
            <div class='filter-container'>
                <label>Quién atiende: </label>
                <input autocomplete='off' class='filter' name='atiende' placeholder='Buscar quién atiende el servicio' data-col='atiende' id="idAtiende" />
            </div>
            <div class='filter-container'>
                <label>Fecha: </label>
                <input  autocomplete='off' class='filter' name='fecha' placeholder='Buscar fecha de captura de ticket' data-col='fecha' id="idFecha"/>
            </div>
            <div class='filter-container'>
                <label>Quién requiere: </label>
                <input autocomplete='off' class='filter' name='requiere' placeholder='Buscar quién requiere el servicio' data-col='requiere' id="idRequiere" />
            </div>
            <div class='filter-container'>
                <label>Estado: </label>
                <input autocomplete='off' class='filter' name='estado' placeholder='Buscar estado del ticket' data-col='estado' id="idEstado">
            </div>
            <div class='filter-container'>
            <label>Clasificación: </label>
                <input autocomplete='off' class='filter' name='clasificacion' placeholder='Buscar clasificacion del ticket' data-col='clasificación' id="idClasificacion" />
            </div>
            <div class='filter-container'>
            <label>Subclasificación: </label>
                <input autocomplete='off' class='filter' name='subclasificacion' placeholder='Buscar subclasificacion del ticket' data-col='subclasificación' id="Subclasificacion" />
            </div>
            <div class='filter-container'>
            <label>Comentarios: </label>
                <input autocomplete='off' class='filter' name='comentarios' placeholder='Buscar comentarios del ticket' data-col='comentarios' id="idComentarios" />
            </div>
            <!-- <div class='clearfix'></div> -->
        </div>
    </div>


    <div class='tabla__contenedor'>



        <table id="myTable" class="table table-hover tabla" cellspacing="0" cellpadding="0">
            <thead class="tabla__header">
                <th class="tabla__th">Folio#</th>
                <th class="tabla__th">Fecha de captura</th>
                <th class="tabla__th">Asigna</th>
                <th class="tabla__th">Atiende</th>
                <th class="tabla__th">Requiere</th>
                <th class="tabla__th">Estado</th>
                <th class="tabla__th">Clasificación</th>
                <th class="tabla__th">Subclasificación</th>
                <th class="tabla__th">Comentarios</th>
                <th class="tabla__th">Acciones</th>
            </thead>
            </thead>
            <tbody class="tabla__body">
                <?php
                foreach ($tickets as $ticket) : ?>

                    <tr class="tabla__row">
                        <td class="tabla__td"><?php echo $ticket->idTicket; ?></td>
                        <td class="tabla__td"><?php echo date('d', strtotime($ticket->fechaCaptura)) . '/' . $meses[date('m', strtotime($ticket->fechaCaptura)) - 1] . '/' . date('Y', strtotime($ticket->fechaCaptura)); ?></td>
                        <td class="tabla__td"><?php echo $ticket->nombreAsigna; ?></td>
                        <td class="tabla__td"><?php echo $ticket->atiende; ?></td>
                        <td class="tabla__td"><?php echo $ticket->nombreRequiere; ?></td>
                        <td class="tabla__td"><?php echo $ticket->estadoTicket; ?></td>
                        <td class="tabla__td"><?php echo $ticket->clasificacion; ?></td>
                        <td class="tabla__td"><?php echo $ticket->subclasificacion; ?></td>
                        <td class="tabla__td"><?php echo $ticket->comentarios; ?></td>

                        <td class="tabla__td">
                            <div class="tabla__tickets--botones  <?php if($idRol==='4') echo 'tabla__tickets--botones--colaborador'; ?> ">
                                <a href="/dashboard/historial-tickets?id=<?php echo $ticket->idTicket; ?>" title='Historial del ticket' class="tabla__boton-azul tabla__boton"><i class="fa-solid fa-clock fa-xl"></i></a>
                                <?php if ($idRol === '1' || $idRol === '2') { ?>
                                    <?php if ($ticket->estadoTicket === 'Abierto' || $ticket->estadoTicket === 'Pausado' || $ticket->estadoTicket === 'Escalado') { ?>
                                        <?php if ($ticket->atiende === 'Sin asignar') { ?>
                                        <a href="/dashboard/asignar-tickets?id=<?php echo $ticket->idTicket; ?>" title='Asignar ticket' class="tabla__boton-verde-limon tabla__boton"><i class="fa-solid fa-person-walking-arrow-loop-left fa-2xl"></i></i></a>
                                        <?php } ?>
                                        <a href="/dashboard/escalar-tickets?id=<?php echo $ticket->idTicket; ?>" title='Escalar ticket' class="tabla__boton-naranja tabla__boton"><i class="fa-solid fa-arrow-trend-up fa-2xl"></i></a>
                                        <a href="/dashboard/cerrar-tickets?id=<?php echo $ticket->idTicket; ?>" title='Cerrar ticket' class="tabla__boton-verde tabla__boton"><i class="fa-solid fa-circle-check fa-xl"></i></a>
                                    <?php } else { ?>
                                        <p class="tabla__cerrado">Ticket cerrado</p>
                                    <?php } ?>
                                <?php } ?>

                                <?php if ($idRol === '3') { ?>
                                    <?php if ($ticket->estadoTicket === 'Abierto' || $ticket->estadoTicket === 'Pausado' || $ticket->estadoTicket === 'Escalado') { ?>


                                        <a href="/dashboard/cerrar-tickets?id=<?php echo $ticket->idTicket; ?>" title='Cerrar ticket' class="tabla__boton-verde tabla__boton"><i class="fa-solid fa-circle-check fa-xl"></i></a>
                                    <?php } ?>
                                <?php } ?>

                            </div>



                        </td>
                    </tr>
                <?php endforeach; ?>


























            </tbody>
        </table>
    </div>


    <!-- <ul class="pagination pagination-lg pager" id="myPager"></ul> -->

    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>

</body>

</html>

<?php $script = "
<script src='/build/js/dashboard.js' defer></script>
<script src='/build/js/ver-tickets.js' defer></script>

"

?>