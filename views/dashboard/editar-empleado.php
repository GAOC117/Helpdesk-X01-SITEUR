<main class="editar-empleado">


    <div class="ver-tickets__header">
        <h2 class="ver-tickets__texto"><?php echo $titulo; ?></h2>
    </div>




</main>

<?php $script = "
<script src='/build/js/sidebar.js' defer></script>


";
if($idRol!=='4')
$script.="<script src='/build/js/notificaciones.js' defer></script>"

?>