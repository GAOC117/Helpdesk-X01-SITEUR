<div class="text-center mb-5 pt-5 pt-md-0">
    <h2><i class='bi bi-people-fill me-3'></i><?php echo $titulo; ?></h2>
</div>


<?php

if ($_SESSION['mensaje']) {
?>
    <div class="mx-auto mx-5 w-50 div-alerta ">

        <p class="alerta alerta__exito">
            <?php
            echo $_SESSION['mensaje'];
            $_SESSION['mensaje'] = '';
            ?>
        </p>
    </div>

<?php }
?>




<?php if (count($empleados) > 0) : ?>

    <div class='container-xl'>
        <div class='justify-content-center row mb-5 flex-column flex-md-row'>
            <div class=' col-md-4 d-flex justify-content-between justify-content-md-center mb-3 mb-md-0'>
                <label class="filter-label">Expediente: </label>
                <input type="number" autocomplete='off' class='filter' name='expediente' placeholder='Buscar expediente' data-col='expediente' id="expediente" />
            </div>

            <div class=' col-md-4 d-flex  justify-content-between justify-content-md-center'>
                <label class="filter-label">Nombre del empleado: </label>
                <input autocomplete='off' class='filter' name='nombre' placeholder='Buscar nombre' data-col='nombre' id="nombre" />
            </div>
        </div>
    </div>

<?php endif; ?>


<div class='table-responsive mx-3'>
    <table id="myTable" class="table table-hover table-striped table-light align-middle table-bordered" cellspacing="0" cellpadding="0">





        <?php if (count($empleados) > 0) : ?>

            <thead class="fs-5">
                <tr class="bg-dark">

                    <th class="table-dark text-white text-center">Expediente</th>
                    <th class="table-dark text-white text-center">Nombre</th>
                    <th class="table-dark text-white text-center">Correo</th>
                    <th class="table-dark text-white text-center">Extensión</th>
                    <th class="table-dark text-white text-center">Departamento</th>
                    <th class="table-dark text-white text-center">Rol</th>
                    <th class="table-dark text-white text-center">Acciones</th>
                </tr>
            </thead>

            <!-- mostrar los resultados -->
            <tbody class="">

                <?php
                foreach ($empleados as $empleado) : ?>
                    <?php if ($empleado->id === '0') continue; ?>

                    <tr class="fs-5">
                        <td class="text-center fs-5""><?php echo $empleado->id; ?></td>
                            <td class=" text-center fs-5""><?php echo $empleado->nombre . ' ' . $empleado->apellidoPaterno . ' ' . $empleado->apellidoMaterno; ?></td>
                        <td class="text-center fs-5""><?php echo $empleado->email; ?></td>
                            <td class=" text-center fs-5""><?php echo $empleado->extension; ?></td>
                        <td class="text-center fs-5""><?php echo $empleado->departamento; ?></td>
                            <td class=" text-center fs-5""><?php echo ucfirst($empleado->rol); ?></td>
                        <td class="text-center fs-5"">
                                <?php if ($empleado->estatus === '1') { ?>
                                    <a href=" /dashboard/empleados/editar?id=<?php echo $empleado->id; ?>" class="w-100 btn btn-primary mb-1 fs-4">Editar</a>
                            <form method="POST" action="/dashboard/empleados/update">
                                <input type="hidden" name="id" value="<?php echo $empleado->id; ?>">

                                <input type="submit" class="w-100 btn btn-danger fs-4" value="Dar de baja">
                            </form>


                        <?php } else { ?>
                            <form method="POST" action="/dashboard/empleados/update">
                                <input type="hidden" name="id" value="<?php echo $empleado->id; ?>">

                                <input type="submit" class=" w-100 btn btn-info fs-4" value="Dar de alta">
                            </form>
                        <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
    </table>
</div>




<?php $script = "
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/alertas.js' defer></script>
<script src='/build/js/bootstrap.bundle.min.js'></script>

";
if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>