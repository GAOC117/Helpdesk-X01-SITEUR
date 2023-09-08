<main class="empleado">

    <div class="empleado__imagen">
        <img src="http://skynet.siteur.gob.mx/fotos/<?php echo $expediente; ?>.jpg" alt="<?php echo 'Foto de' . $nombre; ?>" class="empleado__imagen--foto">
    </div>

    <div class="empleado__informacion">

        <div class="empleado__informacion-tickets">
            <!-- si es colaborador solo ver abiertos y cerrados -->
            <a href="">
                <div class="empleado__informacion-tickets tickets--total">
                    <p class="tickets--texto">Total de tickets</p>
                    <p class="tickets--texto tickets--cantidad">2</p>
                </div>
            </a>
            <a href="">
                <div class="empleado__informacion-tickets tickets--abiertos">
                    <p class="tickets--texto">Tickets abiertos</p>
                    <p class="tickets--texto tickets--cantidad">2</p>
                </div>
            </a>
            <a href="">
                <div class="empleado__informacion-tickets tickets-pausados">
                    <p class="tickets--texto">Tickets pausados</p>
                    <p class="tickets--texto tickets--cantidad">2</p>
                </div>
            </a>
            <a href="">
                <div class="empleado__informacion-tickets tickets-cerrados">
                    <p class="tickets--texto">Tickets cerrados</p>
                    <p class="tickets--texto tickets--cantidad">2</p>
                </div>
            </a>
        </div> <!-- .empleado__informacion-tickets -->
        <div class="empleado__informacion-texto">
            <p class="empleado__informacion-texto--leyenda">La información mostrada corresponde al mes en curso</p>
        </div>

    </div><!-- .empleado__informacion -->

</main>