<?php

namespace App\Pipelines;

use App\Jobs\SendMail;
use \Illuminate\Pipeline\Pipeline;

class SendEmailPipeline extends Pipeline
{
    public function handle($user) {
        SendMail::dispatch($user['name'], $user['email'])->onQueue('cadUser')
            ->delay(15);
    }
}
