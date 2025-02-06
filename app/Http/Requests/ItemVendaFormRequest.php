<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemVendaFormRequest extends FormRequest
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
            'venda_id' => 'required|integer',
            'produto_id' => 'required|integer',
            'quantidade' => 'required|integer',
            'preco_unitario' => 'required|decimal:0,2'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'message' => 'erro de validacao',
                'errors' => $validator->errors()
        ], 422));
    }

    public function messages()
    {
        return [
        'venda_id.required' => 'é necessario o Id da venda',
        'venda_id.integer' => 'o campo id da venda é do tipo inteiro',

        'produto_id.required' => 'é necessario o Id do produto ',
        'produto_id.integer' => 'o campo id do produto é do tipo inteiro',

        'quantidade.required' => 'o campo quantidade é obrigatorio',
        'quantidade.integer' => 'o campo quantidade é do tipo inteiro',

        'preco_unitario.required' => 'o campo preco_unitario é obrigatorio',
        'preco_unitario.decimal' => 'o preco_unitario deve ter 2 casas decimais'
        
        ];
    }
}
