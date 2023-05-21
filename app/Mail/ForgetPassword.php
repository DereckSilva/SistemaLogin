<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;


    /*
     * Armazena o email do usuário
     *
     * */
    protected $email;
    protected $code;

    /**
     * Create a new message instance.
     */
    public function __construct($email, $code)
    {
        $this->email = $email;
        $this->code  = $code;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: env('MAIL_FROM_ADDRESS'),
            subject: 'Esqueceu sua senha',
        );
    }

    /**
     * Mensagem que será armazenada no e-mail
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.forget',
            with: ['code' => $this->code]
        );
    }
}
