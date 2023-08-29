<main class="auth login">
<div class="auth__contenedor">

    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Inicia sesión en Helpdesk SITEUR</p>
    
    
    <div class="imagen">
        
<img class="imagen__logo" src="/build/img/Logo_de_SITEUR_T.png" alt="logo siteur">

</div>
<form action="" class="formulario" method="POST"> 
    <div class="formulario__campo">
        <label for="email" class="formulario__label">Correo:</label>
        <input type="email" class="formulario__input" placeholder="Tu correo electrónico" id="email" name="email">
    </div>
    
    <div class="formulario__campo">
        <label for="password" class="formulario__label">Contraseña:</label>
        <input type="password" class="formulario__input" placeholder="Tu contraseña" id="password" name="password">
    </div>
   
    <input type="submit" class="formulario__submit" value="Iniciar sesión">

    
</form>

</div>

<div class="acciones">
    <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Obtener una</a>
    <a href="/olvide" class="acciones__enlace">¿Olvidaste tu contraseña? Recuperar</a>
</div>

</main>