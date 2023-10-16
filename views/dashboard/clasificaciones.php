<main class="empleados">

    <div class="ver-empleados__header">
        <div class="heading">

            <h2 class="ver-empleados__texto"><?php echo $titulo; ?></h2>
        </div>

            <?php

            if ($_SESSION['mensaje']) {
            ?>
                <div class="ver-tickets--alerta alerta-empleados div-alerta">

                    <p class="alerta alerta__exito">
                        <?php
                        echo $_SESSION['mensaje'];
                        $_SESSION['mensaje'] = '';
                        ?>
                    </p>
                </div>

            <?php }
            ?>

    </div>










    <?php if (count($clasificaciones) > 0) : ?>

        <div class='contenedor'>
            <div class='filters'>
                <div class='filter-container'>
                    <label class="filter-label">Clasificación: </label>
                    <input type="text" autocomplete='off' class='filter' name='clasificación' placeholder='Buscar clasificación' data-col='clasificación' id="clasificación" />
                </div>

               

            </div>
        </div>

    <?php endif; ?>


    <div class='tabla__contenedor-empleado'>
        <table id="myTable" class="table table-hover tabla tabla-empleado" cellspacing="0" cellpadding="0">





            <?php if (count($clasificaciones) > 0) : ?>

                <thead class="tabla__header tabla__header-empleado">
                    <tr class="tabla__header__pegar tr-empleado">

                        <th class="tabla__th th-empleado">id</th>
                        <th class="tabla__th th-empleado">Clasificación</th>
                        <th class="tabla__th th-empleado">Acciones</th>
                    </tr>
                </thead>

                <!-- mostrar los resultados -->
                <tbody class="tabla__body-empleados">

                    <?php
                    foreach ($clasificaciones as $clasificacion) : ?>
                        

                        <tr class="tabla__row tabla-row-empleado">
                            <td class="tabla__td td-empleado"><?php echo $clasificacion->id; ?></td>
                          
                            <td class="tabla__td td-empleado"><?php echo $clasificacion->descripcion; ?></td>
                          
                         
                            <td class="tabla__td td-empleado">
                                <?php if ($clasificacion->estatus === '1') { ?>
                                    <a href="/dashboard/clasificaciones/editar?id=<?php echo $clasificacion->id; ?>" class="boton-azul boton-accion">Editar</a>
                                    <form method="POST" action="/dashboard/clasificacion/update">
                                        <input type="hidden" name="id" value="<?php echo $clasificacion->id; ?>">

                                        <input type="submit" class="boton-rojo boton-accion" value="Dar de baja">
                                    </form>


                                <?php } else { ?>
                                    <form method="POST" action="/dashboard/clasificacion/update">
                                        <input type="hidden" name="id" value="<?php echo $clasificacion->id; ?>">

                                        <input type="submit" class="boton-verde-limon boton-accion" value="Dar de alta">
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

";
if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>