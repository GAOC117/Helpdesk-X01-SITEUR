<?php
foreach($alertas as $key => $alerta){
    foreach($alerta as $mensaje){
    ?>
    <div class="mx-auto mx-5 w-75 alerta alerta__<?php echo $key;?>"><?php echo $mensaje;?></div>
    <?php
    }
    }
?>