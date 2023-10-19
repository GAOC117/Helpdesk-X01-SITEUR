<main class="editar-clasificaciones">


    <div class="editar-empleado__header">
        <h2 class="editar-empleado__texto"><?php echo $titulo; ?></h2>

        <?php
        require_once __DIR__ . '/../templates/alertas.php';
        ?>


    </div>


    <form class="editar-empleado__form formulario " method="POST">

        <div class="formulario__datos-empleado formulario__clasificacion">

            <select class="formulario__campo select" name="idClasificacionProblema" id="idClasificacionProblema" autocomplete="on">
                <option disabled selected>--Seleccionar--</option>

                <?php foreach ($clasificaciones as $clasificacion) { ?>
                    <option <?php echo  $subclasificacion->idClasificacion === $clasificacion->id ? ' selected' : '' ?> value="<?php echo s($clasificacion->id); ?>"><?php echo s($clasificacion->descripcion); ?>
                    </option>
                <?php } ?>
            </select>

            <div class="formulario__campo ">
                <label for="nombre" class="formulario__label">Sublasificación:</label>
                <input type="text" class="formulario__input" placeholder="clasificación" id="descripcion" name="descripcion" value="<?php echo $subclasificacion->descripcion ?>">
            </div>





            <input type="submit" class="formulario__submit editar-empleado__btn" value="Actualizar datos">
    </form>

</main>


<?php $script = "
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/alertas.js' defer></script>
<script src='/build/js/selects.js' defer></script>

";
if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>