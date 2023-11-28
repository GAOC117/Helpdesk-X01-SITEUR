<div class="position-fixed end-0 mt-3 me-3">
    <a class="btn <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?>  d-flex align-items-center fs-3" href="/dashboard/ver-tickets"><i class="bi bi-arrow-bar-left fs-1 me-3"></i> Ver tickets</a>
</div>



<div class="text-center mb-5 pt-5 pt-md-0">
    <h2><i class='bi bi-bezier2 me-3'></i><?php echo $titulo; ?></h2>
    <p class="asignar-tickets__texto fs-4 mb-5">Selecciona un empleado para asignar el ticket<span> #<?php echo $idTicket; ?></span></p>

</div>

<?php
require_once __DIR__ . '/../templates/alertas.php';
?>

<div class="container-xl">

    <div class="row align-items-center justify-content-center">


        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
            <img src="/build/img/escalar.png" class="img-fluid img-asignar" alt="...">
        </div>

        <div class="col-md-6 ps-5">
            <p class="col-12 fs-1 fw-bold text-center mb-5">Detalles del ticket</p>
            <div class="row fs-4">
                <div class="col-6 fw-bold">Nombre:</div>
                <div class="col-6 fw-normal"><?php echo $nombreRequiere; ?></div>
            </div>
            <div class="row mt-2 fs-4">
                <div class="col-6 fw-bold">Extensión</div>
                <div class="col-6 fw-normal"><?php echo $extensionRequiere; ?></div>
            </div>
            <div class="row mt-2 fs-4">
                <div class="col-6 fw-bold">Departamento</div>
                <div class="col-6 fw-normal"><?php echo $departamentoRequiere; ?></div>
            </div>
            <div class="row mt-2 fs-4">
                <div class="col-6 fw-bold">Clasificación</div>
                <div class="col-6 fw-normal"><?php echo $clasificacion; ?></div>
            </div>
            <div class="row mt-2 fs-4 ">
                <div class="col-6 fw-bold">Subclasificación</div>
                <div class="col-6 fw-normal"><?php echo $subclasificacion; ?></div>
            </div>
            <div class="row mt-2 fs-4 ">
                <div class="col-6 fw-bold">ASIGNADO ANTERIORMENTE A: </div>
                <div class="col-6 fw-normal"><?php echo $empleadoAnterior->nombre . ' ' . $empleadoAnterior->apellidoPaterno . ' ' . $empleadoAnterior->apellidoMaterno; ?></div>
            </div>
            <div class="col-12 fs-4 mt-5 fw-bold">Comentarios del ticket:</div>
            <div class="col-12 mb-5">
                <textarea class="form-control fs-4 mt-3" disabled style="height: 7rem;"><?php echo $comentarios; ?></textarea>
            </div>

            <div class="col-12">
                <p class="col-12 text-center fw-bold fs-3 my-5">Seleccione a quién se le escalará el ticket</p>

                <div class="col-12">

                    <form action="/dashboard/escalar-tickets?id=<?php echo $idTicket; ?>"  method="POST">

                        <select class="form-select select" name="idEmpAsignado" id="idEmpAsignado" autocomplete="on">
                            <option value="" disabled selected>--Seleccionar--</option>
                            <?php foreach ($empleadosInformatica as $empleadoInformatica) { ?>
                                <?php if ($empleadoInformatica->id === $empleadoAnterior->id) continue; ?>
                                <option <?php echo  $ticket->idEmpAsignado === $empleadoInformatica->id ? 'selected' : '' ?> value="<?php echo s($empleadoInformatica->id); ?>"><?php echo s($empleadoInformatica->nombre . ' '
                                                                                                                                                                                    . $empleadoInformatica->apellidoPaterno . ' ' . $empleadoInformatica->apellidoMaterno); ?>

                                </option>
                            <?php } ?>
                        </select> 

                        <div class="col-12 mb-5">
                            <textarea class="form-control fs-4 mt-3 w-100" style="height: 7rem;" name="comentariosSoporte" id="comentarios" maxlength="250" placeholder="Motivo por el cuál se escala el ticket"><?php echo $ticket->comentariosSoporte; ?></textarea>
                        </div>

                        <!-- <div class="formulario__comentarios">
                        <textarea class="formulario__comentarios-text-area" name="comentariosSoporte" id="comentarios" maxlength="250" placeholder="Comentarios"><?php echo $ticket->comentariosSoporte; ?></textarea>
                    </div> -->

                        <div class="d-flex justify-content-center">
                            <input type="submit" class="btn btn-warning fs-2 my-3" value="Escalar ticket">
                        </div>


                        <!-- <input type="submit" class="btn btn-warning" value="Escalar ticket"> -->
                    </form>
                </div>
            </div>

        </div>


    </div>
</div>





<?php $script = "
<script src='/build/js/app.js' defer></script>
<script src='/build/js/dashboard.js' defer></script>
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/bootstrap.bundle.min.js'></script>

";

if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>



