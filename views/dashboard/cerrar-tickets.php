<div class="position-fixed end-0 mt-3 me-3">
    <a class="btn <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?> d-flex align-items-center fs-3" href="/dashboard/ver-tickets"><i class="bi bi-arrow-bar-left fs-1 me-3"></i> Ver tickets</a>
</div>



<div class="text-center mb-5 pt-5 pt-md-0">
    <h2><i class='bi bi-check2-circle me-3'></i><?php echo $titulo; ?></h2>
    <p class="asignar-tickets__texto fs-4 mb-5">Indique un comentario para cerrar el ticket<span> #<?php echo $idTicket; ?></span></p>
</div>

<?php
require_once __DIR__ . '/../templates/alertas.php';
?>

<div class="container-xl">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-6">

            <form action="/dashboard/cerrar-tickets?id=<?php echo $idTicket; ?>" method="POST">

                <div class="col-12 fs-4 mt-5 fw-bold">Comentarios del ticket:</div>
                <div class="col-12 mb-5">
                    <textarea class="form-control fs-4 mt-3" style="height: 7rem;" name="comentarios" id="comentarios" maxlength="250" placeholder="Motivo por el cual cierra el ticket"><?php echo $comentarios; ?></textarea>
                </div>


                <!-- <div class="w-50"> -->
                <!-- <div class="col-12"> -->
                
                    <select class="form-select fs-4 w-50 mb-5" name="tipoServicio" id="tipoServicio" autocomplete="on">
                        <option disabled selected>--Seleccionar--</option>
                        <option value="En sitio" <?php if ($tipoServicio === 'En sitio') echo 'selected' ?>>En sitio</option>
                        <option value="Remoto" <?php if ($tipoServicio === 'Remoto') echo 'selected' ?>>Remoto</option>
                    </select>

                  
                <!-- </div> -->

                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-success fs-2 my-3" value="Cerrar ticket">
                </div>


                



            </form>

            
        </div>

        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
            <img src="/build/img/cerrar.png" class="img-fluid img-cerrar" alt="...">
        </div>

    </div>
</div>




<?php $script = "

<script src='/build/js/dashboard.js' defer></script>
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/bootstrap.bundle.min.js'></script>


";


if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>