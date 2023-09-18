<div class="historico-tickets__header">
    <div class="boton-regresar">
        
        <a href="/dashboard/ver-tickets" class="volver-ver-tickets"><i class="fa-solid fa-left-long fa-3x"></i> Volver</a>
    </div>
    <h2 class="asignar-tickets__heading"><?php echo $titulo; ?></h2>
</div>

<body>



    <div class="jquery-script-clear"></div>

    <div class='containerrrr'>
        <div class='filters'>
            <div class='filter-container'>
                <label>Quién atiende: </label>
                <input autocomplete='off' class='filter' name='atiende' placeholder='Buscar quién atiende el servicio' data-col='atiende' id="idAtiende" />
            </div>
            <div class='filter-container'>
                <label>Fecha: </label>
                <input autocomplete='off' class='filter' name='fecha' placeholder='Buscar fecha de captura de ticket' data-col='fecha' id="idFecha" />
            </div>
            <div class='filter-container'>
                <label>Estado: </label>
                <input autocomplete='off' class='filter' name='estado' placeholder='Buscar estado del ticket' data-col='estado' id="idEstado">
            </div>
            <div class='filter-container'>
                <label>Comentarios: </label>
                <input autocomplete='off' class='filter' name='comentarios' placeholder='Buscar comentarios del ticket' data-col='comentarios' id="idComentarios" />
            </div>



            <!-- <div class='clearfix'></div> -->
        </div>
    </div>

    <div class="tabla__contenedor-container">
        <div class='tabla__contenedor'>



            <table id="myTable" class="table table-hover tabla" cellspacing="0" cellpadding="0">
                <thead class="tabla__header">
                    <th class="tabla__th">ID del evento</th>
                    <th class="tabla__th">Ticket #</th>
                    <th class="tabla__th">Estado</th>
                    <th class="tabla__th">Atiende</th>
                    <th class="tabla__th">Fecha del evento</th>
                    <th class="tabla__th">Comentarios</th>
                </thead>
                </thead>
                <tbody class="tabla__body">
                    <?php
                    foreach ($historialTicket as $historico) : ?>

                        <tr class="tabla__row">
                            <td class="tabla__td"><?php echo $historico->id; ?></td>
                            <td class="tabla__td"><?php echo $historico->idTicket; ?></td>
                            <td class="tabla__td"><?php echo $historico->idEstado; ?></td>
                            <td class="tabla__td"><?php echo $historico->idEmpAsignado; ?></td>
                            <td class="tabla__td"><?php echo date('d', strtotime($historico->fechaRegistro)) . '/' . $meses[date('m', strtotime($historico->fechaRegistro)) - 1] . '/' . date('Y', strtotime($historico->fechaRegistro)); ?></td>
                            <td class="tabla__td"><?php echo $historico->comentarios; ?></td>


                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
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