<?php

namespace App\Http\Requests\CadUser;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CadUserForApiRequest extends FormRequest
{
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
            'email' => 'required'
        ];
    }

    /**
     * Retorna o erro com base especificado nas rules
     *
     * @author Dereck Silva
     * @since 29/04/2023
     * @param Validator $validator
     * @return void
     */
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Erro na validação',
            'data' => $validator->errors()
        ], 400));
    }
}
