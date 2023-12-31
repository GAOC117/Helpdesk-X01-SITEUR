<aside class="">
    <div class="dashboard__sidebar">
        <div class="dashboard__sidebar__menu-btn">
            <div class="dashboard__sidebar__menu-btn--burger"></div>
        </div>
        <div class="logo-sitiur">
            <a href="/">
                <div class="dashboard__logo">
                    <img class="dashboard__imagen" src="/build/img/siteurBlancoWbg.png" alt="logo sitiur">
                </div>
            </a>
        </div>
        <div class="dashboard__sidebar--header">
            <div class="dashboard__sidebar__ip">
                <p class="dashboard__sidebar__ip--texto">IP: <span> <?php echo empty($_SERVER["REMOTE_ADDR"]) ?  "&nbspDesconocida" : "&nbsp" . $_SERVER["REMOTE_ADDR"]; ?></span></p>
            </div>
            <div class="dashboard__sidebar--empleado">
                <div class="dashboard__sidebar--empleado-imagen-x">
                    <?php if ($expedienteLogueado === '4486') { ?>
                        <img src="/build/img/vader.png" alt="empleado" class="dashboard__sidebar--empleado-imagen img-empleado">
                        <!-- <img src="/build/img/space.png" alt="empleado" class="dashboard__sidebar--empleado-imagen img-empleado"> -->
                    <?php }  ?>
                    <?php if ($expedienteLogueado === '4485') { ?>
                        <img src="/build/img/koala.png" alt="empleado" class="dashboard__sidebar--empleado-imagen img-empleado">
                    <?php }
                    if ($expedienteLogueado !== '4485' && $expedienteLogueado !== '4486') { ?>

                        <img src="http://skynet.siteur.gob.mx/fotos/<?php echo $expedienteLogueado; ?>.jpg" alt="empleado" class="dashboard__sidebar--empleado-imagen">
                    <?php } ?>
                </div>
                <div class="dashboard__sidebar--empleado-nombre">
                    <p class="dashboard__sidebar--empleado-nombre--texto"><?php echo $nombre; ?></p>
                </div>
            </div>
        </div><!-- .header -->

        <div class="dashboard__sidebar-nav">
            <div class="dashboard__sidebar-nav--menu">
                <ul>
                    <li>
                        <a class="dashboard__sidebar-nav--enlace" href="/">
                            <i class="dashboard__sidebar-nav--icono fa-solid fa-house"></i>
                            <span class="dashboard__sidebar-nav--texto">Inicio</span>
                            <i class="dashboard__sidebar-nav--arrow fa-solid fa-chevron-right" style="opacity: 0"></i>
                        </a>
                    </li>

                    <li>
                        <a class="dashboard__sidebar-nav--enlace" href="#">
                            <i class="dashboard__sidebar-nav--icono fa-solid fa-ticket"></i>
                            <span class="dashboard__sidebar-nav--texto">Tickets</span>
                            <i class="dashboard__sidebar-nav--arrow fa-solid fa-chevron-right"></i>
                        </a>

                        <ul class="dashboard__sidebar-nav--sub-menu">
                            <li>
                                <a class="dashboard__sidebar-nav--enlace" href="/dashboard/ver-tickets">
                                    <i class="dashboard__sidebar-nav--icono fa-solid fa-eye"></i>
                                    <span class="dashboard__sidebar-nav--texto"> <?php if ($idRol === '1' || $idRol === '2') echo 'Ver tickets';
                                                                                    else { ?>
                                        <?php echo 'Mis tickets';
                                                                                    } ?></span>
                                </a>
                            </li>
                            <?php if ($idRol !== '3') { ?>
                                <li>
                                    <a href="/dashboard/generar-ticket">
                                        <i class="dashboard__sidebar-nav--icono fa-solid fa-file-circle-plus"></i>
                                        <span class="dashboard__sidebar-nav--texto">Nuevo ticket</span>
                                    </a>
                                </li>
                            <?php } ?>

                        </ul>

                    </li>
                    <?php if ($idRol === '1') { ?>
                        <li>
                            <a class="dashboard__sidebar-nav--enlace" href="/dashboard/empleados">
                                <i class="dashboard__sidebar-nav--icono fa-solid fa-user"></i>
                                <span class="dashboard__sidebar-nav--texto">Empleados</span>
                                <i class="dashboard__sidebar-nav--arrow fa-solid fa-chevron-right" style="opacity: 0"></i>
                            </a>

                        </li>

                        <li>
                            <a class="dashboard__sidebar-nav--enlace" href="/dashboard/clasificaciones">
                                <i class="dashboard__sidebar-nav--icono fa-brands fa-jedi-order"></i>
                                <span class="dashboard__sidebar-nav--texto">Clasificación incidentes</span>
                                <i class="dashboard__sidebar-nav--arrow fa-solid fa-chevron-right" style="opacity: 0"></i>
                            </a>

                            <!-- <ul class="dashboard__sidebar-nav--sub-menu">
                            <li>
                                <a class="dashboard__sidebar-nav--enlace" href="#">
                                    <i class="dashboard__sidebar-nav--icono fa-solid fa-circle-plus"></i>
                                    <span class="dashboard__sidebar-nav--texto">Agregar clasificación</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="dashboard__sidebar-nav--icono fa-solid fa-pen"></i>
                                    <span class="dashboard__sidebar-nav--texto">Editar clasificación</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="dashboard__sidebar-nav--icono fa-solid fa-circle-xmark"></i>
                                    <span class="dashboard__sidebar-nav--texto">Eliminar clasificación</span>
                                </a>
                            </li>
                        </ul> -->
                        </li>

                        <li>
                            <a class="dashboard__sidebar-nav--enlace" href="/dashboard/subclasificaciones">
                                <i class="dashboard__sidebar-nav--icono fa-brands fa-empire"></i>
                                <span class="dashboard__sidebar-nav--texto">Subclasificación incidentes</span>
                                <i class="dashboard__sidebar-nav--arrow fa-solid fa-chevron-right" style="opacity: 0"></i>
                            </a>

                            <!-- <ul class="dashboard__sidebar-nav--sub-menu">
                            <li>
                                <a class="dashboard__sidebar-nav--enlace" href="#">
                                    <i class="dashboard__sidebar-nav--icono fa-solid fa-circle-plus"></i>
                                    <span class="dashboard__sidebar-nav--texto">Agregar subclasificacion</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="dashboard__sidebar-nav--icono fa-solid fa-pen"></i>
                                    <span class="dashboard__sidebar-nav--texto">Editar subclasificacion</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="dashboard__sidebar-nav--icono fa-solid fa-circle-xmark"></i>
                                    <span class="dashboard__sidebar-nav--texto">Eliminar subclasificacion</span>
                                </a>
                            </li>
                        </ul> -->
                        </li>


                        <li>
                            <a class="dashboard__sidebar-nav--enlace" href="/dashboard/departamentos">
                                <i class="dashboard__sidebar-nav--icono fa-solid fa-building"></i>
                                <span class="dashboard__sidebar-nav--texto">Departamentos</span>
                                <i class="dashboard__sidebar-nav--arrow fa-solid fa-chevron-right" style="opacity: 0"></i>
                            </a>

                            <!-- <ul class="dashboard__sidebar-nav--sub-menu">
                            <li>
                                <a class="dashboard__sidebar-nav--enlace" href="#">
                                    <i class="dashboard__sidebar-nav--icono fa-solid fa-building-circle-arrow-right"></i>
                                    <span class="dashboard__sidebar-nav--texto">Agregar departamento</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="dashboard__sidebar-nav--icono fa-solid fa-building-circle-exclamation"></i>
                                    <span class="dashboard__sidebar-nav--texto">Editar departamento</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="dashboard__sidebar-nav--icono fa-solid fa-building-circle-xmark"></i>
                                    <span class="dashboard__sidebar-nav--texto">Eliminar departamento</span>
                                </a>
                            </li>
                        </ul> -->
                        </li>
                    <?php } ?>



                </ul>
            </div>
        </div>

        <div class="dashboard__sidebar-nav--menu menu-footer">


            <ul class="menu--footer">
                <?php if ($idRol !== '4') { ?>
                    <li class="notificaciones">
                        <!-- <a class="dashboard__sidebar-nav--enlace notificaciones-enlace" href="#">
                            <i class="dashboard__sidebar-nav--icono fa-solid fa-bell"></i>
                            <p class="notificaciones-icono"></p>
                            <span class="dashboard__sidebar-nav--texto">Notificaciones</span>
                            <i class="dashboard__sidebar-nav--arrow fa-solid fa-chevron-right" style="opacity: 0"></i>
                        </a> -->
                    </li>

                    <li>
                        <button type="button" class="btn btn-primary position-relative dashboard__sidebar-nav--enlace notificaciones-enlace">
                        <i class="dashboard__sidebar-nav--icono fa-solid fa-bell"></i><span class="btn-notificaciones ms-3 fs-3"></span>
                            <span class="notificaciones-icono position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </button>

                    </li>

                <?php } ?>

                <li class="logout">
                    <a class="dashboard__sidebar-nav--enlace enlace-logout" href="/logout">
                        <i class="dashboard__sidebar-nav--icono icono-logout fa-solid fa-arrow-right-from-bracket"></i>
                        <span class="dashboard__sidebar-nav--texto">Cerrar sesión</span>
                        <i class="dashboard__sidebar-nav--arrow fa-solid fa-chevron-right" style="opacity: 0"></i>
                    </a>
                </li>
            </ul>

        </div>

    </div>



</aside>