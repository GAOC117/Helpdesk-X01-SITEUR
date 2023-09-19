
<?php
    if ($_SESSION['mensaje']) { ?>
<p class="alerta alerta__exito">
   <?php
        echo $_SESSION['mensaje'];
        $_SESSION['mensaje'] = '';
    ?>
</p>

<?php } ?>





<div class="asignar-tickets__header">
    <h2 class="asignar-tickets__heading"><?php echo $titulo; ?></h2>
</div>

<body>



    <!-- <div class="jquery-script-clear"></div> -->


    <div class='containerrrr'>
        <div class='filters'>
            <div class='filter-container'>
                <label>Folio: </label>
                <input type="number" autocomplete='off' class='filter' name='folio' placeholder='Buscar folio' data-col='folio' id="idFolio" />
            </div>
            <!-- <div class='filter-container'>
                <label>Quién asigna: </label>
                <input autocomplete='off' class='filter' name='asigna' placeholder='Buscar quién asigna el ticket' data-col='asigna' id="idAsigna" />
            </div> -->
            <div class='filter-container'>
                <label>Quién atiende: </label>
                <input autocomplete='off' class='filter' name='atiende' placeholder='Buscar quién atiende el servicio' data-col='atiende' id="idAtiende" />
            </div>
            <div class='filter-container'>
                <label>Fecha: </label>
                <input autocomplete='off' class='filter' name='fecha' placeholder='Buscar fecha de captura (dd/mm/aaaa)' data-col='fecha' id="idFecha" />
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
                <input autocomplete='off' class='filter' name='subclasificacion' placeholder='Buscar subclasificacion del ticket' data-col='subclasificación' id="idSubclasificacion" />
            </div>
            <div class='filter-container'>
                <label>Comentarios de ticket: </label>
                <input autocomplete='off' class='filter' name='captura' placeholder='Buscar comentarios del ticket' data-col='captura' id="idComentarios" />
            </div>
            <div class='filter-container'>
                <label>Comentarios de soporte: </label>
                <input autocomplete='off' class='filter' name='soporte' placeholder='Buscar comentarios de soporte' data-col='soporte' id="idComentariosSoporte" />
            </div>
        </div>
    </div>

    <div class="tabla__contenedor-container">

        <div class='tabla__contenedor'>



            <table id="myTable" class="table table-hover tabla" cellspacing="0" cellpadding="0">
                <thead class="tabla__header">
                    <tr class="tabla__header__pegar">

                        <th class="tabla__th">Folio#</th>
                        <th class="tabla__th">Fecha registro</th>
                        <!-- <th class="tabla__th">Asigna</th> -->
                        <th class="tabla__th">Atiende</th>
                        <th class="tabla__th">Requiere</th>
                        <th class="tabla__th">Estado</th>
                        <th class="tabla__th">Clasificación</th>
                        <th class="tabla__th">Subclasificación</th>
                        <th class="tabla__th">Comentarios de captura</th>
                        <th class="tabla__th">Comentarios de soporte</th>
                        <th class="tabla__th">Acciones</th>
                    </tr>
                </thead>
            
                <tbody class="tabla__body tickets">
                    
                </tbody>
            </table>
        </div>
    </div>


    <!-- <ul class="pagination pagination-lg pager" id="myPager"></ul> -->

    <!-- <script type="text/javascript">
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
    </script> -->

</body>

</html>

<?php $script = "
<script src='/build/js/dashboard.js' defer></script>
<script src='/build/js/ver-tickets.js' defer></script>

"

?>