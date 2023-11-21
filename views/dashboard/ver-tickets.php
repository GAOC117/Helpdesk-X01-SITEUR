<!-- <label for="checo">Exportar con rango de fechas</label>
<input type="checkbox" name="" id="checo">
<input type="date" id="desde" >
<input type="date" id="hasta"> -->
<main class="d-flex flex-column justify-content-center">

    <div class="text-center mb-5">
        <h2><i class="bi bi-ticket-perforated-fill me-3 icono-boleto"></i><?php echo $titulo; ?></h2>
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
    <div class="d-flex justify-content-between">

        <div class="d-flex flex-column w-25 ">
            <div class="ms-3 mb-3 d-flex">
                <label class="me-3 fs-3" for="checkFechas">Filtrar por rango</label>
                <input type="checkbox" id="checkFechas">
            </div>
            <div class=" mx-3 mb-3 d-flex">
                <div class="me-3 d-flex">
                    <label class="me-3 fs-3" for="fechaDesde">Desde</label>
                    <input type="date" id="fechaDesde">
                </div>
                <div class="d-flex">
                    <label class="me-3 fs-3" for="fechaHasta">Hasta</label>
                    <input type="date" id="fechaHasta">
                </div>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-center">
            <button class="btn btn-outline-success fs-3 mb-3 me-3" id="exportarExcel"><i class="bi bi-file-earmark-excel me-2"></i>Exportar</button>
            <button class="btn btn-outline-info fs-3 mb-3 me-3" id="limpiarFiltros">Limpiar filtros</button>
        </div>
    </div>

    <!-- TABLA -->
    <div class="table-responsive px-3">

        <table  class="table table-hover table-striped table-light align-middle table-bordered">
            <thead class="fs-5">
                <tr class="">

                    <?php if ($idRol === '2') { ?>
                        <th class="table-primary text-white text-center" scope="col"><input class="my-auto text-center bg-primary input-placeholder" type="number" placeholder="Folio" id="folioBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder=" Fecha registro" id="fechaBusqueda"></th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder="Atiende" id="atiendeBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder="Requiere" id="requiereBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder="Estado" id="estadoBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder="Clasificación" id="clasificacionBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder="Subclasificación" id="subclasificacionBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col">Comentarios de ticket</th>
                        <th class="table-primary text-white text-center" scope="col">Comentarios de soporte</th>
                        <th class="table-primary text-white text-center" scope="col">Acciones</th>
                    <?php } ?>

                    <?php if ($idRol === '1' || $idRol === '3') { ?>
                        <th class="table-primary text-white text-center" scope="col"><input class="my-auto text-center bg-primary input-placeholder" type="number" placeholder="Folio" id="folioBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder=" Fecha registro" id="fechaBusqueda"></th>
                        <th class="table-primary text-white text-center" scope="col"><input disabled class="text-center bg-primary input-placeholder" type="text" placeholder="Atiende" id="atiendeBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder="Requiere" id="requiereBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder="Estado" id="estadoBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder="Clasificación" id="clasificacionBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder="Subclasificación" id="subclasificacionBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col">Comentarios de ticket</th>
                        <th class="table-primary text-white text-center" scope="col">Comentarios de soporte</th>
                        <th class="table-primary text-white text-center" scope="col">Acciones</th>
                    <?php } ?>

                    <?php if ($idRol === '4') { ?>
                        <th class="table-primary text-white text-center" scope="col"><input class="my-auto text-center bg-primary input-placeholder" type="number" placeholder="Folio" id="folioBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder=" Fecha registro" id="fechaBusqueda"></th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder="Atiende" id="atiendeBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col"><input disabled class="text-center bg-primary input-placeholder" type="text" placeholder="Requiere" id="requiereBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder="Estado" id="estadoBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder="Clasificación" id="clasificacionBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col"><input class="text-center bg-primary input-placeholder" type="text" placeholder="Subclasificación" id="subclasificacionBusqueda"> </th>
                        <th class="table-primary text-white text-center" scope="col">Comentarios de ticket</th>
                        <th class="table-primary text-white text-center" scope="col">Comentarios de soporte</th>
                        <th class="table-primary text-white text-center" scope="col">Acciones</th>
                    <?php } ?>

                </tr>
              
            </thead>

            <tbody class="tabla__body tickets">

            </tbody>
        </table>
    </div>


    <div class="paginacion mb-3 ps-3">
        <button class="btn btn-primary fs-3 me-2" id="btnAnterior"> <i class="bi bi-chevron-double-left"></i></button>
        <div id="paginas"></div>
        <button class="btn btn-primary fs-3 ms-2" id="btnSiguiente"><i class="bi bi-chevron-double-right"></i></button>
    </div>





    <!-- MODAL -->
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
                        <span class="input-group-text fs-3">Comentarios ticket</span>
                        <textarea disabled class="form-control fs-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="comentariosReporte"></textarea>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text fs-3" id="inputGroup-sizing-default">Comentarios soporte</span>
                        <textarea disabled class="form-control fs-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="comentariosSoporte"></textarea>
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