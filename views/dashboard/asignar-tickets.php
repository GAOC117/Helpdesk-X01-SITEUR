<main class="asignar-tickets">

    <div class="asignar-tickets__header">
        <h2 class="asignar-tickets__heading"><?php echo $titulo; ?></h2>
        <p class="asignar-tickets__texto">Selecciona un empleado para asignar el <span>ticket #<?php echo $idTicket; ?></span></p>

        <?php
        require_once __DIR__ . '/../templates/alertas.php';
        ?>
    </div>

    <div class="tickets">

        <div class="tickets__informacion">

            <div class="ticekts__informacion__encabezado">
                <p class="texto">Detalles del ticket</p>
            </div>

            <div class="tickets__informacion-desglose">

                <p class="texto"><span>Nombre: </span><?php echo $nombreRequiere; ?></p>
                <p class="texto"><span>Extensión: </span><?php echo $extensionRequiere; ?></p>
                <p class="texto"><span>Departamento: </span><?php echo $departamentoRequiere; ?></p>
                <p class="texto"><span>Clasificación: </span><?php echo $clasificacion; ?></p>
                <p class="texto"><span>Subclasificación: </span><?php echo $subclasificacion; ?></p>
                <p class="texto"><span>Comentario: </span><?php echo $comentarios; ?></p>
            </div>
        </div>

        <div class="tickets__asignacion">
            <form action="/dashboard/asignar-tickets?id=<?php echo $idTicket; ?>" class="formulario" method="POST">
                <fieldset class="formulario__fieldset">
                    <legend>Seleccione el empleado al que se le asignara el ticket</legend>
                    <select class="formulario__campo select" name="idEmpAsignado" id="idEmpAsignado" autocomplete="on">
                        <option value="" disabled selected>--Seleccionar--</option>
                        <?php foreach ($empleadosInformatica as $empleadoInformatica) { ?>

                            <option value="<?php echo s($empleadoInformatica->id); ?>"><?php echo s($empleadoInformatica->nombre . ' ' . $empleadoInformatica->apellidoParterno . ' ' . $empleadoInformatica->apellidoMaterno); ?>

                            </option>
                        <?php } ?>
                    </select>
                </fieldset>
                <input type="submit" class="formulario__submit" value="Asignar ticket">
            </form>
        </div>


    </div>


</main>