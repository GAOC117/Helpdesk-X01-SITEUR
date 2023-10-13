<main class="editar-empleado">


    <div class="editar-empleado__header">
        <h2 class="editar-empleado__texto"><?php echo $titulo; ?></h2>

        <?php
        require_once __DIR__ . '/../templates/alertas.php';
        ?>
    </div>

    <div class="editar-empleado__datos">
        <form action="/dashboard/empleados/editar" class="editar-empleado__form">





        <input type="submit" class="formulario__submit editar-empleado__btn" value="Actualizar datos">
        </form>
    </div>






</main>

<?php $script = "
<script src='/build/js/sidebar.js' defer></script>


";
if($idRol!=='4')
$script.="<script src='/build/js/notificaciones.js' defer></script>"

?>