<header class="dashboard__header">
    <div class="dashboard__header-grid">
        <a href="/">
            <div class="dashboard__logo">
                <img class="dashboard__imagen" src="/build/img/siteurBlancoWbg.png" alt="logo sitiur">
            </div>
        </a>

        <div class="dashboard__nav">
            <div class="dashboard__empleado">
                <div class="dashboard__empleado--texto">
                    <div class="dashboard__empleado--nombre">
                        <p><?php echo $nombre . ' - ' . $expediente ?></p>
                    </div>
                    <form action="" class="dashboard__form">
                        <input type="submit" class="dashboard__submit--logout" value="Cerrar sesión">
                    </form>
                </div>
                <div class="dashboard__empleado--foto">


                    <img class="dashboard__empleado--foto-empleado" src="http://skynet.siteur.gob.mx/fotos/<?php echo $expediente; ?>.jpg" alt="imagen empleado">

                </div>
                <div class="dashboard__notification">
                    <div class="dashboard__notification--pop">
                        <a href="https://www.google.com">99+</a>
                    </div>
                </div>
            </div>
        </div>
</header>
