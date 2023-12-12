<main class="authl login">
    <div class="authl__contenedor mt-3 pt-3 ">

        <h2 class="authl__heading mt-5 pt-5 text-center fs-2"><?php echo $titulo; ?></h2>
        <p class="authl__texto fs-5">Inicia sesión en Helpdesk SITEUR</p>

        <?php
        require_once __DIR__ . '/../templates/alertas.php';
        ?>

        <div class="imagen">
            <img class="imagen__logo" src="/build/img/Logo_de_SITEUR_T.png" alt="logo siteur">
        </div>

        <form action="/login" class="formulariol" method="POST">
            <div class="formulariol__campo">
                <label for="email" class="form-label fs-4">Correo:</label>
                <input type="email" class="formulariol__input fs-4" placeholder="Tu correo electrónico" id="email" name="email" value="<?php echo s($email); ?>">
            </div>

            <div class="formulariol__campo">
                <label for="password" class="form-label fs-4">Contraseña:</label>
                <input type="password" class="formulariol__input fs-4" placeholder="Tu contraseña" id="password" name="password">
            </div>

            <div class="d-flex justify-content-center mt-5">
                <input type="submit" class="btn btn-primary fs-2" value="Iniciar sesión">
            </div>

        </form>

    </div>
   

        <div class="d-flex flex-md-row justify-content-md-center flex-column mb-5 pb-5 mb-md-0 pb-md-0 mt-md-5">
            <a href="/registro" class="text-white text-center me-md-5 fs-4">¿Aún no tienes cuenta? Obtener una</a>
            <a href="/olvide" class="text-white text-center ms-md-5 fs-4">¿Olvidaste tu contraseña? Recuperar</a>
        </div>


</main>


<?php $script = "

<script src='/build/js/bootstrap.bundle.min.js'></script>

";
