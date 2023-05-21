<?php

namespace App\Jobs;

use App\Mail\ForgetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMails;
use Throwable;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $forgetPassword;
    protected $code;

    /**
     * Cria uma instancia da automação para envio de email
     */
    public function __construct($name, $email, $forgetPassword = false, $code = null)
    {
        $this->name           = $name;
        $this->email          = $email;
        $this->forgetPassword = $forgetPassword;
        $this->code           = $code;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->forgetPassword) {
            Mail::to($this->email)->send(new ForgetPassword($this->email, $this->code));
        } else {
            Mail::to($this->email)->send(new SendMails($this->name));
        }
    }

    /**
     * Em caso de falha do job executa aqui
     *
     * @param Throwable $exception
     * @return void
     */
    public function failed(Throwable $exception): void
    {
        // codificar depois
    }
}
