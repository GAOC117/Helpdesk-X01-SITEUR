<div class="container-xl d-flex align-items-center column-gap-3 column-gap-md-5 justify-content-center mt-5">
    <?php if ($expedienteLogueado === '4486') { ?>
        <img src="/build/img/vader.png" alt="<?php echo 'Foto de' . $nombre; ?>" class="empleado-foto">
        <!-- <img src="/build/img/space.png" alt="<?php echo 'Foto de' . $nombre; ?>" class="empleado__imagen--foto"> -->
    <?php } ?>
    <?php if ($expedienteLogueado === '4485') { ?>
        <img src="/build/img/koala.png" alt="<?php echo 'Foto de' . $nombre; ?>" class="empleado-foto">
    <?php }
    if ($expedienteLogueado !== '4485' && $expedienteLogueado !== '4486') { ?>

        <img src="http://skynet.siteur.gob.mx/fotos/<?php echo $expedienteLogueado; ?>.jpg" alt="empleado" class="empleado-foto-1">
    <?php } ?>

    <p class="text-center text-dark fs-md-1"><?php echo $nombre; ?></p>

</div>

<div class="container-xl mt-5">

    <!-- <div class="row align-items-center"> -->
    <div class="row">
        <div class="col-md-6">

            <div class="col-12 mb-3">
                <p class="text-center">Tickets del mes en curso</p>
            </div>
            <div class="row row-gap-3">
                <div class="col-md-6 text-center">

                    <div class="bg-danger text-white border-5">
                        <div class="card-header">Tickets abiertos</div>
                        <div class="card-body p-0">
                            <p class="card-text card-info" id="tickets--abiertos"></p>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 text-center">

                    <div class="bg-secondary text-white border-5">
                        <div class="card-header">Tickets pausados</div>
                        <div class="card-body p-0">
                            <p class="card-text card-info" id="tickets--pausados"></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">

                    <div class="bg-warning text-white border-5">
                        <div class="card-header">Tickets escalados</div>
                        <div class="card-body p-0">
                            <p class="card-text card-info" id="tickets--escalados"></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">

                    <div class="bg-success text-white border-5">
                        <div class="card-header">Tickets cerrados</div>
                        <div class="card-body p-0">
                            <p class="card-text card-info" id="tickets--cerrados"></p>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <p class="text-center">Total de tickets: <span id="tickets--totales" class="fw-bold"></span></p>
                </div>
                <div class="col-12 mb-5">
                    <canvas class="mx-auto mt-1" id="myChart"></canvas>
                </div>


            </div>




        </div>
        <div class="col-md-6 container-xl">
            <div class="col-12 historico">
                <p class="text-center">Historico de los últimos tres meses</p>
            </div>
            <canvas class="mx-auto" id="myChart1"></canvas>
        </div>
    </div>
</div>



<!-- <script src='/build/js/sidebar.js' defer></script> -->

<?php $script = "
<script src='/build/js/dashboard.js' defer></script>
<script src='/build/js/inicio.js' defer></script>
<script src='/build/js/bootstrap.bundle.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>


";
if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>