<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VendaUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'desconto' => 'decimal:0,2',
            'produto_id' => 'integer',
            'quantidade' => 'integer'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'message' => 'erro de validacao',
                'errors' => $validator->errors()
            ], 422)
        );
    }

    public function messages()
    {
        return [
        'desconto' => 'o valor do desconto deve ter 2 casas decimais'
        ];
    }
}
