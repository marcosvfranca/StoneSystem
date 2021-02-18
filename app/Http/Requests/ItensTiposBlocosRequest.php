<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItensTiposBlocosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'descricao' => ['required', 'string', 'max:191']
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'Informe o nome da variação',
            'descricao.string' => 'Valor inválido',
            'descricao.max' => 'Tamanho máximo do nome excedido'
        ];
    }
}
