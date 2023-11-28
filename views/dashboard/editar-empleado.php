<div class="text-center mb-5 pt-5 pt-md-0">
    <h2><i class='bi bi-person-lines-fill me-3'></i><?php echo $titulo; ?></h2>
</div>



<?php
require_once __DIR__ . '/../templates/alertas.php';
?>

<div class="container-xl">
    <div class="row">

        <div class="col-md-6">
            <form class="mt-5" method="POST">

                <div class="row">

                    <div class="col-md-4">
                        <label for="nombre" class="form-label fs-4">Nombre(s):</label>
                        <input type="text" class="form-control fs-4" placeholder="Nombre(s)" id="nombre" name="nombre" value="<?php echo $usuario->nombre ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="apellidoPaterno" class="form-label fs-4">Apellido paterno:</label>
                        <input type="text" class="form-control fs-4 " placeholder="Apellido paterno" id="apellidoPaterno" name="apellidoPaterno" value="<?php echo $usuario->apellidoPaterno; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="apellidoMaterno" class="form-label fs-4">Apellido materno:</label>
                        <input type="text" class="form-control fs-4" placeholder="Apellido materno" id="apellido-materno" name="apellidoMaterno" value="<?php echo $usuario->apellidoMaterno; ?>">
                    </div>

                    <div class="col-md-4">
                        <label for="id" class="form-label fs-4 mt-5">Expediente:</label>
                        <input type="number" class="form-control fs-4 " placeholder="Expediente" id="id" name="id" value="<?php echo $usuario->id; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="extension" class="form-label fs-4 mt-5">Extensión:</label>
                        <input type="number" class="form-control fs-4 " placeholder="Extensión" id="extension" name="extension" value="<?php echo $usuario->extension; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label fs-4 mt-5">Correo:</label>
                        <input type="email" class="form-control fs-4 " placeholder="Correo electrónico" id="email" name="email" value="<?php echo $usuario->email; ?>">
                    </div>


                    <div class="col-md-12">
                        <fieldset class="mt-5 fw-bold px-0">
                            <legend>Seleccione el departamento al que pertenece</legend>
                            <select class="form-select select fs-4" name="idDepartamento" id="idDepartamento" autocomplete="on">
                                <option value="" disabled selected>--Seleccionar--</option>
                                <?php foreach ($departamentos as $departamento) { ?>

                                    <option <?php echo  $usuario->idDepartamento === $departamento->id ? ' selected' : '' ?> value="<?php echo s($departamento->id); ?>"><?php echo s($departamento->descripcion); ?>

                                    </option>
                                <?php } ?>
                            </select>
                        </fieldset>
                    </div>

                    <div class="col-md-12">
                        <fieldset class="mt-5 fw-bold px-0">
                            <legend>Seleccione el rol del empleado</legend>
                            <select class="form-select select fs-4" name="idRol" id="idRol" autocomplete="on">
                                <option value="" disabled selected>--Seleccionar--</option>
                                <?php foreach ($roles as $rol) { ?>

                                    <option <?php echo  $usuario->idRol === $rol->id ? ' selected' : '' ?> value="<?php echo s($rol->id); ?>"><?php echo s(ucfirst($rol->descripcion)); ?>

                                    </option>
                                <?php } ?>
                            </select>
                        </fieldset>
                    </div>


                    <div class="d-flex justify-content-center mt-5">
                       
                        <input type="submit" class="btn btn-dark fs-2 my-3" value="Actualizar datos">
                    </div>


                </div>








               
            </form>
        </div>
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
            <img src="/build/img/editar.png" class="img-fluid img-pausar" alt="...">
        </div>



    </div>
</div>

<?php $script = "
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/selects.js' defer></script>
<script src='/build/js/bootstrap.bundle.min.js'></script>



";
if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>