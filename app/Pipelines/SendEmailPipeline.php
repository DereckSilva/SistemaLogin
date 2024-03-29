<?php

namespace App\Pipelines;

use App\Jobs\SendMail;
use Closure;


class SendEmailPipeline
{
    public function handle($user, Closure $next) {
        SendMail::dispatch($user['name'], $user['email'])->onQueue('cadUser')
            ->delay(15);

        return $next($user);
    }
}
