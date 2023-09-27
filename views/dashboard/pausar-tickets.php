<main class="pausar-ticket">
    <div class="boton-regresar">

        <a href="/dashboard/ver-tickets" class="volver-ver-tickets"><i class="fa-solid fa-left-long fa-3x"></i> Volver</a>
    </div>

    <div class="pausar-ticket__header">

        <h2 class="pausar-ticket__heading"><?php echo $titulo; ?></h2>
        <p class="pausar-ticket__texto">Indique el motivo de ser pausado el ticket</p>


    </div>
    <div class="pausar-ticket__alertas">

        <?php
        require_once __DIR__ . '/../templates/alertas.php';
        ?>

    </div>
    <div class="pausar-ticket__datos">

        <form action="/dashboard/pausar-tickets?id=<?php echo $idTicket; ?>" class="pausar-ticket__formulario" method="POST">

            <div class="formulario__comentarios">
                <textarea class="formulario__comentarios-text-area" name="comentarios" id="comentarios" maxlength="250" placeholder="Comentarios"><?php echo $ticket->comentarios; ?></textarea>
            </div>

    </div><!-- grid -->

    <div class="pausar-ticket__submit">

        <!-- <i class="fa-solid fa-circle-pause fa-xl"> -->
        <input type="submit" class="formulario__submit--pausar-ticket" value="Pausar ticket">
    </div>

    </form>


    </div>




</main>

<?php $script = "
<script src='/build/js/dashboard.js' defer></script>
<script src='/build/js/sidebar.js' defer></script>
"

?>