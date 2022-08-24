<?php 


namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    protected $nombre;
    protected $email;
    protected $token;

    public function __construct($nombre, $email, $token){

        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarEmail($accion) {

        //configuración del servidor de correo
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '40a61d3185837e';
        $phpmailer->Password = '0f6f82fc15c8f4';

        $phpmailer->setFrom('cuentas@uptask.com');
        // $phpmailer->addAddress('cuentas@uptask.com', 'UpTask.com');
        $phpmailer->addAddress($this->email);

        if($accion === 'confirmar') {

            $phpmailer->Subjet = 'Confirma tu cuenta en UpTask';
    
            /**
             * Configuración para enviar desde servidores gmail
             */
            // $phpmailer = new PHPMailer();
            // $phpmailer->isSMTP();
            // $phpmailer->Host = 'smtp.gmail.com';
            // $phpmailer->SMTPAuth = true;
            // $phpmailer->Username = 'escaner.gnsys@gmail.com';
            // $phpmailer->Password = '$sudo-root2021$';
            // $phpmailer->SMTPSecure = 'tls';
            // $phpmailer->Port = 587;
    
            // $phpmailer->setFrom('escaner.gnsys@gmail.com');
            // $phpmailer->addAddress($this->email);
            // $phpmailer->Subjet = 'Confirma tu cuenta en UpTask';
            
            $phpmailer->isHTML(TRUE);
            $phpmailer->CharSet = 'UTF-8';
    
            $contenido = '<html>';
            $contenido .='<p>Hola <strong>'.$this->nombre.'</strong></p>';
            $contenido .='<p>Has creado tu cuenta en UpTask, solo hace falta confirmarla en el siguiente enlace:</p>';
            $contenido .='<p><a href="http://localhost:3000/confirmar?token=' . $this->token . '">Confirma tu cuenta.</a></p>';
            $contenido .= '<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje.</p>';
            $contenido .= '</html>';
    
            $phpmailer->Body = $contenido;
            // debuguear('contenido');
            $phpmailer->send();
        }


        if($accion === 'reset') {
            $phpmailer->Subjet = 'Restablece tu password de UpTask';
            
            $phpmailer->isHTML(TRUE);
            $phpmailer->CharSet = 'UTF-8';
    
            $contenido = '<html>';
            $contenido .='<p>Hola <strong>'.$this->nombre.'</strong></p>';
            $contenido .='<p>Para cambiar tu password haz clic en el siguiente enlace:</p>';
            $contenido .='<p><a href="http://localhost:3000/reset?token=' . $this->token . '">Recuperar password.</a></p>';
            $contenido .= '<p>Si tu no solicitaste cambiar tu password, puedes ignorar este mensaje.</p>';
            $contenido .= '</html>';
    
            $phpmailer->Body = $contenido;
            // debuguear('contenido');
            $phpmailer->send();
        }
    }
}
?>