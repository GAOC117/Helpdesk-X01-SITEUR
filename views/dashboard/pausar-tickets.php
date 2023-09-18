<main class="generar-ticket">

    <div class="generar-ticket__header">
        <h2 class="generar-ticket__heading"><?php echo $titulo; ?></h2>
        <p class="generar-ticket__texto">Indique el motivo de ser pausado el ticket</p>


    </div>
    <div class="generar-ticket__alertas">

        <?php
        require_once __DIR__ . '/../templates/alertas.php';
        ?>

    </div>
    <div class="generar-ticket__datos">

        <form action="/dashboard/pausar-tickets?id=<?php echo $idTicket;?>" class="generar-ticket__formulario" method="POST">

                <div class="formulario__comentarios">
                    <textarea class="formulario__comentarios-text-area" name="comentarios" id="comentarios" maxlength="250" placeholder="Comentarios"><?php echo $ticket->comentarios; ?></textarea>
                </div>

            </div><!-- grid -->


            <!-- <i class="fa-solid fa-circle-pause fa-xl"> -->
            <input type="submit" class="boton-pausar-ticket" value="Pausar ticket">

        </form>

       
    </div>




</main>

<?php $script = "
<script src='/build/js/app.js' defer></script>
<script src='/build/js/dashboard.js' defer></script>
<script src='/build/js/ticket-nuevo.js' defer></script>
"

?>