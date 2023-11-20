<main class="auth confirmar">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Tu cuenta de HelpDesk</p>
    <div class="auth__contenedor__confirmar">
        <?php
        require_once __DIR__ . '/../templates/alertas.php';
        ?>
    </div>


    <?php if(isset($alertas['exito'])) { ?>
    <div class="acciones">
        <a href="/login" class="acciones__enlace">Iniciar sesión</a>
    </div>
    <?php } ?>
</main>

<?php $script = "

<script src='/build/js/bootstrap.bundle.min.js'></script>

";
