<div class="text-center mb-5 pt-5 pt-md-0">
    <h2><i class='bi bi-building me-3'></i><?php echo $titulo; ?></h2>
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





<?php if (count($departamentos) > 0) : ?>

    <div class='d-flex justify-content-center mb-3 mb-md-0'>
        <label class="filter-label">Departamento: </label>
        <input type="text" autocomplete='off' class='filter' name='departamentos' placeholder='Buscar departamento' data-col='departamento' id="departamento" />
    </div>

<?php endif; ?>



<a href="/dashboard/departamentos/agregar" class="btn btn-success fs-4 mb-5 ms-3">Nuevo departamento</a>

<div class='table-responsive mx-auto w-75 '>
    <table id="myTable" class="table table-hover table-striped table-light align-middle table-bordered" cellspacing="0" cellpadding="0">





        <?php if (count($departamentos) > 0) : ?>

            <thead class="fs-5">
                <tr class="bg-dark">

                    <th class="table-dark text-white text-center">id</th>
                    <th class="table-dark text-white text-center">Departamento</th>
                    <th class="table-dark text-white text-center">Acciones</th>
                </tr>
            </thead>

            <!-- mostrar los resultados -->
            <tbody class="tabla__body-empleados">

                <?php
                foreach ($departamentos as $departamento) : ?>


                    <tr class="fs-5">
                        <td class="text-center fs-5"><?php echo $departamento->id; ?></td>

                        <td class="text-center fs-5"><?php echo $departamento->descripcion; ?></td>


                        <td class="text-center fs-5">
                            <?php if ($departamento->estatus === '1') { ?>
                                <a href="/dashboard/departamentos/editar?id=<?php echo $departamento->id; ?>" class="w-100 btn btn-primary mb-1 fs-4">Editar</a>
                                <form method="POST" action="/dashboard/departamentos/update">
                                    <input type="hidden" name="id" value="<?php echo $departamento->id; ?>">

                                    <input type="submit" class="w-100 btn btn-danger fs-4" value="Dar de baja">
                                </form>


                            <?php } else { ?>
                                <form method="POST" action="/dashboard/departamentos/update">
                                    <input type="hidden" name="id" value="<?php echo $departamento->id; ?>">

                                    <input type="submit" class="w-100 btn btn-info fs-4" value="Dar de alta">
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
    </table>
</div>


</main>

<?php $script = "
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/alertas.js' defer></script>
<script src='/build/js/bootstrap.bundle.min.js'></script>


";
if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>