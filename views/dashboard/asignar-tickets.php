<div class="position-fixed end-0 mt-3 me-3">
    <a class="btn <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?>  d-flex align-items-center fs-3" href="/dashboard/ver-tickets"><i class="bi bi-arrow-bar-left fs-1 me-3"></i> Ver tickets</a>
</div>



<div class="text-center mb-5 pt-5 pt-md-0">
    <h2><i class='bi bi-person-up me-3'></i><?php echo $titulo; ?></h2>
    <p class="asignar-tickets__texto fs-4 mb-5">Selecciona un empleado para asignar el ticket<span> #<?php echo $idTicket; ?></span></p>

</div>

<?php
require_once __DIR__ . '/../templates/alertas.php';
?>

<div class="container-xl    mx-auto">

    <div class="row align-items-center justify-content-center">
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
            <div class="col-12 fs-4 mt-5 fw-bold">Comentarios:</div>
            <div class="col-12 mb-5">
                <textarea class="form-control fs-4 mt-3" disabled style="height: 7rem;"><?php echo $comentarios; ?></textarea>
            </div>
        
            <div class="col-12">
    
    
                <p class="col-12 text-center fw-bold fs-3 my-5">Seleccione a quién se le asignará el ticket</p>
    
                <div class="col-12">
                    <form action="/dashboard/asignar-tickets?id=<?php echo $idTicket; ?>" method="POST">
    
    
                        <select class="form-select select" name="idEmpAsignado" id="idEmpAsignado" autocomplete="on">
                            <option value="" disabled selected>--Seleccionar--</option>
                            <?php foreach ($empleadosInformatica as $empleadoInformatica) { ?>
    
                                <option value="<?php echo s($empleadoInformatica->id); ?>"><?php echo s($empleadoInformatica->nombre . ' ' . $empleadoInformatica->apellidoPaterno . ' ' . $empleadoInformatica->apellidoMaterno); ?>
    
                                </option>
                            <?php } ?>
                        </select>
    
    
                        <div class="d-flex justify-content-center">
                            <input type="submit" class="btn btn-info fs-2 my-5" value="Asignar ticket">
                        </div>
                    </form>
                </div>
    
    
            </div>
        
        </div>

        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
            <img src="/build/img/asignar.png" class="img-fluid img-asignar" alt="...">
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