<div class="text-center mb-5 pt-5 pt-md-0">
    <h2><i class='fa-brands fa-empire me-3'></i><?php echo $titulo; ?></h2>
</div>

<div class="container-xl">

<?php
    require_once __DIR__ . '/../templates/alertas.php';
    ?>


<form class="mt-5 " method="POST">

<div class='d-flex flex-column  mb-3 mb-md-0 width-control mx-auto'>

    <label for="nombre" class="form-label fs-4">Clasificación:</label>
    <select class="form-select select fs-4" name="idClasificacionProblema" id="idClasificacionProblema" autocomplete="on">
        <option disabled selected>--Seleccionar--</option>

        <?php foreach ($clasificaciones as $clasificacion) { ?>
            <option <?php echo  $subclasificacion->idClasificacion === $clasificacion->id ? ' selected' : '' ?> value="<?php echo s($clasificacion->id); ?>"><?php echo s($clasificacion->descripcion); ?>
            </option>
        <?php } ?>
    </select>

    <div class="mt-5">
        <label for="nombre" class="form-label fs-4">Subclasificación:</label>
        <input type="text" class="form-control fs-4" placeholder="Subclasificación" id="descripcion" name="descripcion" value="<?php echo $subclasificacion->descripcion ?>">
    </div>




    <div class="d-flex justify-content-center mt-5">
    <input type="submit" class="btn btn-dark fs-4" value="Actualizar datos">
    </div>
</form>




</div>



   

</main>


<?php $script = "
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/alertas.js' defer></script>
<script src='/build/js/selects.js' defer></script>
<script src='/build/js/bootstrap.bundle.min.js'></script>

";
if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>