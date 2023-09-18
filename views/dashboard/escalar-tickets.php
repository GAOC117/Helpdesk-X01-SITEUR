<main class="asignar-tickets">

    <div class="asignar-tickets__header">
        <h2 class="asignar-tickets__heading"><?php echo $titulo; ?></h2>
        <p class="asignar-tickets__texto">Selecciona un empleado para escalar el <span>ticket #<?php echo $idTicket; ?></span></p>

        <?php
        require_once __DIR__ . '/../templates/alertas.php';
        ?>
    </div>

    <div class="tickets">

        <div class="tickets__informacion">

            <div class="tickets__informacion__encabezado">
                <p class="texto">Detalles del ticket</p>
            </div>

            <div class="tickets__informacion-desglose">
                
                <p class="tickets__informacion--texto"><span>Nombre:  </span><?php echo $nombreRequiere; ?></p>
                <p class="tickets__informacion--texto"><span>Extensión:  </span><?php echo $extensionRequiere; ?></p>
                <p class="tickets__informacion--texto"><span>Departamento:  </span><?php echo $departamentoRequiere; ?></p>
                <p class="tickets__informacion--texto"><span>Clasificación:  </span><?php echo $clasificacion; ?></p>
                <p class="tickets__informacion--texto"><span>Subclasificación:  </span><?php echo $subclasificacion; ?></p>
                <p class="tickets__informacion--texto"><span>Comentario:  </span><?php echo $comentarios; ?></p>
                <p class="tickets__informacion--texto"><span>ASIGNADO ANTERIORMENTE A:  </span><?php echo $empleadoAnterior->nombre. ' '.$empleadoAnterior->apellidoPaterno.' '.$empleadoAnterior->apellidoMaterno; ?></p>
            </div>
        </div>

        <div class="tickets__asignacion">
            <form action="/dashboard/escalar-tickets?id=<?php echo $idTicket; ?>" class="formulario" method="POST">
                <fieldset class="formulario__fieldset">
                    <legend>Seleccione el empleado al que se le escalara el ticket</legend>
                    <select class="formulario__campo select" name="idEmpAsignado" id="idEmpAsignado" autocomplete="on">
                        <option value="" disabled selected>--Seleccionar--</option>
                        <?php foreach ($empleadosInformatica as $empleadoInformatica) { ?>
                            <?php if($empleadoInformatica->id === $empleadoAnterior->id) continue; ?>
                            <option <?php echo  $ticket->idEmpAsignado === $empleadoInformatica->id ? 'selected': '' ?>
                            value="<?php echo s($empleadoInformatica->id); ?>"><?php echo s($empleadoInformatica->nombre . ' ' 
                            .$empleadoInformatica->apellidoPaterno . ' ' . $empleadoInformatica->apellidoMaterno); ?>

                            </option>
                        <?php } ?>
                    </select>

                    <div class="formulario__comentarios">
                    <textarea class="formulario__comentarios-text-area" name="comentariosSoporte" id="comentarios" maxlength="250" placeholder="Comentarios"><?php echo $ticket->comentariosSoporte; ?></textarea>
                </div>


                </fieldset>
                <input type="submit" class="boton-escalar-ticket" value="Escalar ticket">
            </form>
        </div>


    </div>


</main>

<?php $script = "
<script src='/build/js/dashboard.js' defer></script>

"

?>