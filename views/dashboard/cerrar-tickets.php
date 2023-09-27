<main class="cerrar-ticket">

    <div class="boton-regresar">

<a href="/dashboard/ver-tickets" class="volver-ver-tickets"><i class="fa-solid fa-left-long fa-3x"></i> Volver</a>
</div>
    <div class="cerrar-ticket__header">
        <h2 class="cerrar-ticket__heading"><?php echo $titulo; ?></h2>
        <p class="cerrar-ticket__texto">Ingrese un comentario para cerrar el ticket</p>


    </div>
    <div class="cerrar-ticket__alertas">

        <?php
        require_once __DIR__ . '/../templates/alertas.php';
        ?>

    </div>
    <div class="cerrar-ticket__datos">

        <form action="/dashboard/cerrar-tickets?id=<?php echo $idTicket; ?>" class="cerrar-ticket__formulario" method="POST">

            <div class="formulario__comentarios">
                <textarea class="formulario__comentarios-text-area" name="comentarios" id="comentarios" maxlength="250" placeholder="Comentarios"><?php echo $ticket->comentarios; ?></textarea>
            </div>

    </div><!-- grid -->

    <div class="cerrar-ticket__submit">

        <input type="submit" class="formulario__submit--cerrar-ticket" value="Cerrar ticket">
    </div>
    </form>


    </div>




</main>

<?php $script = "
<script src='/build/js/app.js' defer></script>
<script src='/build/js/dashboard.js' defer></script>
<script src='/build/js/ticket-nuevo.js' defer></script>
"

?>