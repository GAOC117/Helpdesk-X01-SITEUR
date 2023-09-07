<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">

        <a href="/dashboard" class="house dashboard__enlace house-menu">
            <i class="house house-icono fa-solid fa-house dashboard__icono"></i>
            <span class="house dashboard__menu-texto">
                Inicio
            </span>
        </a>


        <a class="tickets dashboard__enlace menu-principal">
            <i class="tickets tickets-icono fa-solid fa-ticket dashboard__icono"></i>
            <span class="tickets dashboard__menu-texto">
                Tickets
            </span>
            <i class="tickets i-tickets fa-solid fa-chevron-right icono"></i>
        </a>

        <ul class="dashboard__lista tickets ul-tickets-hidden ul-tickets">

            <li class="dashboard__lista-boton">
                <a href="/dashboard/ver-tickets" class="ver-ticket dashboard__enlace">
                    <i class="ver-ticket ver-ticket-icono fa-solid fa-eye dashboard__icono"></i>
                    <span class="ver-ticket dashboard__menu-texto">
                        <?php if ($idRol === '1') echo 'Ver tickets'; ?>
                        <?php if ($idRol !== '1') echo 'Ver mis tickets'; ?>
                    </span>
                </a>
            </li>

            <li class="dashboard__lista-boton">
                <a href="/dashboard/generar-ticket" class="generar-ticket dashboard__enlace">
                    <i class="generar-ticket generar-ticket-icono fa-solid fa-file-circle-plus dashboard__icono"></i>
                    <span class="generar-ticket dashboard__menu-texto">
                        Generar ticket
                    </span>
                </a>
            </li>
        </ul>

        <a class="empleado dashboard__enlace menu-principal  empleado-menu">
            <i class="empleado empleado-icono fa-solid fa-user dashboard__icono"></i>
            <span class="empleado dashboard__menu-texto">
                Empleados
            </span>
            <i class="empleado i-empleado fa-solid fa-chevron-right icono"></i>
        </a>
        <!-- <nav class="dashboard__menu"> -->
        <ul class="dashboard__lista empleado ul-empleado ul-empleado-hidden">
            <li class="dashboard__lista-boton">
                <a href="/dashboard/nuevo-empleado" class="nuevo-empleado dashboard__enlace">
                    <i class="nuevo-empleado nuevo-empleado-icono fa-solid fa-user-plus dashboard__icono"></i>
                    <span class="nuevo-empleado dashboard__menu-texto">
                        Nuevo empleado
                    </span>
                </a>
            </li>

            <li class="dashboard__lista-boton">
                <a href="/dashboard/editar-empleado" class="editar-empleado dashboard__enlace">
                    <i class="editar-empleado editar-empleado-icono fa-solid fa-user-pen dashboard__icono"></i>
                    <span class="editar-empleado dashboard__menu-texto">
                        Editar empleado
                    </span>
                </a>
            </li>
 




            <li class="dashboard__lista-boton">
                <a href="/dashboard/eliminar-empleado" class="eliminar-empleado dashboard__enlace">
                    <i class="eliminar-empleado eliminar-empleado-icono fa-solid fa-user-xmark dashboard__icono"></i>
                    <span class="eliminar-empleado dashboard__menu-texto">
                        Eliminar empleado
                    </span>
                </a>
            </li>

        </ul>



        <a class="incidentes dashboard__enlace menu-principal incidentes-menu">

            <i class="incidentes incidentes-icono fa-solid fa-person-falling-burst dashboard__icono"></i>
            <span class="incidentes dashboard__menu-texto">
                Incidentes
            </span>
            <i class="incidentes i-incidentes fa-solid fa-chevron-right icono"></i>
        </a>


        <ul class="dashboard__lista incidentes ul-incidentes ul-incidentes-hidden">
            <li class="dashboard__lista-boton">
                <a href="/dashboard/nuevo-incidentes" class="nuevo-incidentes dashboard__enlace">
                    <i class="nuevo-incidentes nuevo-incidentes-icono fa-solid fa-circle-plus dashboard__icono"></i>
                    <span class="nuevo-incidentes dashboard__menu-texto">
                        Nueva clasificación
                    </span>
                </a>
            </li>

            <li class="dashboard__lista-boton">
                <a href="/dashboard/editar-incidentes" class="editar-incidentes dashboard__enlace">
                    <i class="editar-incidentes editar-incidentes-icono fa-solid fa-pen dashboard__icono"></i>
                    <span class="editar-incidentes dashboard__menu-texto">
                        Editar clasificación
                    </span>
                </a>
            </li>

            <li class="dashboard__lista-boton">
                <a href="/dashboard/eliminar-incidentes" class="eliminar-incidentes dashboard__enlace">
                    <i class="eliminar-incidentes eliminar-incidentes-icono fa-solid fa-circle-xmark dashboard__icono"></i>
                    <span class="eliminar-incidentes dashboard__menu-texto">
                        Eliminar clasificación
                    </span>
                </a>
            </li>
            <li class="dashboard__lista-boton">
                <a href="/dashboard/nuevo-sub-incidentes" class="nuevo-sub-incidentes dashboard__enlace">
                    <i class="nuevo-sub-incidentes nuevo-sub-incidentes-icono fa-solid fa-plus dashboard__icono"></i>
                    <span class="nuevo-sub-incidentes dashboard__menu-texto">
                        Nueva subclasificación
                    </span>
                </a>
            </li>

            <li class="dashboard__lista-boton">
                <a href="/dashboard/editar-sub-incidentes" class="editar-sub-incidentes dashboard__enlace">
                    <i class="editar-sub-incidentes editar-sub-incidentes-icono fa-solid fa-pencil dashboard__icono"></i>
                    <span class="editar-sub-incidentes dashboard__menu-texto">
                        Editar subclasificación
                    </span>
                </a>
            </li>

            <li class="dashboard__lista-boton">
                <a href="/dashboard/eliminar-sub-incidentes" class="eliminar-sub-incidentes dashboard__enlace">
                    <i class="eliminar-sub-incidentes eliminar-sub-incidentes-icono fa-solid fa-xmark dashboard__icono"></i>
                    <span class="eliminar-sub-incidentes dashboard__menu-texto">
                        Eliminar subclasificación
                    </span>
                </a>
            </li>


        </ul>



        <a class="departamento dashboard__enlace menu-principal departamento-menu">

            <i class="departamento departamento-icono fa-solid fa-building dashboard__icono"></i>
            <span class="departamento dashboard__menu-texto">
                Departamentos
            </span>
            <i class="departamento i-departamento fa-solid fa-chevron-right icono"></i>
        </a>


        <ul class="dashboard__lista departamento ul-departamento ul-departamento-hidden">
            <li class="dashboard__lista-boton">
                <a href="/dashboard/nuevo-departamento" class="nuevo-departamento dashboard__enlace">
                    <i class="nuevo-departamento nuevo-departamento-icono fa-solid fa-building-circle-arrow-right dashboard__icono"></i>
                    <span class="nuevo-departamento dashboard__menu-texto">
                        Nuevo departamento
                    </span>
                </a>
            </li>

            <li class="dashboard__lista-boton">
                <a href="/dashboard/editar-departamento" class="editar-departamento dashboard__enlace">
                    <i class="editar-departamento editar-departamento-icono fa-solid fa-building-circle-exclamation dashboard__icono"></i>
                    <span class="editar-departamento dashboard__menu-texto">
                        Editar departamento
                    </span>
                </a>
            </li>

            <li class="dashboard__lista-boton">
                <a href="/dashboard/eliminar-departamento" class="eliminar-departamento dashboard__enlace">
                    <i class="eliminar-departamento eliminar-departamento-icono fa-solid fa-building-circle-xmark dashboard__icono"></i>
                    <span class="eliminar-departamento dashboard__menu-texto">
                        Eliminar departamento
                    </span>
                </a>
            </li>

        </ul>
        <!-- </nav> -->

    </nav>
</aside>