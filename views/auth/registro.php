<main class="auth ">
    <div class="auth__contenedor">

        <div class="auth__header">

            <h2 class="auth__heading registro"><?php echo $titulo; ?></h2>
            <p class="auth__texto registro">Registrate en Helpdesk SITEUR</p>


            <?php
            require_once __DIR__ . '/../templates/alertas.php';
            ?>

        </div>

        <!-- <div class="imagen">

            <img class="imagen__logo" src="/build/img/Logo_de_SITEUR_T.png" alt="logo siteur">

        </div> -->
        <form action="/registro" class="formulario" method="POST">


            <div class="formulario__datos-empleado">

                <div class="formulario__campo ">
                    <label for="nombre" class="formulario__label">Nombre(s):</label>
                    <input type="text" class="formulario__input" placeholder="Nombre(s)" id="nombre" name="nombre" value="<?php echo $usuario->nombre ?>">
                </div>

                <div class="formulario__campo ">
                    <label for="apellidoPaterno" class="formulario__label">Apellido paterno:</label>
                    <input type="text" class="formulario__input " placeholder="Apellido paterno" id="apellidoPaterno" name="apellidoPaterno" value="<?php echo $usuario->apellidoPaterno; ?>">
                </div>

                <div class="formulario__campo ">
                    <label for="apellidoMaterno" class="formulario__label">Apellido materno:</label>
                    <input type="text" class="formulario__input " placeholder="Apellido materno" id="apellido-materno" name="apellidoMaterno" value="<?php echo $usuario->apellidoMaterno; ?>">
                </div>
            </div>

            <div class="expediente-extension">

                <div class="formulario__campo">
                    <label for="id" class="formulario__label">Expediente:</label>
                    <input type="number" class="formulario__input " placeholder="Expediente" id="id" name="id" value="<?php echo $usuario->id; ?>">
                </div>

                <div class="formulario__campo ">
                    <label for="extension" class="formulario__label">Extensión:</label>
                    <input type="number" class="formulario__input " placeholder="Extensión" id="extension" name="extension" value="<?php echo $usuario->extension; ?>">
                </div>



            </div>


            <div class="formulario__datos-empleado">
                <div class="formulario__campo ">
                    <label for="email" class="formulario__label">Correo:</label>
                    <input type="email" class="formulario__input " placeholder="Correo electrónico" id="email" name="email" value="<?php echo $usuario->email; ?>">
                </div>

                <div class="formulario__campo ">
                    <label for="password" class="formulario__label">Contraseña:</label>
                    <input type="password" class="formulario__input" placeholder="Contraseña" id="password" name="password">
                </div>

                <div class="formulario__campo ">
                    <label for="password2" class="formulario__label">Repetir contraseña:</label>
                    <input type="password" class="formulario__input " placeholder="Repetir contraseña" id="password2" name="password2">
                </div>
            </div>

            <div class="formulario__campo ">
                <fieldset class="formulario__fieldset">
                    <legend>Seleccione el departamento al que pertenece</legend>
                    <select  class="formulario__campo select" name="idDepartamento" id="idDepartamento" autocomplete="on">
                        <option value="" disabled selected>--Seleccionar--</option>
                        <?php foreach ($departamentos as $departamento) { ?>
                            <option <?php echo  $usuario->idDepartamento === $departamento->id ? ' selected' : '' ?> value="<?php echo s($departamento->id); ?>"><?php echo s($departamento->descripcion) ; ?>

                        <?php } ?>
                    </select>
                </fieldset>
            </div>



            <input type="submit" class="formulario__submit" value="Registrarse" id="botonRegistrar">


        </form>

    </div>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Iniciar sesión</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña? Recuperar</a>
    </div>

</main>