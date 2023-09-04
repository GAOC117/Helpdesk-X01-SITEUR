<main class="authl login">
    <div class="authl__contenedor">

        <h2 class="authl__heading"><?php echo $titulo; ?></h2>
        <p class="authl__texto">Inicia sesión en Helpdesk SITEUR</p>

        <?php
        require_once __DIR__ . '/../templates/alertas.php';
        ?>

        <div class="imagen">
            <img class="imagen__logo" src="/build/img/Logo_de_SITEUR_T.png" alt="logo siteur">
        </div>

        <form action="/login" class="formulariol" method="POST">
            <div class="formulariol__campo">
                <label for="email" class="formulariol__label">Correo:</label>
                <input type="email" class="formulariol__input" placeholder="Tu correo electrónico" id="email" name="email" value="<?php echo $email; ?>">
            </div>

            <div class="formulariol__campo">
                <label for="password" class="formulariol__label">Contraseña:</label>
                <input type="password" class="formulariol__input" placeholder="Tu contraseña" id="password" name="password">
            </div>

            <input type="submit" class="formulariol__submit" value="Iniciar sesión">


        </form>

    </div>

    <div class="accionesl">
        <a href="/registro" class="accionesl__enlace">¿Aún no tienes cuenta? Obtener una</a>
        <a href="/olvide" class="accionesl__enlace">¿Olvidaste tu contraseña? Recuperar</a>
    </div>

</main>