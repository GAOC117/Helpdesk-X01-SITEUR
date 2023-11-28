<div class="text-center mb-5 pt-5 pt-md-0">
    <h2><i class='bi bi-building me-3'></i><?php echo $titulo; ?></h2>
</div>


<div class="container-xl">
    <?php
    require_once __DIR__ . '/../templates/alertas.php';
    ?>


    <form class="mt-5" method="POST">

    <div class='d-flex flex-column  mb-3 mb-md-0 width-control mx-auto'>
                <label for="nombre" class="form-label fs-4">Departamento:</label>
                <input type="text" class="form-control fs-4" placeholder="Departamento" id="descripcion" name="descripcion" value="<?php echo $departamentos->descripcion ?>">
            </div>




            <div class="d-flex justify-content-center mt-5">
            <input type="submit" class="btn btn-dark fs-4" value="Actualizar datos">
            </div>
    </form>



    <?php $script = "
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/alertas.js' defer></script>
<script src='/build/js/bootstrap.bundle.min.js'></script>


";
    if ($idRol !== '4')
        $script .= "<script src='/build/js/notificaciones.js' defer></script>"

    ?>