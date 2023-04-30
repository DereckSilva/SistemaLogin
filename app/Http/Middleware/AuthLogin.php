<?php

namespace App\Http\Middleware;

use App\Http\Util\Trait\requestMiddleware;
use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthLogin
{
    use requestMiddleware;

    public function handle(Request $request, Closure $next): JsonResponse {

        /* Recupera o nome da requisição para verificar as regras de request no middleware */
        $requestName =  Str::title(explode('/', $request->getRequestUri())[2]);
        $this->resolveRules($requestName);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Email ou senha incorreto'
            ], 404));
        }

        return $next($request);
    }
}