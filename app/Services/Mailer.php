<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use App\Interfaces\MailerInterface;

class Mailer implements MailerInterface{

    protected $mail;
    public function __construct(){
        $this->mail=new PHPMailer(true);
    }
    public function set_mailer_settings()
    {
        $this->mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $this->mail->isSMTP();                                            // Set mailer to use SMTP
        $this->mail->Host       = env('mailHost');  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth   = env('mailSMTPAuth');                                   // Enable SMTP authentication
        $this->mail->Username   = env('mailUsername');                       // SMTP username
        $this->mail->Password   = env('mailPassword');                               // SMTP password
        $this->mail->SMTPSecure = env('mailSMTPSecure');                                  // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port       = env('mailPort');  
    }
    public function set_recipient($recipients){
        
        $this->mail->setFrom(env('mailUsername'), 'Mailer');
        $this->mail->addAddress($recipients, 'Joe User');
        $this->mail->addReplyTo(env('mailUsername'), 'Mailer');
        
    }
    public function set_content($content){
        
        $this->mail->isHTML(true);
        $this->mail->Subject=$content['subject'];
        $this->mail->Body=$content['body'];
    }
    public function send_mail($recipients, $content){
        try {
        $this->set_mailer_settings();
        $this->set_recipient($recipients);
        $this->set_content($content);
        
        $this->mail->send();
        
        } catch (Exception $e) {
        
        }
    }
}