<main class="empleados">

    <div class="ver-empleados__header">
        <div class="heading">

            <h2 class="ver-empleados__texto"><?php echo $titulo; ?></h2>
        </div>

            <?php

            if ($_SESSION['mensaje']) {
            ?>
                <div class="ver-tickets--alerta alerta-empleados">

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










    <?php if (count($empleados) > 0) : ?>

        <div class='contenedor'>
            <div class='filters'>
                <div class='filter-container'>
                    <label class="filter-label">Expediente: </label>
                    <input type="number" autocomplete='off' class='filter' name='expediente' placeholder='Buscar expediente' data-col='expediente' id="expediente" />
                </div>

                <div class='filter-container'>
                    <label class="filter-label">Nombre del empleado: </label>
                    <input autocomplete='off' class='filter' name='nombre' placeholder='Buscar nombre' data-col='nombre' id="nombre" />
                </div>

            </div>
        </div>

    <?php endif; ?>


    <div class='tabla__contenedor-empleado'>
        <table id="myTable" class="table table-hover tabla tabla-empleado" cellspacing="0" cellpadding="0">





            <?php if (count($empleados) > 0) : ?>

                <thead class="tabla__header tabla__header-empleado">
                    <tr class="tabla__header__pegar tr-empleado">

                        <th class="tabla__th th-empleado">Expediente</th>
                        <th class="tabla__th th-empleado">Nombre</th>
                        <th class="tabla__th th-empleado">Correo</th>
                        <th class="tabla__th th-empleado">Extensión</th>
                        <th class="tabla__th th-empleado">Departamento</th>
                        <th class="tabla__th th-empleado">Acciones</th>
                    </tr>
                </thead>

                <!-- mostrar los resultados -->
                <tbody class="tabla__body-empleados">

                    <?php
                    foreach ($empleados as $empleado) : ?>
                        <?php if ($empleado->id === '0') continue; ?>

                        <tr class="tabla__row tabla-row-empleado">
                            <td class="tabla__td td-empleado"><?php echo $empleado->id; ?></td>
                            <td class="tabla__td td-empleado"><?php echo $empleado->nombre . ' ' . $empleado->apellidoPaterno . ' ' . $empleado->apellidoMaterno; ?></td>
                            <td class="tabla__td td-empleado"><?php echo $empleado->email; ?></td>
                            <td class="tabla__td td-empleado"><?php echo $empleado->extension; ?></td>
                            <td class="tabla__td td-empleado"><?php echo $empleado->departamento; ?></td>
                            <td class="tabla__td td-empleado">
                                <?php if ($empleado->estatus === '1') { ?>
                                    <a href="/dashboard/empleados/editar?id=<?php echo $empleado->id; ?>" class="boton-azul boton-accion">Editar</a>
                                    <form method="POST" action="/dashboard/empleados/update">
                                        <input type="hidden" name="id" value="<?php echo $empleado->id; ?>">

                                        <input type="submit" class="boton-rojo boton-accion" value="Dar de baja">
                                    </form>


                                <?php } else { ?>
                                    <form method="POST" action="/dashboard/empleados/update">
                                        <input type="hidden" name="id" value="<?php echo $empleado->id; ?>">

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
<script src='/build/js/empleados.js' defer></script>

";
if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>