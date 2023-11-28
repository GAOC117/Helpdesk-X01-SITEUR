<div class="text-center mb-5 pt-5 pt-md-0">
    <h2><i class='bi bi-building me-3'></i><?php echo $titulo; ?></h2>
</div>



<div class="container-xl">
    <?php
    require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <form class="mt-5" method="POST">
        <div class='d-flex flex-column  mb-3 mb-md-0 width-control mx-auto'>
            <label for="descripcion" class="formulario__label">Nuevo departamento:</label>
            <input type="text" class="formulario__input" placeholder="Nuevo departamento" id="descripcion" name="descripcion" value="<?php echo $departamentos->descripcion ?>">
        </div>




        <div class="d-flex justify-content-center mt-5">
            <input type="submit" class="btn btn-dark fs-4" value="Agregar departamento">
        </div>
    </form>

</div>

<?php $script = "
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/alertas.js' defer></script>
<script src='/build/js/selects.js' defer></script>
<script src='/build/js/bootstrap.bundle.min.js'></script>


";
if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>