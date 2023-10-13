<main class="dash-empleado">

    <div class="dash-empleado__imagen">
        <?php if ($expedienteLogueado === '4486') { ?>
            <img src="/build/img/vader.png" alt="<?php echo 'Foto de' . $nombre; ?>" class="empleado__imagen--foto">
        <?php } ?>
        <?php if ($expedienteLogueado === '4485') { ?>
            <img src="/build/img/koala.png" alt="<?php echo 'Foto de' . $nombre; ?>" class="empleado__imagen--foto">
        <?php }
        if ($expedienteLogueado !== '4485' && $expedienteLogueado !== '4486') { ?>

            <img src="http://skynet.siteur.gob.mx/fotos/<?php echo $expedienteLogueado; ?>.jpg" alt="empleado" class="empleado__imagen--foto">
        <?php } ?>
    </div>

    <!-- <div class="dash-empleado__informacion"> -->

    <div class="dash-empleado__nombre">
        <p class="dash-empleado__nombre--texto"><?php echo $nombre; ?></p>
    </div>

    <div class="dash-empleado__informacion-tickete">
        <!-- si es colaborador solo ver abiertos y cerrados -->
        <div class="dash-empleado__informacion-tickete--abiertos tickete--info">
            <p class="tickete--texto">Tickets abiertos</p>
            <p class="tickete--texto tickete--cantidad" id="tickets--abiertos"></p>
        </div>
        <div class="dash-empleado__informacion-tickete--pausados tickete--info">
            <p class="tickete--texto">Tickets pausados</p>
            <p class="tickete--texto tickete--cantidad" id="tickets--pausados"></p>
        </div>
        <div class="dash-empleado__informacion-tickete--escalados tickete--info">
            <p class="tickete--texto">Tickets escalados</p>
            <p class="tickete--texto tickete--cantidad" id="tickets--escalados"></p>
        </div>
        <div class="dash-empleado__informacion-tickete--cerrados tickete--info">
            <p class="tickete--texto">Tickets cerrados</p>
            <p class="tickete--texto tickete--cantidad" id="tickets--cerrados"></p>
        </div>
    </div> <!-- .empleado__informacion-tickets -->


    <div class="dash-empleado__informacion-texto">
    <p class="dahs__empleado__informacion-texto--leyenda">Total de tickets: <span id="tickets--totales"></span> </p>
        <p class="dash-empleado__informacion-texto--leyenda">La información mostrada corresponde al mes en curso</p>
    </div>


    <!-- </div> -->
    <!-- .empleado__informacion -->

</main>



<?php $script = "
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/dashboard.js' defer></script>
<script src='/build/js/inicio.js' defer></script>

";
if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>