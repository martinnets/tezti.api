<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitedPositionTemplate extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $position;
    public $position_id;
    public $token;
    public $subject = 'Has sido invitado a un proceso';

    /**
     * Create a new message instance.
     */
    public function __construct($user, $position,$position_id,$token, $new_subject = null)
    {
        $this->user = $user;
        $this->position = $position;
        $this->position_id = $position_id;
        $this->token = $token;
        
        if ($new_subject) {
            $this->subject = $new_subject;
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.invited-position',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
