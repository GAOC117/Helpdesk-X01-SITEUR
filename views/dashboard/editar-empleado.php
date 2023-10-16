<main class="editar-empleado">


    <div class="editar-empleado__header">
        <h2 class="editar-empleado__texto"><?php echo $titulo; ?></h2>

        <?php
        require_once __DIR__ . '/../templates/alertas.php';
        ?>
       

    </div>

    <div class="editar-empleado__datos">
        <form class="editar-empleado__form formulario" method="POST">

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

                <div class="formulario__campo ">
                    <label for="email" class="formulario__label">Correo:</label>
                    <input type="email" class="formulario__input " placeholder="Correo electrónico" id="email" name="email" value="<?php echo $usuario->email; ?>">
                </div>



            </div>

            <div class="formulario__campo ">
                <fieldset class="formulario__fieldset">
                    <legend>Seleccione el departamento al que pertenece</legend>
                    <select class="formulario__campo select" name="idDepartamento" id="idDepartamento" autocomplete="on">
                        <option value="" disabled selected>--Seleccionar--</option>
                        <?php foreach ($departamentos as $departamento) { ?>

                            <option <?php echo  $usuario->idDepartamento === $departamento->id ? ' selected' : '' ?> value="<?php echo s($departamento->id); ?>"><?php echo s($departamento->descripcion); ?>

                            </option>
                        <?php } ?>
                    </select>
                </fieldset>
            </div>

            <div class="formulario__campo ">
                <fieldset class="formulario__fieldset">
                    <legend>Seleccione el rol del empleado</legend>
                    <select class="formulario__campo select" name="idRol" id="idRol" autocomplete="on">
                        <option value="" disabled selected>--Seleccionar--</option>
                        <?php foreach ($roles as $rol) { ?>

                            <option <?php echo  $usuario->idRol === $rol->id ? ' selected' : '' ?> value="<?php echo s($rol->id); ?>"><?php echo s(ucfirst($rol->descripcion)); ?>

                            </option>
                        <?php } ?>
                    </select>
                </fieldset>
            </div>




            <input type="submit" class="formulario__submit editar-empleado__btn" value="Actualizar datos">
        </form>
    </div>






</main>

<?php $script = "
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/selects.js' defer></script>



";
if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>