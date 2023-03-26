<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMails extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $forgetPassword;
    public $cod;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $forgetPassword = false, $cod = null)
    {
        $this->name           = $name;
        $this->forgetPassword = $forgetPassword;
        $this->cod            = $cod;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address')),
            subject: $this->forgetPassword ? 'Recuperação de Senha' : 'Bem Vindo',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->forgetPassword ? 'email.forget' : 'email.email',
            with: ['name' => $this->name, 'cod' => $this->cod ]
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
