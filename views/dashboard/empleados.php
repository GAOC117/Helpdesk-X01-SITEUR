<main class="empleados">

    <div class="ver-empleados__header">
        <h2 class="ver-empleados__texto"><?php echo $titulo; ?></h2>
    </div>


    <?php
    if ($_SESSION['mensaje']) {
    ?>
        <div class="ver-tickets--alerta">

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

    <table id="myTable" class="table table-hover tabla" cellspacing="0" cellpadding="0">





        <?php if (count($empleados) > 0) : ?>

            <thead class="tabla__header">
                    <tr class="tabla__header__pegar">

                    <th class="tabla__th">Expediente</th>
                    <th class="tabla__th">Nombre</th>
                    <th class="tabla__th">Correo</th>
                    <th class="tabla__th">Extensión</th>
                    <th class="tabla__th">Departamento</th>
                    <th class="tabla__th">Acciones</th>
                </tr>
            </thead>

            <!-- mostrar los resultados -->
            <tbody class="tabla__body-empleados">

                <?php
                foreach ($empleados as $empleado) : ?>
<?php if($empleado->id === '0') continue; ?>
                    
                    <tr class="tabla__row">
                        <td class="tabla__td"><?php echo $empleado->id; ?></td>
                        <td class="tabla__td"><?php echo $empleado->nombre . ' ' . $empleado->apellidoPaterno . ' ' . $empleado->apellidoMaterno; ?></td>
                        <td class="tabla__td"><?php echo $empleado->email; ?></td>
                        <td class="tabla__td"><?php echo $empleado->extension; ?></td>
                        <td class="tabla__td"><?php echo $empleado->departamento; ?></td>
                        <td class="tabla__td">
                            <?php if ($empleado->estatus === '1') { ?>
                                <a href="/empleados/editar?id=<?php echo $empleado->id; ?>" class="boton-azul">Editar</a>
                                <form method="POST" action="/empleados/update">
                                    <input type="hidden" name="id" value="<?php echo $empleado->id; ?>">
                                    <input type="hidden" name="tipo" value="propiedad">
                                    <input type="submit" class="boton-rojo" value="Dar de baja">
                                </form>


                            <?php } else { ?>
                                <form method="POST" action="/empleados/update">
                                    <input type="hidden" name="id" value="<?php echo $empleado->id; ?>">
                                    <input type="hidden" name="tipo" value="propiedad">
                                    <input type="submit" class="boton-verde-limon" value="Dar de alta">
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
    </table>


</main>

<?php $script = "
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/ver-tickets.js' defer></script>

";
if($idRol!=='4')
$script.="<script src='/build/js/notificaciones.js' defer></script>"

?>