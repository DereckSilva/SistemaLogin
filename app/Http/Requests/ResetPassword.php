<?php

namespace App\Http\Requests;

use App\Util\Trait\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class ResetPassword extends FormRequest
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
            /* salvar email no front e depois passar como parametro na requisicao */
            'email'       => [ 'required', 'email' ],
            'newPassword' => [ 'required', Password::min(8)->letters()->numbers(), 'confirmed' ]
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
    public function failedValidation(Validator $validator)
    {
        return $this->httpException('Erro na validação', $validator->errors(), 400);
    }
}
