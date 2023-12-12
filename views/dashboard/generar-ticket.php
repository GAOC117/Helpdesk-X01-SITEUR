<main class="d-flex flex-column justify-content-center">

    <div class="text-center mb-1">
        <h2><i class="bi bi-ticket-perforated-fill me-3 icono-boleto"></i><?php echo $titulo; ?></h2>
        <p class="generar-ticket__texto">Registra un nuevo incidente para mesa de ayuda</p>
    </div>

    <!-- <div class="generar-ticket__alertas">

        <?php
        require_once __DIR__ . '/../templates/alertas.php';
        ?>

    </div> -->

    <div class="container-xl">
        <div class="row">
            <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">

                <!-- <div class="img-nuevo-ticket-div d-none d-md-flex"> -->

                <img src="/build/img/helpdesk.png" class="img-fluid img-nuevo-ticket" alt="...">
                <!-- </div> -->

            </div>
            <div class="col-md-6">
                <form action="/dashboard/generar-ticket" class="d-flex flex-column" method="POST">
                        <fieldset>
                            <legend class="mt-3 fw-bold <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'text-dark' : 'text-siteur'; ?>">Datos de quién reporta</legend>


                            <div class="row">

                                <div class="col-md-6 mt-3">

                                    <label for="idEmpReporta" class="form-label fs-4">Expediente</label>

                                    <input type="number" class="form-control fs-4" placeholder="Expediente reporta" id="idEmpReporta" name="idEmpReporta" value="<?php echo s($expedienteLogueado); ?>" <?php if ($idRol !== '1' && $idRol !== '2') echo 'disabled'; ?>>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="extensionReporta" class="form-label fs-4">Extensión</label>
                                    <input type="number" class="form-control fs-4" placeholder="Extensión reporta" id="extensionReporta" name="extensionReporta" disabled>
                                </div>

                                <div class="col-12 mt-3">
                                    <label for="nombreReporta" class="form-label fs-4">Nombre empleado</label>
                                    <input type="text" class="form-control fs-4" placeholder="Nombre quien reporta" id="nombreReporta" disabled>
                                </div>
                            </div>
                        </fieldset>


                        <fieldset>
                            <legend class="mt-3 fw-bold <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'text-dark' : 'text-siteur'; ?>">Datos de quién requiere</legend>
                            <div class="row">

                                <div class="col-md-6 mt-3">

                                    <label for="idEmpRequiere" class="form-label fs-4">Expediente</label>
                                    <input type="number" class="form-control fs-4" placeholder="Expediente requiere" id="idEmpRequiere" name="idEmpRequiere" value="<?php echo s($expedienteLogueado); ?>">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="extensionRequiere" class="form-label fs-4">Extension</label>
                                    <input type="number" class="form-control fs-4" placeholder="Extensión requiere" id="extensionRequiere" name="extensionRequiere" disabled>
                                </div>

                                <div class="col-12 mt-3">
                                    <label for="nombreRequiere" class="form-label fs-4">Nombre empleado</label>
                                    <input type="text" class="form-control fs-4" placeholder="Nombre quien requiere" id="nombreRequiere" disabled>

                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="fw-bold mt-3 <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'text-dark' : 'text-siteur'; ?>">Seleccionar categoria del ticket</legend>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="" id="formulario-fieldset--clasificacion">
                                        <label for="idClasificacionProblema" class="fs-4 mb-3">Clasificación:</label>
                                        <select class="form-select select fs-4" name="idClasificacionProblema" id="idClasificacionProblema" autocomplete="on">
                                            <option disabled selected>--Seleccionar--</option>

                                            <?php foreach ($clasificaciones as $clasificacion) { ?>
                                                <option <?php echo  $ticket->idClasificacionProblema === $clasificacion->id ? ' selected' : '' ?> value="<?php echo s($clasificacion->id); ?>"><?php echo s($clasificacion->descripcion); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mt-3" id="formulario-fieldset--subclasificacion">
                                        <label for="idSubclasificacionProblema" class="fs-4">Subclasificación:</label>
                                        <select class="form-select select fs-4" name="idSubclasificacionProblema" id="idSubclasificacionProblema" autocomplete="on">
                                            <option disabled selected>--Seleccionar--</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row">
                            <div class="col-12 mt-5 mx-3 pe-5">
                            <textarea class="form-control fs-4 ms-1" name="comentariosReporte" id="comentariosReporte" maxlength="250" placeholder="Comentarios" style="height: 7rem;"><?php echo $ticket->comentariosReporte; ?></textarea>
                            </div>
                        </div>
                    
                </form>

                <div class="row mt-5">
                    <div class="col-12 d-flex justify-content-center mb-3">

                        <button type="button" class="btn <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?> fs-3" id="botonRegistrar">
                            Generar nuevo ticket
                        </button>
                    </div>
                </div>

            </div><!-- generar-ticekt__datos -->

            <div class="formulario__submit-contenedor">

                
            </div>

        </div>
    </div>
    </div>
    </div>




</main>

<?php $script = "
<script src='/build/js/app.js' defer></script>
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/dashboard.js' defer></script>
<script src='/build/js/ticket-nuevo.js' defer></script>
<script src='/build/js/bootstrap.bundle.min.js'></script>

";
if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>