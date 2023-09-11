<main class="generar-ticket">


    <!-- 
comentariosReporte
idEstado (abierto) *
idEmpReporta *
idEmpRequiere *
extensionReporta *
extensionRequiere *
idClasificacionProblema *
idsubclasificacionProblema *
ticketNuevo = 1 *
 -->
    <div class="generar-ticket__header">
        <h2 class="generar-ticket__heading"><?php echo $titulo; ?></h2>
        <p class="generar-ticket__texto">Rigistra un nuevo incidente para mesa de ayuda</p>


    </div>
    <div class="generar-ticket__alertas">

        <?php
        require_once __DIR__ . '/../templates/alertas.php';
        ?>

    </div>
    <div class="generar-ticket__datos">

        <form action="/dashboard/generar-ticket" class="generar-ticket__formulario" method="POST">

            <div class="generar-ticket__grid">
                <div class="formulario__campo formulario__campo--grid">
                    <fieldset class="formulario__fieldset">
                        <legend>Datos de quién reporta</legend>

                        <div class="formulario__campo--ids">


                            <div class="empleado--ids">


                                <label for="idEmpReporta" class="formulario__label">Expediente</label>
                                <?php //if ($expedienteReporta === '') { ?>
                                    <input type="number" class="formulario__input formulario__input--expediente" placeholder="Expediente reporta" id="idEmpReporta" name="idEmpReporta" value="<?php echo s($expedienteLogueado); ?>">
                                <?php //} ?>
                                <?php //if ($expedienteReporta !== '') { ?>
                                    <!-- <input type="number" class="formulario__input formulario__input--expediente" placeholder="Expediente reporta" id="idEmpReporta" name="idEmpReporta" value="<?php //echo s($expedienteReporta); ?>"> -->
                                <?php// } ?>


                            </div>

                            <div class="empleado--ids">
                                <label for="extensionReporta" class="formulario__label">Extensión</label>
                                <input type="number" class="formulario__input formulario__input--extension" placeholder="Extensión reporta" id="extensionReporta" name="extensionReporta" disabled>

                            </div>


                        </div>
                        <label for="" class="formulario__campo">Nombre empleado</label>
                        <input type="text" class="formulario__input formulario__input--nombre-reporta" placeholder="Nombre quien reporta" id="nombreReporta" disabled>

                    </fieldset>
                </div>
                <div class="formulario__campo formulario__campo--grid">
                    <fieldset class="formulario__fieldset">

                        <legend>Datos de quién requiere</legend>

                        <div class="formulario__campo--ids">


                            <div class="empleado--ids">
                                <?php //if ($expedienteRequiere === '') { ?>
                                    <label for="idEmpRequiere" class="formulario__label">Expediente</label>
                                    <input type="number" class="formulario__input formulario__input--expediente" placeholder="Expediente requiere" id="idEmpRequiere" name="idEmpRequiere" value="<?php echo s($expedienteLogueado); ?>">
                                <?php// } ?>

                                <?php //if ($expedienteRequiere !== '') { ?>
                                    <!-- <label for="idEmpRequiere" class="formulario__label">Expediente</label>
                                    <input type="number" class="formulario__input formulario__input--expediente" placeholder="Expediente requiere" id="idEmpRequiere" name="idEmpRequiere" value="<?php //echo s($expedienteRequiere); ?>"> -->
                                <?php //} ?>

                            </div>
                            <div class="empleado--ids">
                                <label for="extensionRequiere" class="formulario__label">Extension</label>
                                <input type="number" class="formulario__input formulario__input--extension" placeholder="Extensión requiere" id="extensionRequiere" name="extensionRequiere" disabled>
                            </div>
                        </div>
                        <label for="" class="formulario__campo">Nombre empleado</label>
                        <input type="text" class="formulario__input formulario__input--nombre-requiere" placeholder="Nombre quien requiere" id="nombreRequiere" disabled>

                    </fieldset>

                </div>

                <fieldset class="formulario__fieldset formulario__fieldset--tickets">
                    <legend>Seleccionar categoria del ticket</legend>

                    <div class="formulario__fieldset--selects">


                        <div class="formulario__fieldset--categoria" id="formulario-fieldset--clasificacion">
                            <label for="idClasificacionProblema">Clasificación:</label>
                            <select class="formulario__campo select" name="idClasificacionProblema" id="idClasificacionProblema" autocomplete="on">
                                <option  disabled selected>--Seleccionar--</option>

                                <?php foreach ($clasificaciones as $clasificacion) { ?>
                                    <option <?php echo  $ticket->idClasificacionProblema === $clasificacion->id ? ' selected' : '' ?> 
                                    value="<?php echo s($clasificacion->id); ?>"><?php echo s($clasificacion->descripcion); ?>
                                    </option>
                                    <?php } ?>
                            </select>
                        </div>

                        <div class="formulario__fieldset--categoria" id="formulario-fieldset--subclasificacion">
                            <label for="idsubClasificacionProblema">Subclasificación:</label>
                            <select class="formulario__campo select" name="idSubclasificacionProblema" id="idSubclasificacionProblema" autocomplete="on">
                                <option disabled selected>--Seleccionar--</option>

                            </select>
                        </div>

                    </div>



                </fieldset>

                <div class="formulario__comentarios">
                    <textarea class="formulario__comentarios-text-area" name="comentariosReporte" id="comentariosReporte" maxlength="250" placeholder="Comentarios"><?php echo $ticket->comentariosReporte; ?></textarea>
                </div>

            </div><!-- grid -->



            <div class="formulario__submit-contenedor">


                <input type="submit" class="formulario__submit formulario__submit--nuevo-ticket" value="Generar ticket nuevo" id="botonRegistrar">

            </div>

        </form>


    </div>




</main>