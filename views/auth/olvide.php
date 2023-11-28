<div class="container-xl pb-5">
    <div class="auth__header mt-5">

        <h2 class="auth__heading"><?php echo $titulo; ?></h2>
        <p class="auth__texto">Recupera tu acceso a Helpdesk SITEUR</p>

    </div>

    <?php
    require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <div class="row align-items-center justify-content-center">
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
            <img src="/build/img/forgot.png" class="img-fluid img-olvide" alt="...">
        </div>

        <div class="col-md-6">

            <form action="/olvide" class="mt-5" method="POST">
                <div class="formulario__campo">
                    <label for="email" class="form-label fs-4">Correo:</label>
                    <input type="email" class="form-control fs-4" placeholder="Correo electrónico" id="email" name="email">
                </div>





                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary fs-4 my-5" value="Enviar instrucciones">
                </div>

            </form>

            <div class="d-flex justify-content-between align-items-center">

                <a href="/login" class="text-primary text-center">¿Ya tienes cuenta? Iniciar sesión</a>
                <a href="/registro" class="text-primary text-center">¿Aún no tienes cuenta? Obtener una</a>
            </div>
        </div>

    </div>
</div>


</div>






<?php $script = "

<script src='/build/js/bootstrap.bundle.min.js'></script>

";
