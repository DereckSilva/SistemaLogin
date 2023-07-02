<?php

namespace App\Http\Requests\Login;

use App\Util\Trait\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class LoginForApiRequest extends FormRequest
{

    use ApiResponse;

    /**
     * Determina se a request pode ser acessada pelo usuário
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Retorna a validação para cada campo
     *
     * @author Dereck Silva
     * @since 29/04/2023
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'         => [ 'required' ],
            'password'      => ['required', Password::min(8)->letters(2)->numbers() ],
            'rememberToken' => [ 'required', 'boolean' ]
        ];
    }

    /**
     * Retorna o erro com base especificado nas rules
     *
     * @author Dereck Silva
     * @since 29/04/2023
     * @param Validator $validator
     * @return HttpResponseException
     */
    public function failedValidation(Validator $validator)
    {
        return $this->httpException('Erro na validação',  [ $validator->errors() ], 400);
    }
}
