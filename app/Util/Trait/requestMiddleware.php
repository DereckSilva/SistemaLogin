<?php

namespace App\Util\Trait;

trait requestMiddleware
{
    /**
     * Resolve as rules para uma determinada requisição dentro de um middleware
     *
     * @author Dereck Silva
     * @since 29/04/2023
     * @param string $rule
     * @return void
     */
    public function resolveRules(string $rule) {
        app('App\Http\Requests\\' . $rule . '\\' . $rule . 'ForApiRequest' );
    }
}