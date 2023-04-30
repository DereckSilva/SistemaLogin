<?php

namespace App\Http\Requests\Login;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginForApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => [ 'required' ],
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
    public function failedValidation(Validator $validator)
    {
        return $this->httpException('Erro na validação', $validator->errors(), 400);
    }
}
