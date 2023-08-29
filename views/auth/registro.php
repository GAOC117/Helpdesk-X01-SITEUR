<main class="auth registro">
    <div class="auth__contenedor registro">

        <div class="registro-heading">

            <h2 class="auth__heading registro"><?php echo $titulo; ?></h2>
            <p class="auth__texto registro">Registrate en Helpdesk SITEUR</p>

        </div>

        <div class="imagen">

            <img class="imagen__logo" src="/build/img/Logo_de_SITEUR_T.png" alt="logo siteur">

        </div>
        <form action="" class="formulario registro" method="POST">

        <div class="formulario__campo registro exp">
                    <label for="exp" class="formulario__label">Expediente:</label>
                    <input type="number" class="formulario__input registro" placeholder="Expediente" id="exp" name="exp">
        </div>

            <div class="formulario__datos-empleado">

                <div class="formulario__campo registro">
                    <label for="nombre" class="formulario__label">Nombre(s):</label>
                    <input type="text" class="formulario__input registro" placeholder="Nombre(s)" id="nombre" name="nombre">
                </div>

                <div class="formulario__campo registro">
                    <label for="apellido-paterno" class="formulario__label">Apellido paterno:</label>
                    <input type="text" class="formulario__input registro" placeholder="Apellido paterno" id="apellido-paterno" name="apellido-paterno">
                </div>

                <div class="formulario__campo registro">
                    <label for="apellido-materno" class="formulario__label">Apellido materno:</label>
                    <input type="text" class="formulario__input registro" placeholder="Apellido materno" id="apellido-materno" name="apellido-materno">
                </div>
            </div>


            <div class="formulario__datos-empleado">
                <div class="formulario__campo registro">
                    <label for="email" class="formulario__label">Correo:</label>
                    <input type="email" class="formulario__input registro" placeholder="Correo electrónico" id="email" name="email">
                </div>

                <div class="formulario__campo registro">
                    <label for="password" class="formulario__label">Contraseña:</label>
                    <input type="password" class="formulario__input registro" placeholder="Contraseña" id="password" name="password">
                </div>

                <div class="formulario__campo registro">
                    <label for="password2" class="formulario__label">Repetir contraseña:</label>
                    <input type="password" class="formulario__input registro" placeholder="Repetir contraseña" id="password2" name="password2">
                </div>
            </div>

            <div class="formulario__campo registro">
                <fieldset class="rigistro-fieldset">
                    <legend>Departamento</legend>
                    <select class="formulario__campo select" name="departamento" id="departamento">
                        <option value="" disabled selected>--Seleccionar--</option>
                        <option value="1">Informática</option>
                    </select>
                </fieldset>
            </div>



            <input type="submit" class="formulario__submit" value="Registrarse">


        </form>

    </div>

    <div class="acciones registro">
        <a href="/login" class="acciones__enlace registro">Ya tienes cuenta? Iniciar sesión</a>
        <a href="/olvide" class="acciones__enlace registro">¿Olvidaste tu contraseña? Recuperar</a>
    </div>

</main>