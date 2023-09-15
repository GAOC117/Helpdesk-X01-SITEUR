<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, maximum-scale = 1.0 lang='es_MX'">
    <title id="tituloDashboard" behavior="scroll" direction="left">Helpdesk SITEUR - <?php echo $titulo; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="stylesheet" href="/build/css/dashboardPrincipal.css">
    












    <?php if ($idRol === '1') { ?>
        <link rel="stylesheet" href="/build/css/admin.css">
    <?php } ?>
    <?php if ($idRol === '2') { ?>
        <link rel="stylesheet" href="/build/css/helpdesk.css">
    <?php } ?>
    <?php if ($idRol === '3') { ?>
        <link rel="stylesheet" href="/build/css/soporte.css">
    <?php } ?>
    <?php if ($idRol === '4') { ?>
        <link rel="stylesheet" href="/build/css/colaborador.css">
    <?php } ?>



    <!-- VER QUE SUCEDE SI BORRO ESTO -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin="" defer></script>

    <!-- los siguientes 3 enlaces son para buscar en el select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> -->
    
    
    
    
    
    
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src='/build/js/multifilter.js'></script>
    <title>jQuery multifilter Plugin Demo</title>
    <link href='style.css' media='screen' rel='stylesheet' type='text/css' />
</head>
<script type='text/javascript'>
    //<![CDATA[
        $(document).ready(function() {
            $('.filter').multifilter()
        })
        //]]>
        </script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>










</head>

<body class="dashboard">
        <?php 
            include_once __DIR__ .'/templates/dashboard-header.php';
        ?>
        <div class="dashboard__grid">
            <?php
                include_once __DIR__ .'/templates/dashboard-sidebar.php';  
            ?>

            <main class="dashboard__contenido">
                <?php 
                    echo $contenido; 
                ?> 
              
            </main>
        </div>


        <?php echo $script ?? '' ?>
    <!-- <script src="/build/js/app.js" defer></script>
    <script src="/build/js/dashboard.js" defer></script>
    <script src="/build/js/ticket-nuevo.js" defer></script> -->
</body>

</html>
