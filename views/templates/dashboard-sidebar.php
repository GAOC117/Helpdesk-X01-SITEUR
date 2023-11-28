<div class="d-flex">

  <!-- <div class="position-absolute"></div> -->
  <button class="z-1 btn <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?> fs-2 position-fixed ms-3 mt-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
    <i class="bi bi-list"></i>
    <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle <?php echo $idRol === '4' ? 'd-none' : ''; ?> " id="notificacion-boton-hamburguesa">
      <span class="visually-hidden">New alerts</span>
    </span>

  </button>

  <div style='width: 30rem' class="z-5 offcanvas offcanvas-start <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'bg-dark' : 'bg-primary'; ?> tabindex=" -1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">

    <div class="offcanvas-header">
      <div class="d-flex">
        <a href="/">
          <div class="text-center">
            <img class="img-fluid w-50" src="/build/img/siteurBlancoWbg.png" alt="logo sitiur">
          </div>
        </a>
        <div data-bs-theme='dark'>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
      </div>
    </div>

    <div class="offcanvas-body">
      <!-- <div> -->

      <?php if ($expedienteLogueado === '4486') { ?>
        <img src="/build/img/vader.png" alt="empleado" class=" img-empleado w-25 d-block mx-auto my-3">
        <!-- <img src="/build/img/space.png" alt="empleado" class=" imagenEmpleado w-25"> -->
      <?php }  ?>
      <?php if ($expedienteLogueado === '4485') { ?>
        <img src="/build/img/koala.png" alt="empleado" class=" img-empleado w-25 d-block mx-auto my-3">
      <?php }
      if ($expedienteLogueado !== '4485' && $expedienteLogueado !== '4486') { ?>

        <img src="http://skynet.siteur.gob.mx/fotos/<?php echo $expedienteLogueado; ?>.jpg" alt="empleado" class="imagenEmpleado w-25 d-block mx-auto my-3">
      <?php } ?>

      <p class="text-white text-center fs-4 mt-5"><?php echo $nombre; ?></p>


      <!-- </div> -->
      <div class="d-flex flex-column row-gap-4 menu-sidebar ">

        <a href="/" class=" fs-4 text-start ps-5 btn <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?>"><i class="bi bi-house-heart-fill me-3"></i>Inicio</a>

        <button class="fs-4 text-start ps-5 btn <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#tickets" aria-expanded="false" aria-controls="collapseExample">
          <i class="bi bi-ticket-perforated-fill me-3 icono-boleto-menu"></i>Tickets
        </button>

        <div class="collapse" id="tickets">
          <div class="d-flex flex-column row-gap-4">

            <a href="/dashboard/ver-tickets" class="d-block fs-4 text-start p-x btn <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?>"><i class="bi bi-eye me-3"></i> <?php if ($idRol === '2') echo 'Ver tickets';
                                                                                                                                                                                                                                  else { ?>
              <?php echo 'Mis tickets';
                                                                                                                                                                                                                                  } ?></a>
            <?php if ($idRol !== '3') { ?>
              <a href="/dashboard/generar-ticket" class="d-block fs-4 text-start p-x btn <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?>"><i class="bi bi-plus-circle me-3"></i> Nuevo ticket</a>
            <?php } ?>
          </div>
        </div>


        <?php if ($idRol === '1') { ?>
          <a href="/dashboard/empleados" class=" fs-4 text-start ps-5 btn <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?>"><i class="bi bi-people-fill me-3"></i>Empleados</a>

          <a href="/dashboard/clasificaciones" class=" fs-4 text-start ps-5 btn <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?>"><i class="fa-brands fa-jedi-order me-3"></i>Clasificación incidentes</a>

          <a href="/dashboard/subclasificaciones" class=" fs-4 text-start ps-5 btn <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?>"><i class=" fa-brands fa-empire me-3"></i></i>Subclasificación incidentes</a>

          <a href="/dashboard/departamentos" class=" fs-4 text-start ps-5 btn <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?>"><i class="bi bi-building me-3"></i>Departamentos</a>
        <?php } ?>

      </div>
      <!-- <div class="dropdown mt-3">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          Dropdown button
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </div> -->


      <div class="position-fixed bottom-0 align-self-center">


        <p class="text-white text-center <?php echo $idRol === '1' ?  'fs-5' : ''; ?>">IP: <span> <?php echo empty($_SERVER["REMOTE_ADDR"]) ?  "&nbspDesconocida" : "&nbsp" . $_SERVER["REMOTE_ADDR"]; ?></span></p>



        <?php if ($idRol !== '4') { ?>
 

          <div class="d-flex flex-column row-gap-4">



            <a style="width: 28rem;" class="btn fs-4 text-end ps-5 pe-x btn <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?> position-relative" id="notificaciones-enlace">
              <i class="bi bi-bell me-1"></i>
              Notificaciones
              <span class="position-absolute top-x start-x translate-middle badge rounded-pill bg-danger" id="notificacion-boton-texto">
                9+
                <span class="visually-hidden"></span>
              </span>
            </a>


          <?php } ?>


          <a style="width: 28rem;" class="btn fs-4 text-end ps-5 pe-x btn <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'btn-dark' : 'btn-primary'; ?>" href="/logout">
            <i class="bi bi-box-arrow-right me-3"></i>Cerrar sesión</a>


          </div>

      </div>



    </div>

  </div>
</div>



<div class="toast-container position-fixed bottom-0 end-0 p-3 z-1">
  <div id="liveToast" class="toast <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'bg-dark' : 'bg-primary'; ?> text-white" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
    <div class="toast-header <?php echo $expedienteLogueado === '4486' || $expedienteLogueado === '4485' ?  'bg-dark' : 'bg-primary'; ?> text-white">
      <img src="/build/img/siteurTBlancoWbg.png" class="rounded me-2" alt="siteur" style="width: 2rem;">
      <strong class="me-auto fs-5">Tickets entrantes</strong>
      <small class="tiempo-ago fs-5"></small>
      <div data-bs-theme='dark'>
        <button type="button" class="btn-close btn-toast" data-bs-dismiss="toast" aria-label="Close" id="btnCloseToast"></button>
      </div>
    </div>
    <div class="toast-body fs-4" id="mensaje-notificacion">
    </div>
  </div>
</div>