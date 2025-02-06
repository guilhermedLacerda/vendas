<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteFormRequest extends FormRequest
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
            'nome' => 'required',
            'email' => 'required|unique:clientes,email',
            'telefone' => 'required',
            'endereco' => 'required',
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
        'nome.required' => 'é necessario o nome',
    
        'email.required' => 'é necessario o email ',
        'email.unique' => 'o email é unico',
        

        'telefone.required' => 'o campo telefone é obrigatorio',

        'endereco.required' => 'o campo preco_unitario é obrigatorio',
       
        
        ];
    }
}
