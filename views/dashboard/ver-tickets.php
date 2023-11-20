<!-- <label for="checo">Exportar con rango de fechas</label>
<input type="checkbox" name="" id="checo">
<input type="date" id="desde" >
<input type="date" id="hasta"> -->
<main class="ver-tickets">

    <div class="ver-tickets__header">
        <h2 class="ver-tickets__texto"><?php echo $titulo; ?></h2>
    </div>



    <?php
    if ($_SESSION['mensaje']) {
    ?>
        <div class="ver-tickets--alerta div-ver-tickets">

            <p class="alerta alerta__exito">
                <?php
                echo $_SESSION['mensaje'];
                $_SESSION['mensaje'] = '';
                ?>
            </p>
        </div>

    <?php }
    ?>
    <!-- <button id="botonsito">Click</button> -->


    <div class='contenedor'>
        <div class='filters'>
            <div class='filter-container'>
                <label class="filter-label">Folio: </label>
                <!-- <input type="number" autocomplete='off' class='filter' name='folio' placeholder='Buscar folio' data-col='folio' id="folioBusqueda" /> -->
            </div>
            <!-- <div class='filter-container'>
                <label>Quién asigna: </label>
                <input autocomplete='off' class='filter' name='asigna' placeholder='Buscar quién asigna el ticket' data-col='asigna' id="idAsigna" />
            </div> -->
            <div class='filter-container'>
                <label class="filter-label">Quién atiende: </label>
                <input autocomplete='off' class='filter' name='atiende' placeholder='Buscar quién atiende' data-col='atiende' id="atiendeBusqueda" />
            </div>
            <div class='filter-container'>
                <label class="filter-label">Fecha: </label>
                <input autocomplete='off' class='filter' name='fecha' placeholder='Fecha captura(dd/mm/aaaa)' data-col='fecha' id="fechaBusqueda" />
            </div>
            <!-- <div class='filter-container'>
                <label class="filter-label">Quién requiere: </label>
                <input autocomplete='off' class='filter' name='requiere' placeholder='Buscar quién requiere' data-col='requiere' id="idRequiere" />
            </div> -->
            <div class='filter-container'>
                <label class="filter-label">Estado: </label>
                <input autocomplete='off' class='filter' name='estado' placeholder='Buscar estado del ticket' data-col='estado' id="estadoBusqueda">
            </div>
            <!-- <div class='filter-container'>
                <label class="filter-label">Clasificación: </label>
                <input autocomplete='off' class='filter' name='clasificacion' placeholder='Buscar clasificacion' data-col='clasificación' id="idClasificacion" />
            </div> -->
            <div class='filter-container'>
                <label class="filter-label">Subclasificación: </label>
                <input autocomplete='off' class='filter' name='subclasificacion' placeholder='Buscar subclasificacion' data-col='subclasificación' id="subclasificacionBusqueda" />
            </div>
            <!-- <div class='filter-container'>
                <label class="filter-label">Comentarios de ticket: </label>
                <input autocomplete='off' class='filter' name='captura' placeholder='Buscar comentarios' data-col='captura' id="idComentarios" />
            </div>
            <div class='filter-container'>
                <label class="filter-label">Comentarios de soporte: </label>
                <input autocomplete='off' class='filter' name='soporte' placeholder='Buscar comentarios' data-col='soporte' id="idComentariosSoporte" />
            </div> -->
        </div>
    </div>


    <!-- <div class="tabla__contenedor-container" id="divPaginacion">

        <div class='tabla__contenedor'> -->

    <div class="container-xl table-responsive-xl">

        <table id="myTable" class="table table-hover table-striped table-light">
            <thead class="tabla__headerr fs-5">
                <tr class="tabla__header__pegar">

                    <th class="tabla__thh table-primary text-white text-center" scope="col"> <input type="number" placeholder="Folio" id="folioBusqueda"> </th>
                    <th class="tabla__thh table-primary text-white text-center" scope="col">Fecha registro (dd/mm/yyyy)</th>

                    <th class="tabla__thh table-primary text-white text-center" scope="col">Atiende</th>
                    <th class="tabla__thh table-primary text-white text-center" scope="col">Requiere</th>
                    <th class="tabla__thh table-primary text-white text-center" scope="col">Estado</th>
                    <th class="tabla__thh table-primary text-white text-center" scope="col">Clasificación</th>
                    <th class="tabla__thh table-primary text-white text-center" scope="col">Subclasificación</th>
                    <th class="tabla__thh table-primary text-white text-center" scope="col">Comentarios de ticket</th>
                    <th class="tabla__thh table-primary text-white text-center" scope="col">Comentarios de soporte</th>
                    <th class="tabla__thh table-primary text-white text-center" scope="col">Acciones</th>
                </tr>
                <!-- <tr>
                        <td>
                        <input type="number" autocomplete='off' class='filter' name='folio' placeholder='Buscar folio' data-col='folio' id="folioBusqueda" />
                        </td>
                    </tr> -->

            </thead>

            <tbody class="tabla__body tickets">

            </tbody>
        </table>
    </div>
    <!-- </div>

    </div> -->
    <div class="paginacion">
        <button class="btn btn-primary fs-3 me-2" id="btnAnterior"> <i class="bi bi-chevron-double-left"></i></button>
        <div id="paginas"></div>
        <button class="btn btn-primary fs-3 ms-2" id="btnSiguiente"><i class="bi bi-chevron-double-right"></i></button>
    </div>






    <div class="modal fade" id="infoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-2" id="staticBackdropLabel">Información del ticket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container-xl">
                    <div class="input-group mb-3">
                        <span class="input-group-text fs-3" id="inputGroup-sizing-default">Folio</span>
                        <input disabled type="number" class="form-control fs-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="folio">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text fs-3" id="inputGroup-sizing-default">Requerido por</span>
                        <input disabled type="text" class="form-control fs-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="requiere">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text fs-3" id="inputGroup-sizing-default">Departamento</span>
                        <input disabled type="text" class="form-control fs-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="departamento">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text fs-3" id="inputGroup-sizing-default">Extensión</span>
                        <input disabled type="number" class="form-control fs-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="extension">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text fs-3" id="inputGroup-sizing-default">Correo</span>
                        <input disabled type="email" class="form-control fs-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="email">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text fs-3" id="inputGroup-sizing-default">Clasificación ticket</span>
                        <input disabled type="text" class="form-control fs-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="clasificacion">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text fs-3" id="inputGroup-sizing-default">Subclasificación ticket</span>
                        <input disabled type="text" class="form-control fs-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="subclasificacion">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text fs-3" id="inputGroup-sizing-default">Comentarios ticket</span>
                        <input disabled type="text" class="form-control fs-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="comentariosReporte">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text fs-3" id="inputGroup-sizing-default">Comentarios de soporte</span>
                        <input disabled type="text" class="form-control fs-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="comentariosSoporte">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text fs-3" id="inputGroup-sizing-default">Atendido por</span>
                        <input disabled type="text" class="form-control fs-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="atiende">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fs-3" data-bs-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>






</main>


<?php $script = "
<script src='/build/js/sidebar.js' defer></script>
<script src='/build/js/ver-tickets.js' defer></script>
<script src='/build/js/bootstrap.bundle.min.js'></script>

";
if ($idRol !== '4')
    $script .= "<script src='/build/js/notificaciones.js' defer></script>"

?>