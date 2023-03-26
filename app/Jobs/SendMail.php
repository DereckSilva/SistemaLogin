<?php

namespace App\Jobs;

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

    public $name;
    public $email;
    public $forgetPassword;
    public $cod;

    /**
     * Create a new job instance.
     */
    public function __construct($name, $email, $forgetPassword = false, $cod = null)
    {
        $this->name           = $name;
        $this->email          = $email;
        $this->forgetPassword = $forgetPassword;
        $this->cod            = $cod;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new SendMails($this->name, $this->forgetPassword, $this->cod));
    }

    public function failed(Throwable $exception): void
    {
        // codificar depois
    }
}
