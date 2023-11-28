<header class=" <?php echo $titulo!=='Iniciar sesión' ? 'bg-primary' : 'position-fixed top-0 bg-primary-darker bg-opacity-10'?> w-100">
    <div class="header__contenedor">
        <div class="header__logo">
            <img class="header__imagen" src="/build/img/siteurBlancoWbg.png" alt="logo sitiur">
        </div>
        <?php if ($titulo !== 'Iniciar sesión') {?>
        <div class="header__navegacion">
            <a href="/login" class="header__enlace">Iniciar sesión</a>
        </div>
        <?php }?>
    </div>
</header>