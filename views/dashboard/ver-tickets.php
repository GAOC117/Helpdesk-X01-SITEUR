<p>
    <?php 
    if($_SESSION['mensaje']){
    echo $_SESSION['mensaje']; $_SESSION['mensaje']='';
    }
    ?>
</p>

<main class="contenedor seccion">

<input type="text" id="myInput"  placeholder="Search for comentario.." title="Type in a name">
<input type="text" id="myInput1"  placeholder="Search for clasi.." title="Type in a name">
  
<input type="hidden" id="hdnSession" value=<?php echo $_SESSION['idRol'];?> />
    


    
    <table class="tabla-tickets" >
        
        
        
        
        
        <?php if (count($tickets) > 0) : ?>
            
         
            <thead>
                <tr>
                    <th>Ticket #</th>
                    <th>Nombre de quién asigna</th>
                    <th>Atiende</th>
                    <th>Fecha</th>
                    <th>Requiere el servicio</th>
                    <th>Estado del ticket</th>
                    <th>clasificación</th>
                    <th>Subclasificación</th>
                    <th>Comentarios</th>
                </tr>
            </thead>

            <!-- mostrar los resultados -->
            <tbody id="tabla-tickets-body">

                <?php
                foreach ($tickets as $ticket) : ?>

                    <tr class="borde">
                        <td><?php echo $ticket->idTicket; ?></td>
                        <td><?php echo $ticket->nombreAsigna; ?></td>
                        <td><?php echo $ticket->atiende; ?></td>
                        <td><?php echo date('d',strtotime($ticket->fecha)).'/'.$meses[date('m',strtotime($ticket->fecha))-1].'/'. date('Y',strtotime($ticket->fecha)); ?></td>
                        <td><?php echo $ticket->nombreRequiere; ?></td>
                        <td><?php echo $ticket->estadoTicket; ?></td>
                        <td><?php echo $ticket->clasificacion; ?></td>
                        <td><?php echo $ticket->subclasificacion; ?></td>
                        <td><?php echo $ticket->comentarios; ?></td>
                        
                        <td>
                        <?php if($idRol==='1' || $idRol === '2') {?>
                                <?php if($ticket->estadoTicket==='Abierto' || $ticket->estadoTicket==='Pausado' ||$ticket->estadoTicket==='Escalado') {?>
                                    
                                    <a href="/dashboard/escalar-tickets?id=<?php echo$ticket->idTicket; ?>" class="boton-amarillo-block">Escalar</a>
                                    <a href="/dashboard/cerrar-tickets?id=<?php echo$ticket->idTicket; ?>" class="boton-amarillo-block">Cerrar</a>
                                <?php }?>
                        <?php }?>    

                        <?php if($idRol==='3') {?>
                                <?php if($ticket->estadoTicket==='Abierto' || $ticket->estadoTicket==='Pausado' ||$ticket->estadoTicket==='Escalado') {?>
                                    
                                    
                                    <a href="/dashboard/cerrar-tickets?id=<?php echo$ticket->idTicket; ?>" class="boton-amarillo-block">Cerrar</a>
                                <?php }?>
                        <?php }?>  
                       

                           
                          
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
    </table>



</main>


<?php $script = "
<script src='/build/js/dashboard.js' defer></script>
<script src='/build/js/ver-tickets.js' defer></script>
"

?>
