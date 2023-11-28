<div class="text-center mb-5 pt-5 pt-md-0">
    <h2><i class='fa-brands fa-jedi-order me-3'></i><?php echo $titulo; ?></h2>
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


<?php if (count($clasificaciones) > 0) : ?>



    <div class='d-flex justify-content-center mb-3 mb-md-0'>
        <label class="form-label">Clasificación: </label>
        <input type="text" autocomplete='off' class='filter' name='clasificación' placeholder='Buscar clasificación' data-col='clasificación' id="clasificación" />
    </div>


<?php endif; ?>
<a href="/dashboard/clasificaciones/agregar" class="btn btn-success fs-4 mb-5 ms-3">Nueva clasificación</a>


<div class="container-md-xl">



<div class='table-responsive mx-auto w-75 '>
    <table id="myTable" class="table table-hover table-striped table-light align-middle table-bordered" cellspacing="0" cellpadding="0">


        <?php if (count($clasificaciones) > 0) : ?>

            <thead class="fs-5">
                <tr class="bg-dark">

                    <th class="table-dark text-white text-center">id</th>
                    <th class="table-dark text-white text-center">Clasificación</th>
                    <th class="table-dark text-white text-center w-25">Acciones</th>
                </tr>
            </thead>

            <!-- mostrar los resultados -->
            <tbody class="">

                <?php
                foreach ($clasificaciones as $clasificacion) : ?>


                    <tr class="fs-5">
                        <td class="text-center fs-5"><?php echo $clasificacion->id; ?></td>

                        <td class="text-center fs-5"><?php echo $clasificacion->descripcion; ?></td>


                        <td class="text-center fs-5">
                            <?php if ($clasificacion->estatus === '1') { ?>
                                <a href="/dashboard/clasificaciones/editar?id=<?php echo $clasificacion->id; ?>" class="w-100 btn btn-primary mb-1 fs-4">Editar</a>
                                <form method="POST" action="/dashboard/clasificaciones/update">
                                    <input type="hidden" name="id" value="<?php echo $clasificacion->id; ?>">

                                    <input type="submit" class="w-100 btn btn-danger fs-4" value="Dar de baja">
                                </form>


                            <?php } else { ?>
                                <form method="POST" action="/dashboard/clasificaciones/update">
                                    <input type="hidden" name="id" value="<?php echo $clasificacion->id; ?>">

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

</div>












<?php $script = "
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/alertas.js' defer></script>
<script src='/build/js/bootstrap.bundle.min.js'></script>


";
if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>