<?php

namespace App\Pipelines;

use App\Jobs\SendMail;
use Closure;

class TestePipeline
{
    public function handle($user, Closure $next) {

        return $next($user);
    }
}
