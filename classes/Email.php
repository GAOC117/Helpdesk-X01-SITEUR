<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public $email;
    public $nombre;
    public $token;
    // public $correoMesa = 'mdeayuda@siteur.gob.mx';
    public $correoMesa = 'gaoc117@gmail.com';

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom($_ENV['EMAIL_USER'], 'Helpdesk - SITEUR');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu cuenta de HelpDesk SITEUR';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong>. Has registrado correctamente tu cuenta en HelpDesk SITEUR; pero es necesario confirmarla.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar cuenta</a>";
        $contenido .= "<p>Si tu no creaste esta cuenta; puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }

    public function enviarInstrucciones()
    {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom($_ENV['EMAIL_USER']);
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu contraseña de HelpDesk SITEUR';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong>. Has solicitado reestablecer tu contraseña, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/reestablecer?token=" . $this->token . "'>Reestablecer contraseña</a>";
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }



    public function nuevoTicket($correoRequiere, $nombreRequiere, $folio, $clasificacion, $subclasificacion, $comentarios, $extensionReporta, $extensionRequiere, $departamentoReporta, $departamentoRequiere)
    {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom($_ENV['EMAIL_USER'],"Mesa de ayuda - #$folio");
        $mail->addAddress($this->correoMesa);
        $mail->addAddress($this->email); //quien reporta
        if ($this->email !== $correoRequiere)//si el que reporta es diferente a quien requiere
            $mail->addAddress($correoRequiere); //quien requiere
            
        
        $mail->Subject = 'Nuevo ticket registrado, folio #' . $folio;

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p>Hola</p><br>";
        $contenido .= "<p>Se ha registrado un nuevo ticket con el folio <strong style = 'color: green; font-weight: bold';>#$folio</strong></p>";
        if ($this->email !== $correoRequiere){

            $contenido .= "<p><strong>Nombre de quién reporta:</strong> $this->nombre</p>";
            $contenido .= "<p><strong>Extensión de quién reporta:</strong> $extensionReporta</p>";
            $contenido .= "<p><strong>Departamento de quién reporta:</strong> $departamentoReporta</p><br>";

            $contenido .= "<p><strong>Nombre de quién requiere:</strong> $nombreRequiere</p>";
            $contenido .= "<p><strong>Extensión de quién requiere:</strong> $extensionRequiere</p>";
            $contenido .= "<p><strong>Departamento de quién requiere:</strong> $departamentoRequiere</p>";
        }
        else
        {
            $contenido .= "<p><strong>Nombre de quién requiere:</strong> $this->nombre</p>";
            $contenido .= "<p><strong>Extensión:</strong> $extensionRequiere</p>";
            $contenido .= "<p><strong>Departamento de quién requiere:</strong> $departamentoRequiere</p>";
        }
        
        $contenido .= "<p><strong>Clasificación:</strong> $clasificacion</p>";
        $contenido .= "<p><strong>Subclasificación:</strong> $subclasificacion</p>";
        $contenido .= "<p><strong>Comentario del reporte:</strong> $comentarios</p><br>";

        $contenido .= "<p>En breve se asignará a alguien para atender la solicitud</p>";
        $contenido .= "<p><strong>Saludos</strong></p><br><br>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }




    public function nuevaAsignacionColaborador($nombreAsignado, $correoAsignado, $correoRequiere, $nombreRequiere, $folio, $clasificacion, $subclasificacion, $comentarios, $extensionReporta, $extensionRequiere, $departamentoReporta, $departamentoRequiere)
    {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom($_ENV['EMAIL_USER'],"Mesa de ayuda - #$folio");
        $mail->addAddress($this->correoMesa);
        $mail->addAddress($this->email); //quien reporta
        $mail->addAddress($correoAsignado); //quien atiende
        if ($this->email !== $correoRequiere)//si el que reporta es diferente a quien requiere
            $mail->addAddress($correoRequiere); //quien requiere
            
        
        $mail->Subject = 'El folio #' . $folio.' ha sido asignado';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p>Hola</p><br>";
        $contenido .= "<p>Se ha asignado a <strong>".$nombreAsignado."</strong> para atender el ticket con el folio <strong style = 'color: green; font-weight: bold';>#$folio</strong></p><br>";
        $contenido .= "<p>Información del ticket</p><br>";
        if ($this->email !== $correoRequiere){

            $contenido .= "<p><strong>Nombre de quién reporta:</strong> $this->nombre</p>";
            $contenido .= "<p><strong>Extensión de quién reporta:</strong> $extensionReporta</p>";
            $contenido .= "<p><strong>Departamento de quién reporta:</strong> $departamentoReporta</p><br>";

            $contenido .= "<p><strong>Nombre de quién requiere:</strong> $nombreRequiere</p>";
            $contenido .= "<p><strong>Extensión de quién requiere:</strong> $extensionRequiere</p>";
            $contenido .= "<p><strong>Departamento de quién requiere:</strong> $departamentoRequiere</p>";
        }
        else
        {
            $contenido .= "<p><strong>Nombre de quién requiere:</strong> $this->nombre</p>";
            $contenido .= "<p><strong>Extensión:</strong> $extensionRequiere</p>";
            $contenido .= "<p><strong>Departamento de quién requiere:</strong> $departamentoRequiere</p>";
        }
        
        $contenido .= "<p><strong>Clasificación:</strong> $clasificacion</p>";
        $contenido .= "<p><strong>Subclasificación:</strong> $subclasificacion</p>";
        $contenido .= "<p><strong>Comentario del reporte:</strong> $comentarios</p><br>";

        $contenido .= "<p>En breve se atendera la solicitud</p>";
        $contenido .= "<p><strong>Saludos</strong></p><br><br>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }


    public function escalarTicket($nombreAsignadoAnterior, $correoAsignadoAnterior, $nombreAsignadoNuevo, $correoAsignadoNuevo, $correoRequiere, $nombreRequiere, $folio, $clasificacion, $subclasificacion, $comentarios, $extensionReporta, $extensionRequiere, $departamentoReporta, $departamentoRequiere)
    {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom($_ENV['EMAIL_USER'],"Mesa de ayuda - #$folio");
        $mail->addAddress($this->correoMesa);
        $mail->addAddress($this->email); //quien reporta
        $mail->addAddress($correoAsignadoAnterior); //quien atiende
        $mail->addAddress($correoAsignadoNuevo); //quien atiende
        if ($this->email !== $correoRequiere)//si el que reporta es diferente a quien requiere
            $mail->addAddress($correoRequiere); //quien requiere
            
        
        $mail->Subject = 'El folio #' . $folio.' ha sido escalado';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p>Hola</p><br>";
        $contenido .= "<p>El ticket con el folio <strong style = 'color: green; font-weight: bold';>#$folio</strong> atendido por <strong>".$nombreAsignadoAnterior."</strong> se ha escalado a <strong>".$nombreAsignadoNuevo."</strong></p><br>";
        $contenido .= "<p>Información del ticket</p><br>";
        if ($this->email !== $correoRequiere){

            $contenido .= "<p><strong>Nombre de quién reporta:</strong> $this->nombre</p>";
            $contenido .= "<p><strong>Extensión de quién reporta:</strong> $extensionReporta</p>";
            $contenido .= "<p><strong>Departamento de quién reporta:</strong> $departamentoReporta</p><br>";

            $contenido .= "<p><strong>Nombre de quién requiere:</strong> $nombreRequiere</p>";
            $contenido .= "<p><strong>Extensión de quién requiere:</strong> $extensionRequiere</p>";
            $contenido .= "<p><strong>Departamento de quién requiere:</strong> $departamentoRequiere</p>";
        }
        else
        {
           
            $contenido .= "<p><strong>Nombre de quién requiere:</strong> $this->nombre</p>";
            $contenido .= "<p><strong>Extensión:</strong> $extensionRequiere</p>";
            $contenido .= "<p><strong>Departamento de quién requiere:</strong> $departamentoRequiere</p>";
        }
        
        $contenido .= "<p><strong>Clasificación:</strong> $clasificacion</p>";
        $contenido .= "<p><strong>Subclasificación:</strong> $subclasificacion</p>";
        $contenido .= "<p><strong>Comentario del reporte:</strong> $comentarios</p><br>";

        $contenido .= "<p>En breve se atendera la solicitud</p>";
        $contenido .= "<p><strong>Saludos</strong></p><br><br>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }

    public function pausarTicket($nombreAsignado, $correoAsignado, $correoRequiere, $nombreRequiere, $folio, $clasificacion, $subclasificacion, $comentarios, $extensionReporta, $extensionRequiere, $departamentoReporta, $departamentoRequiere, $motivo)
    {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom($_ENV['EMAIL_USER'],"Mesa de ayuda - #$folio");
        $mail->addAddress($this->correoMesa);
        $mail->addAddress($this->email); //quien reporta
        $mail->addAddress($correoAsignado); //quien atiende
        if ($this->email !== $correoRequiere)//si el que reporta es diferente a quien requiere
            $mail->addAddress($correoRequiere); //quien requiere
            
        
        $mail->Subject = 'El folio #' . $folio.' ha sido pausado';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p>Hola</p><br>";
        $contenido .= "<p>El ticket con el folio <strong style = 'color: green; font-weight: bold';>#$folio</strong> atendido por <strong>$nombreAsignado</strong> ha sido pausado.</p><br>";
        $contenido .= "<p><strong>Motivo por el cual se pauso el ticket: </strong>$motivo</p><br>";
        $contenido .= "<p>Información del ticket</p><br>";
        if ($this->email !== $correoRequiere){

            $contenido .= "<p><strong>Nombre de quién reporta:</strong> $this->nombre</p>";
            $contenido .= "<p><strong>Extensión de quién reporta:</strong> $extensionReporta</p>";
            $contenido .= "<p><strong>Departamento de quién reporta:</strong> $departamentoReporta</p><br>";

            $contenido .= "<p><strong>Nombre de quién requiere:</strong> $nombreRequiere</p>";
            $contenido .= "<p><strong>Extensión de quién requiere:</strong> $extensionRequiere</p>";
            $contenido .= "<p><strong>Departamento de quién requiere:</strong> $departamentoRequiere</p>";
        }
        else
        {
            $contenido .= "<p><strong>Nombre de quién requiere:</strong> $this->nombre</p>";
            $contenido .= "<p><strong>Extensión:</strong> $extensionRequiere</p>";
            $contenido .= "<p><strong>Departamento de quién requiere:</strong> $departamentoRequiere</p>";
        }
        
        $contenido .= "<p><strong>Clasificación:</strong> $clasificacion</p>";
        $contenido .= "<p><strong>Subclasificación:</strong> $subclasificacion</p>";
        $contenido .= "<p><strong>Comentario del reporte:</strong> $comentarios</p><br>";

        $contenido .= "<p>En breve se dara la continuidad a la  solicitud</p>";
        $contenido .= "<p><strong>Saludos</strong></p><br><br>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }
}
