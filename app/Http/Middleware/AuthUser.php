<?php

namespace App\Http\Middleware;

use App\Http\Util\Trait\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthUser
{

    use ApiResponse;

    /**
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        $user = Auth::user();

        if (empty($user)) {
            return $this->error('Usuário não autenticado', [], 401);
        }
        return $next($request);
    }
}
