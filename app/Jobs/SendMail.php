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

    /**
     * Create a new job instance.
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('teste@gmail.com')->send(new SendMails($this->name));
    }

    public function failed(Throwable $exception): void
    {
        // codificar depois
    }
}
