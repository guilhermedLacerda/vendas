<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VendaFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cliente_id' => 'required|integer',
            'desconto' => 'decimal:0,2',
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
        'cliente_id.required' => 'id do cliente nao pode ser nulo',
        'cliente_id.integer' => 'o campo é do tipo inteiro',
        'desconto.decimal' => 'o valor do desconto deve ter 2 casas decimais'
        ];
    }

}
