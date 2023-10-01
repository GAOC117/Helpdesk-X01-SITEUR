<main class="asignar-tickets">
    <div class="boton-regresar">

        <a href="/dashboard/ver-tickets" class="volver-ver-tickets"><i class="fa-solid fa-left-long fa-2x"></i> Ver tickets</a>
    </div>
    <div class="asignar-tickets__header">
        <h2 class="asignar-tickets__heading"><?php echo $titulo; ?></h2>
        <p class="asignar-tickets__texto">Selecciona un empleado para asignar el ticket<span> #<?php echo $idTicket; ?></span></p>

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

                <div class="tickets__informacion__detalles">


                    <p class="tickets__informacion--texto"><span>Nombre: </span><?php echo $nombreRequiere; ?></p>
                    <p class="tickets__informacion--texto"><span>Extensión: </span><?php echo $extensionRequiere; ?></p>
                    <p class="tickets__informacion--texto"><span>Departamento: </span><?php echo $departamentoRequiere; ?></p>
                    <p class="tickets__informacion--texto"><span>Clasificación: </span><?php echo $clasificacion; ?></p>
                    <p class="tickets__informacion--texto"><span>Subclasificación: </span><?php echo $subclasificacion; ?></p>
                    <div class="tickets__informacion--comentarios">

                        <label class="tickets__informacion--texto--label">Comentarios:</label>
                        <div class="textarea">

                            <textarea class="tickets__informacion--texto--text-area" disabled><?php echo $comentarios; ?></textarea>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="tickets__asignacion">
            <form action="/dashboard/asignar-tickets?id=<?php echo $idTicket; ?>" class="formulario--asignar" method="POST">
                <fieldset class="formulario__fieldset--asignar">
                    <legend class="formulario__fieldset--leyenda">Seleccione el empleado al que se le asignara el ticket</legend>
                    <select class="formulario__campo--asignar select" name="idEmpAsignado" id="idEmpAsignado" autocomplete="on">
                        <option value="" disabled selected>--Seleccionar--</option>
                        <?php foreach ($empleadosInformatica as $empleadoInformatica) { ?>

                            <option value="<?php echo s($empleadoInformatica->id); ?>"><?php echo s($empleadoInformatica->nombre . ' ' . $empleadoInformatica->apellidoPaterno . ' ' . $empleadoInformatica->apellidoMaterno); ?>

                            </option>
                        <?php } ?>
                    </select>
                </fieldset>
                <input type="submit" class="formulario__submit--asignar-ticket" value="Asignar ticket">
            </form>
        </div>


    </div>


</main>

<?php $script = "
<script src='/build/js/dashboard.js' defer></script>
<script src='/build/js/sidebar.js' defer></script>";
if($idRol!=='4')
$script.="<script src='/build/js/notificaciones.js' defer></script>"

?>