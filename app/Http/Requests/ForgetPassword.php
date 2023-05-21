<?php

namespace App\Http\Requests;

use App\Util\Trait\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ForgetPassword extends FormRequest
{

    use ApiResponse;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Retorna a validação para cada campo
     *
     * @author Dereck Silva
     * @since 21/05/2023
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => [ 'required', 'email' ]
        ];
    }

    /**
     * Retorna o erro com base especificado nas rulex's
     *
     * @author Dereck Silva
     * @since 21/05/2023
     * @param Validator $validator
     * @return HttpResponseException
     */
    public function failedValidation(Validator $validator): HttpResponseException {
        return $this->httpException('Erro na validação', $validator->errors(), 400);
    }
}
