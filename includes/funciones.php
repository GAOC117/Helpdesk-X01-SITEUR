<?php

function debuguear($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}


function isLogged()
{
    
    if (empty($_SESSION))
        header('Location: /');
}


function idNotNumeric()
{
    if (!is_numeric($_GET['id']))
        header('Location: /dashboard/ver-tickets');
}


function esSoporte()
{
   
    if ($_SESSION['idRol'] === '3')
        header('location:/dashboard/ver-tickets');
}

function isAdmin()
{

    if ($_SESSION['idRol'] !== '1')
        header('location:/dashboard/ver-tickets');
}
