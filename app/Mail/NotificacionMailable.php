<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $userid;
    public $position;
    public $position_id;
    public $token;
    public $subject = 'Has sido invitado a un proceso';
    public $mensaje;
    public $fromName;
    public $fromEmail;
    public $ccRecipients;
    public function __construct($user, $position,$position_id,$token,$userid, $new_subject = null)
    {
        $this->user = $user;
        $this->userid = $userid;
        $this->position = $position;
        $this->position_id = $position_id;
        $this->token = $token;
        $this->fromName = 'TEZTI';
        $this->fromEmail = 'noreply@tezti.com';
        $this->ccRecipients = 'martinnets@gmail.com';
        if ($new_subject) {
            $this->subject = $new_subject;
        }
        //$this->mensaje = $mensaje;
    }

    public function build()
    {
        $mail= $this->subject($this->subject)
                    ->view('mails.notificacion');
        $mail->from($this->fromEmail, $this->fromName);
        $mail->cc($this->ccRecipients);
        return $mail;
    }
}
