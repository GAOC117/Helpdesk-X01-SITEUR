<main class="editar-clasificaciones">


<div class="editar-empleado__header">
        <h2 class="editar-empleado__texto"><?php echo $titulo; ?></h2>

        <?php
        require_once __DIR__ . '/../templates/alertas.php';
        ?>
       

    </div>


<form class="editar-empleado__form formulario " method="POST">

<div class="formulario__datos-empleado formulario__clasificacion">

    <div class="formulario__campo ">
        <label for="nombre" class="formulario__label">Departamento:</label>
        <input type="text" class="formulario__input" placeholder="Departamento" id="descripcion" name="descripcion" value="<?php echo $departamentos->descripcion ?>">
    </div>

 



<input type="submit" class="formulario__submit editar-empleado__btn" value="Actualizar datos">
</form>

</main>

<?php $script = "
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/alertas.js' defer></script>

";
if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>