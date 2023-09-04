<main class="auth reestablecer">
    <div class="auth__contenedor reestablecer">

        <div class="auth__header">

            <h2 class="auth__heading"><?php echo $titulo; ?></h2>
            <p class="auth__texto">Coloca tu contraseña nueva</p>

        </div>

        <?php
        require_once __DIR__ . '/../templates/alertas.php';
        ?>

        <!-- <div class="imagen">

            <img class="imagen__logo" src="/build/img/Logo_de_SITEUR_T.png" alt="logo siteur">

        </div> -->

        <?php if($token_valido) {?>

        <form class="formulario" method="POST">
            <div class="formulario__campo">
                <label for="password" class="formulario__label">Nueva contraseña:</label>
                <input type="password" class="formulario__input" placeholder="Tu nueva contraseña" id="password" name="password">
            </div>
           
            <div class="formulario__campo">
                <label for="password2" class="formulario__label">Repetir contraseña:</label>
                <input type="password" class="formulario__input" placeholder="Repetir contraseña" id="password2" name="password2">
            </div>
           
         


            <input type="submit" class="formulario__submit" value="Guardar contraseña">


        </form>

        <?php }?>

    </div>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Iniciar sesión</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Obtener una</a>
    </div>

</main>