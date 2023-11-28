

<div class="position-fixed end-0 mt-3 me-3">
    <a class="btn <?php session_start(); $expedienteLogueado = $_SESSION['id'];  echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?> d-flex align-items-center fs-3" href="/dashboard/ver-tickets"><i class="bi bi-arrow-bar-left fs-1 me-3"></i> Ver tickets</a>
</div>



<div class="text-center mb-5 pt-5 pt-md-0">
    <h2><i class='bi bi-calendar2-week me-3'></i><?php echo $titulo; ?></h2>
    
</div>


    <!-- <div class="tabla__contenedor-container-historico"> -->
        <div class='table-responsive mx-3'>



            <table  class="table table-hover table-striped table-light align-middle table-bordered">
                <thead class="fs-5">
                    <tr class="bg-primary">

                        <th class=" <?php session_start(); $expedienteLogueado = $_SESSION['id']; echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'table-dark' : 'table-primary'; ?> text-white text-center" scope="col">ID del evento</th>
                        <th class=" <?php session_start(); $expedienteLogueado = $_SESSION['id']; echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'table-dark' : 'table-primary'; ?> text-white text-center" scope="col">Ticket #</th>
                        <th class=" <?php session_start(); $expedienteLogueado = $_SESSION['id']; echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'table-dark' : 'table-primary'; ?> text-white text-center" scope="col">Estado</th>
                        <th class=" <?php session_start(); $expedienteLogueado = $_SESSION['id']; echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'table-dark' : 'table-primary'; ?> text-white text-center" scope="col">Atiende</th>
                        <th class=" <?php session_start(); $expedienteLogueado = $_SESSION['id']; echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'table-dark' : 'table-primary'; ?> text-white text-center" scope="col">Fecha del evento</th>
                        <th class=" <?php session_start(); $expedienteLogueado = $_SESSION['id']; echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'table-dark' : 'table-primary'; ?> text-white text-center" scope="col">Comentarios</th>
                    </tr>
                </thead>
                </thead>
                <tbody class="tabla__body">
                    <?php
                    foreach ($historialTicket as $historico) : ?>

                        <tr class="tabla__row">
                            <td class="text-center fs-5"><?php echo $historico->id; ?></td>
                            <td class="text-center fs-5"><?php echo $historico->idTicket; ?></td>
                            <td class="text-center fs-5"><?php echo $historico->idEstado; ?></td>
                            <td class="text-center fs-5"><?php echo $historico->idEmpAsignado; ?></td>
                            <td class="text-center fs-5"><?php echo date('d', strtotime($historico->fechaRegistro)) . '/' . $meses[date('m', strtotime($historico->fechaRegistro)) - 1] . '/' . date('Y', strtotime($historico->fechaRegistro)); ?></td>
                            <td class="text-center fs-5"><?php echo $historico->comentarios; ?></td>


                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <!-- </div> -->

</main>


<?php $script = "
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/ver-tickets.js' defer></script>
<script src='/build/js/bootstrap.bundle.min.js'></script>


";
if($idRol!=='4')
$script.="<script src='/build/js/notificaciones.js' defer></script>"

?>