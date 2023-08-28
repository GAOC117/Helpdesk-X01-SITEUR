<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;
    
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {

         // create a new object
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['EMAIL_HOST'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['EMAIL_PORT'];
         $mail->Username = $_ENV['EMAIL_USER'];
         $mail->Password = $_ENV['EMAIL_PASS'];
     
         $mail->setFrom('cuentas@devwebcamp.com');
         $mail->addAddress($this->email, $this->nombre);
         $mail->Subject = 'Confirma tu Cuenta';

         // Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';

         $contenido = '<html>';
         $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has Registrado Correctamente tu cuenta en DevWebCamp; pero es necesario confirmarla</p>";
         $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";       
         $contenido .= "<p>Si tu no creaste esta cuenta; puedes ignorar el mensaje</p>";
         $contenido .= '</html>';
         $mail->Body = $contenido;

         //Enviar el mail
         $mail->send();

    }

    public function enviarInstrucciones() {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('cuentas@devwebcamp.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/recuperar?token=" . $this->token . "'>Reestablecer Password</a>";        
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }
}





// public function enviarInstracciones()
//     {
//         //Crear el objeto de email
//         $mail = new PHPMailer();
//         $mail->isSMTP();
//         // $mail->Host = $_ENV['EMAIL_HOST'];
//         $mail->Host = 'smtp.gmail.com';
//         $mail->SMTPAuth = true;
//         $mail->Username = 'gortiz@siteur.gob.mx';
//         // $mail->Username = 'gaoc117@gmail.com';
//         // $mail->Username = $_ENV['EMAIL_USER'];
//         // $mail->Password = $_ENV['EMAIL_PASS'];
//         $mail->Password = 'cblwtelkpdhxsnfd';
//         // $mail->Password = 'CTN0452-9';
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
//         // $mail->Port = $_ENV['EMAIL_PORT'];
//         $mail->Port = 465;


//         $mail->setFrom('x@x.com','la version de dos correosversion nueva y mejorada');
//         // $mail->addAddress('gaoc117@gmail.com', 'mesa de ayuda');
//         $mail->addAddress('gaoc117@gmail.com', 'mesa de ayuda');
//         $mail->addAddress('memocle@hotmail.com', 'mesa de ayuda');
//         $mail->Subject = 'Reestablece tu password';

//         $mail->isHTML(true);
//         $mail->CharSet = 'UTF-8';
//         $contenido = "<html>";
//         $contenido .= "<p><strong>Hola " . $this->nombre . ". </strong> Has solicitado resstablecer tu password, sigue el siguiente enlace para hacerlo</p>";
//         $contenido .= "<p>Presiona aquí: <a href='".$_ENV['APP_URL'] ."/recuperar?token=" . $this->token . "'>Restablecer </a></p>";
//         $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
//         $contenido .= "</html>";

//         $mail->Body = $contenido;

//         //enviar email
//     //    debuguear($mail->send());
//         $mail->send();
       
          
//     }