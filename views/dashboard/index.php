<main class="dash-empleado">

    <div class="dash-empleado__imagen">
        <?php if($expedienteLogueado==='4486') { ?>
        <img src="/build/img/memocle.png" alt="<?php echo 'Foto de' . $nombre; ?>" class="empleado__imagen--foto">
        <?php } ?>
        <?php if($expedienteLogueado!=='4486') { ?>
        <img src="http://skynet.siteur.gob.mx/fotos/<?php echo $expedienteLogueado; ?>.jpg" alt="<?php echo 'Foto de' . $nombre; ?>" class="empleado__imagen--foto">
        <?php } ?>
    </div>

    <!-- <div class="dash-empleado__informacion"> -->

        <div class="dash-empleado__informacion-tickete">
            <!-- si es colaborador solo ver abiertos y cerrados -->
            <a href="">
                <div class="dash-empleado__informacion-tickete--total tickete--info">
                    <p class="tickete--texto">Total de tickets</p>
                    <p class="tickete--texto tickets--cantidad">53</p>
                </div>
            </a>
            <a href="">
                <div class="dash-empleado__informacion-tickete--abiertos tickete--info">
                    <p class="tickete--texto">Tickets abiertos</p>
                    <p class="tickete--texto tickets--cantidad">22</p>
                </div>
            </a>
            <a href="">
                <div class="dash-empleado__informacion-tickete--pausados tickete--info">
                    <p class="tickete--texto">Tickets pausados</p>
                    <p class="tickete--texto tickets--cantidad">3</p>
                </div>
            </a>
            <a href="">
                <div class="dash-empleado__informacion-tickete--cerrados tickete--info">
                    <p class="tickete--texto">Tickets cerrados</p>
                    <p class="tickete--texto tickets--cantidad">28</p>
                </div>
            </a>
        </div> <!-- .empleado__informacion-tickets -->
<div>

    <div class="dash-empleado__informacion-texto">
      <p class="dash-empleado__informacion-texto--leyenda">La información mostrada corresponde al mes en curso</p>
    </div>
</div>

    <!-- </div> -->
    <!-- .empleado__informacion -->

</main>



<?php $script = "
<script src='/build/js/app.js' defer></script>
<script src='/build/js/dashboard.js' defer></script>
"

?>