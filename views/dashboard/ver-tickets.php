<main class="ver-tickets">

    <div class="ver-tickets__header">
        <h2 class="ver-tickets__texto"><?php echo $titulo; ?></h2>
    </div>




    <?php
    if ($_SESSION['mensaje']) { 
    ?>
    <div class="ver-tickets--alerta">

        <p class="alerta alerta__exito">
            <?php
             echo $_SESSION['mensaje'];
            $_SESSION['mensaje'] = '';
            ?>
        </p>
    </div>

    <?php } 
    ?>


<div class='contenedor'>
        <div class='filters'>
            <div class='filter-container'>
                <label class="filter-label">Folio: </label>
                <input type="number" autocomplete='off' class='filter' name='folio' placeholder='Buscar folio' data-col='folio' id="idFolio" />
            </div>
            <!-- <div class='filter-container'>
                <label>Quién asigna: </label>
                <input autocomplete='off' class='filter' name='asigna' placeholder='Buscar quién asigna el ticket' data-col='asigna' id="idAsigna" />
            </div> -->
            <div class='filter-container'>
                <label class="filter-label">Quién atiende: </label>
                <input autocomplete='off' class='filter' name='atiende' placeholder='Buscar quién atiende' data-col='atiende' id="idAtiende" />
            </div>
            <div class='filter-container'>
                <label class="filter-label">Fecha: </label>
                <input autocomplete='off' class='filter' name='fecha' placeholder='Fecha captura(dd/mm/aaaa)' data-col='fecha' id="idFecha" />
            </div>
            <div class='filter-container'>
                <label class="filter-label">Quién requiere: </label>
                <input autocomplete='off' class='filter' name='requiere' placeholder='Buscar quién requiere' data-col='requiere' id="idRequiere" />
            </div>
            <div class='filter-container'>
                <label class="filter-label">Estado: </label>
                <input autocomplete='off' class='filter' name='estado' placeholder='Buscar estado del ticket' data-col='estado' id="idEstado">
            </div>
            <div class='filter-container'>
                <label class="filter-label">Clasificación: </label>
                <input autocomplete='off' class='filter' name='clasificacion' placeholder='Buscar clasificacion' data-col='clasificación' id="idClasificacion" />
            </div>
            <div class='filter-container'>
                <label class="filter-label">Subclasificación: </label>
                <input autocomplete='off' class='filter' name='subclasificacion' placeholder='Buscar subclasificacion' data-col='subclasificación' id="idSubclasificacion" />
            </div>
            <div class='filter-container'>
                <label class="filter-label">Comentarios de ticket: </label>
                <input autocomplete='off' class='filter' name='captura' placeholder='Buscar comentarios' data-col='captura' id="idComentarios" />
            </div>
            <div class='filter-container'>
                <label class="filter-label">Comentarios de soporte: </label>
                <input autocomplete='off' class='filter' name='soporte' placeholder='Buscar comentarios' data-col='soporte' id="idComentariosSoporte" />
            </div>
        </div>
    </div>


    <div class="tabla__contenedor-container">

        <div class='tabla__contenedor'>



            <table id="myTable" class="table table-hover tabla" cellspacing="0" cellpadding="0">
                <thead class="tabla__header">
                    <tr class="tabla__header__pegar">

                        <th class="tabla__th">Folio#</th>
                        <th class="tabla__th">Fecha registro</th>
                        
                        <th class="tabla__th">Atiende</th>
                        <th class="tabla__th">Requiere</th>
                        <th class="tabla__th">Estado</th>
                        <th class="tabla__th">Clasificación</th>
                        <th class="tabla__th">Subclasificación</th>
                        <th class="tabla__th">Comentarios de ticket</th>
                        <th class="tabla__th">Comentarios de soporte</th>
                        <th class="tabla__th">Acciones</th>
                    </tr>
                </thead>
            
                <tbody class="tabla__body tickets">
                    
                </tbody>
            </table>
        </div>
    </div>


   










</main>


<?php $script = "
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/ver-tickets.js' defer></script>

";
if($idRol!=='4')
$script.="<script src='/build/js/notificaciones.js' defer></script>"

?>