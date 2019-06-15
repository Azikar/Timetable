<?php

namespace App\Interfaces;

interface MailerInterface{

    public function set_mailer_settings();
    public function set_recipient($recipients);
    public function set_content($content);
    public function send_mail($recipients, $content);
}