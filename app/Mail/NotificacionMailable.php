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

    public function __construct($user, $position,$position_id,$token,$userid, $new_subject = null)
    {
        $this->user = $user;
        $this->userid = $userid;
        $this->position = $position;
        $this->position_id = $position_id;
        $this->token = $token;
        
        if ($new_subject) {
            $this->subject = $new_subject;
        }
        //$this->mensaje = $mensaje;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('mails.notificacion');
    }
}
