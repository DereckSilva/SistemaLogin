<?php

namespace App\Http\Requests\CadUser;

use App\Util\Trait\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class CadUserForApiRequest extends FormRequest
{

    use ApiResponse;

    /**
     * Determina se o usuário está autorizado a realizar requisições
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
            'name'     => [ 'required', 'min:5' ],
            'email'    => [ 'required' ],
            'password' => [ 'required', Password::min(8)->letters(2)->numbers(), 'confirmed'],
        ];
    }

    /**
     * Retorna o erro com base especificado nas rulex's
     *
     * @author Dereck Silva
     * @since 29/04/2023
     * @param Validator $validator
     * @return HttpResponseException
     */
    public function failedValidation(Validator $validator): HttpResponseException {
        return $this->httpException('Erro na validação', [ $validator->errors() ], 400);
    }
}
