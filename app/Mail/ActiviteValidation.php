<?php

namespace App\Mail;

use App\Models\Activite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ActiviteValidation extends Mailable
{
    use Queueable, SerializesModels;
    public $activite;

    /**
     * Create a new message instance.
     */
    public function __construct(Activite $activite)
    {
        $this->activite = $activite;
        $this->from('cheriffodg20@gmail.com', 'Action CiDeP');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Activite Validation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.activite_validation',
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
