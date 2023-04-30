<?php

namespace App\Http\Middleware;

use App\Util\Trait\ApiResponse;
use App\Util\Trait\requestMiddleware;
use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthLogin
{
    use requestMiddleware, ApiResponse;

    /**
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|HttpResponseException
     */
    public function handle(Request $request, Closure $next): HttpResponseException|JsonResponse
    {

        /* Recupera o nome da requisição para verificar as regras de request no middleware */
        $requestName =  Str::title(explode('/', $request->getRequestUri())[2]);
        $this->resolveRules($requestName);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->httpException('E-mail ou senha incorreto', [], 404);
        }

        return $next($request);
    }
}