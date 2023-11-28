
<div class="text-center mb-5 pt-5 pt-md-0">
    <h2><i class='fa-brands fa-empire me-3'></i><?php echo $titulo; ?></h2>
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


<?php if (count($subclasificaciones) > 0) : ?>

<div class='container-xl'>
<div class='justify-content-center row mb-5 flex-column flex-md-row'>
<div class=' col-md-4 d-flex justify-content-between justify-content-md-center mb-3 mb-md-0'>
            <label class="filter-label">Clasificación: </label>
            <input type="text" autocomplete='off' class='filter' name='Clasificación' placeholder='Buscar clasificación' data-col='clasificación' id="clasificación" />
        </div>

        <div class=' col-md-4 d-flex  justify-content-between justify-content-md-center'>
            <label class="filter-label">Subclasificación: </label>
            <input type="text" autocomplete='off' class='filter' name='Subclasificación' placeholder='Buscar Subclasificación' data-col='subclasificación' id="subclasificación" />
        </div>

       

    </div>
</div>

<?php endif; ?>   

<a href="/dashboard/subclasificaciones/agregar" class="btn btn-success fs-4 mb-5 ms-3">Nueva subclasificación</a>

<div class='table-responsive mx-3'>
    <table id="myTable" class="table table-hover table-striped table-light align-middle table-bordered" cellspacing="0" cellpadding="0">






            <?php if (count($subclasificaciones) > 0) : ?>

                <thead class="fs-5">
                    <tr class="bg-dark">

                        <th class="table-dark text-white text-center">id</th>
                        <th class="table-dark text-white text-center">Clasificación</th>
                        <th class="table-dark text-white text-center">Subclasificación</th>
                        <th class="table-dark text-white text-center">Acciones</th>
                    </tr>
                </thead>

                <!-- mostrar los resultados -->
                <tbody class="">

                    <?php
                    foreach ($subclasificaciones as $subclasificacion) : ?>
                        

                        <tr class="fs-5">
                            <td class="text-center fs-5"><?php echo $subclasificacion->id; ?></td>
                          
                            <td class="text-center fs-5"><?php echo $subclasificacion->clasificacion; ?></td>
                            <td class="text-center fs-5"><?php echo $subclasificacion->subclasificacion; ?></td>
                          
                         
                            <td class="text-center fs-5">
                                <?php if ($subclasificacion->estatus === '1') { ?>
                                    <a href="/dashboard/subclasificaciones/editar?id=<?php echo $subclasificacion->id; ?>" class="w-100 btn btn-primary mb-1 fs-4">Editar</a>
                                    <form method="POST" action="/dashboard/subclasificaciones/update">
                                        <input type="hidden" name="id" value="<?php echo $subclasificacion->id; ?>">

                                        <input type="submit" class="w-100 btn btn-danger fs-4" value="Dar de baja">
                                    </form>


                                <?php } else { ?>
                                    <form method="POST" action="/dashboard/subclasificaciones/update">
                                        <input type="hidden" name="id" value="<?php echo $subclasificacion->id; ?>">

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