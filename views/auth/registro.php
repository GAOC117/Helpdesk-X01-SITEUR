<div class="container-xl">

    <div class="auth__header mt-5">

        <h2 class="auth__heading "><?php echo $titulo; ?></h2>
        <p class="auth__texto">Registrate en Helpdesk SITEUR</p>

    </div>

    <?php
    require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <div class="row">
        <div class="col-md-6">
            <form action="/registro" class="formulario formulario-registro" method="POST">
                <div class="row">

                    <div class="col-md-4 mb-3 ">
                        <label for="nombre" class="form-label fs-4">Nombre(s):</label>
                        <input type="text" class="form-control fs-4" placeholder="Nombre(s)" id="nombre" name="nombre" value="<?php echo $usuario->nombre ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="apellidoPaterno" class="form-label fs-4">Apellido paterno:</label>
                        <input type="text" class="form-control fs-4 " placeholder="Apellido paterno" id="apellidoPaterno" name="apellidoPaterno" value="<?php echo $usuario->apellidoPaterno; ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="apellidoMaterno" class="form-label fs-4">Apellido materno:</label>
                        <input type="text" class="form-control fs-4 " placeholder="Apellido materno" id="apellido-materno" name="apellidoMaterno" value="<?php echo $usuario->apellidoMaterno; ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="id" class="form-label fs-4">Expediente:</label>
                        <input type="number" class="form-control fs-4 " placeholder="Expediente" id="id" name="id" value="<?php echo $usuario->id; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="extension" class="form-label fs-4">Extensión:</label>
                        <input type="number" class="form-control fs-4 " placeholder="Extensión (opcional)" id="extension" name="extension" value="<?php echo $usuario->extension; ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label fs-4">Correo:</label>
                        <input type="email" class="form-control fs-4 " placeholder="Correo electrónico" id="email" name="email" value="<?php echo $usuario->email; ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="password" class="form-label fs-4">Contraseña:</label>
                        <input type="password" class="form-control fs-4" placeholder="Contraseña" id="password" name="password">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="password2" class="form-label fs-4">Repetir contraseña:</label>
                        <input type="password" class="form-control fs-4 " placeholder="Repetir contraseña" id="password2" name="password2">
                    </div>

                    <div class="col-md-12">
                        
                            <p class="my-3 fs-4">Seleccione el departamento al que pertenece</p>
                            <select class="form-select select fs-4 mb-5" name="idDepartamento" id="idDepartamento" autocomplete="on">
                                <option  value="" disabled selected>--Seleccionar--</option>
                                <?php foreach ($departamentos as $departamento) { ?>

                                    <option  <?php echo  $usuario->idDepartamento === $departamento->id ? ' selected' : '' ?> value="<?php echo s($departamento->id); ?>"><?php echo s($departamento->descripcion); ?>

                                    </option>
                                <?php } ?>
                            </select>
                       
                    </div>

                </div>


                <div class="d-flex justify-content-center my-5">
                <input type="submit" class="btn btn-primary fs-4" value="Registrarse" id="botonRegistrar">
                </div>

               



                


            </form>

            <div class="d-flex justify-content-between align-items-center mb-5 pb-5">

                <a href="/login" class="text-primary text-center">¿Ya tienes cuenta? Iniciar sesión</a>
                <a href="/olvide" class="text-primary text-center">¿Olvidaste tu contraseña? Recuperar</a>
            </div>
        </div>
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
            <img src="/build/img/registrar.png" class="img-fluid img-registro" alt="...">
        </div>




    </div>



</div>



<?php $script = "

<script src='/build/js/bootstrap.bundle.min.js'></script>

";
