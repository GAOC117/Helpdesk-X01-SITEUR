<aside class="dashboard__sidebar-contenedor">
    <div class="dashboard__sidebar">
        <div class="dashboard__sidebar--header">
            <div class="dashboard__sidebar--empleado">
                <div class="dashboard__sidebar--empleado-imagen">
                    <?php if ($expedienteLogueado === '4486') { ?>
                        <img src="/build/img/vader.png" alt="<?php echo 'Foto de' . $nombre; ?>" class="dashboard__empleado-imagen--foto">
                    <?php }  ?>
                    <?php if ($expedienteLogueado === '4485') { ?>
                        <img src="/build/img/koala.png" alt="<?php echo 'Foto de' . $nombre; ?>" class="dashboard__empleado-imagen--foto">
                    <?php }
                    if ($expedienteLogueado !== '4485' && $expedienteLogueado !== '4486') { ?>

                        <img src="http://skynet.siteur.gob.mx/fotos/<?php echo $expedienteLogueado; ?>.jpg" alt="<?php echo 'Foto de' . $nombre; ?>" class="dashboard__empleado-imagen--foto">
                    <?php } ?>
                </div>
                <div class="dashboard__sidebar--empleado-nombre">
                    <p class="dashboard__sidebar--empleado-nombre--texto"><?php echo $nombre; ?></p>
                </div>
            </div>
        </div><!-- .header -->

        <div class="dashboard__sidebar-nav">
            <div class="dashboard__sidebar-nav--menu">
                <ul>
                    <li>
                        <a class="dashboard__sidebar-nav--enlace" href="">
                            <i class="house house-icono fa-solid fa-house dashboard__icono"></i>
                            <span class="dashboard__sidebar-nav--texto">Inicio</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>



</aside>