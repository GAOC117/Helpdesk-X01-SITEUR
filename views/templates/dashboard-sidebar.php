<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">

        <a href="/dashboard" class="house dashboard__enlace">
            <i class="house house-icono fa-solid fa-house dashboard__icono"></i>
            <span class="house dashboard__menu-texto">
                Inicio
            </span>
        </a>


        <a class="ticket dashboard__enlace menu-principal tickets">
            <i class="ticket ticket-icono fa-solid fa-ticket dashboard__icono"></i>
            <span class="ticket dashboard__menu-texto">
                Tickets
            </span>
            <i class="i-ticket fa-solid"></i>
        </a>

        <ul class="dashboard__lista ul-tickets-hidden tickets ul-tickets">

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

        <a class="user dashboard__enlace menu-principal empleados">
            <i class="user user-icono fa-solid fa-user dashboard__icono"></i>
            <span class="user dashboard__menu-texto">
                Empleados
            </span>
            <i class="i-user fa-solid"></i>
        </a>
        <!-- <nav class="dashboard__menu"> -->
        <ul class="dashboard__lista empleado ul-empleado ul-empleado-hidden">
            <li class="dashboard__lista-boton">
                <a href="/dashboard/nuevo-empleado" class="add-user dashboard__enlace">
                    <i class="add-user add-user-icono fa-solid fa-user-plus dashboard__icono"></i>
                    <span class="add-user dashboard__menu-texto">
                        Nuevo empleado
                    </span>
                </a>
            </li>

            <li class="dashboard__lista-boton">
                <a href="/dashboard/editar-empleado" class="edit-user dashboard__enlace">
                    <i class="edit-user edit-user-icono fa-solid fa-user-pen dashboard__icono"></i>
                    <span class="edit-user dashboard__menu-texto">
                        Editar empleado
                    </span>
                </a>
            </li>

            <li class="dashboard__lista-boton">
                <a href="/dashboard/eliminar-empleado" class="eliminar-user dashboard__enlace">
                    <i class="eliminar-user eliminar-user-icono fa-solid fa-user-xmark dashboard__icono"></i>
                    <span class="eliminar-user dashboard__menu-texto">
                        Eliminar empleado
                    </span>
                </a>
            </li>

        </ul>



        <a class="incidente dashboard__enlace menu-principal incidentes">
            
            <i class="incidente incidente-icono fa-solid fa-person-falling-burst dashboard__icono"></i>
            <span class="incidente dashboard__menu-texto">
                Incidentes
            </span>
            <i class="i-incidente fa-solid"></i>
        </a>


        <ul class="dashboard__lista incidentes ul-incidentes ul-incidentes-hidden">
            <li class="dashboard__lista-boton">
                <a href="/dashboard/nueva-clasificacion" class="nueva-clasificacion dashboard__enlace">
                    <i class="nueva-clasificacion nueva-clasificacion-icono fa-solid fa-circle-plus dashboard__icono"></i>
                    <span class="nueva-clasificacion dashboard__menu-texto">
                        Nueva clasificación
                    </span>
                </a>
            </li>

            <li class="dashboard__lista-boton">
                <a href="/dashboard/editar-clasificacion" class="editar-clasificacion dashboard__enlace">
                    <i class="editar-clasificacion editar-clasificacion-icono fa-solid fa-pen dashboard__icono"></i>
                    <span class="editar-clasificacion dashboard__menu-texto">
                        Editar clasificación
                    </span>
                </a>
            </li>

            <li class="dashboard__lista-boton">
                <a href="/dashboard/eliminar-clasificacion" class="eliminar-clasificacion dashboard__enlace">
                    <i class="eliminar-clasificacion eliminar-clasificacion-icono fa-solid fa-circle-xmark dashboard__icono"></i>
                    <span class="eliminar-clasificacion dashboard__menu-texto">
                        Eliminar clasificación
                    </span>
                </a>
            </li>
            <li class="dashboard__lista-boton">
                <a href="/dashboard/nueva-subclasificacion" class="nueva-subclasificacion dashboard__enlace">
                    <i class="nueva-subclasificacion nueva-subclasificacion-icono fa-solid fa-plus dashboard__icono"></i>
                    <span class="nueva-subclasificacion dashboard__menu-texto">
                        Nueva subclasificación
                    </span>
                </a>
            </li>

            <li class="dashboard__lista-boton">
                <a href="/dashboard/editar-subclasificacion" class="editar-subclasificacion dashboard__enlace">
                    <i class="editar-subclasificacion editar-subclasificacion-icono fa-solid fa-pencil dashboard__icono"></i>
                    <span class="editar-subclasificacion dashboard__menu-texto">
                        Editar subclasificación
                    </span>
                </a>
            </li>

            <li class="dashboard__lista-boton">
                <a href="/dashboard/eliminar-subclasificacion" class="eliminar-subclasificacion dashboard__enlace">
                    <i class="eliminar-subclasificacion eliminar-subclasificacion-icono fa-solid fa-xmark dashboard__icono"></i>
                    <span class="eliminar-subclasificacion dashboard__menu-texto">
                        Eliminar subclasificación
                    </span>
                </a>
            </li>


        </ul>



        <a class="departamentos dashboard__enlace menu-principal departamentos">
            
            <i class="departamentos departamentos-icono fa-solid fa-building dashboard__icono"></i>
            <span class="departamentos dashboard__menu-texto">
                Departamentos
            </span>
            <i class="i-departamentos fa-solid"></i>
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