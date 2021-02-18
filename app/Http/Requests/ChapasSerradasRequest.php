<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChapasSerradasRequest extends FormRequest
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
            'numeracao' => ['required', 'max:191'],
            'tipos_blocos_id' => ['required'],
            'observacoes_id' => ['required'],
            'observacoes' => ['nullable', 'string']
        ];
    }

    public function messages()
    {
        return [
            'numeracao.required' => 'Informe a numeração do bloco',
            'numeracao.max' => 'Tamanho máximo excedido',
            'tipos_blocos_id.required' => 'Selecione o material do bloco',
            'observacoes_id.required' => 'Selecione a qualidade da serrada',
            'observacoes.string' => 'Conteúdo inválido para o campo observações'
        ];
    }
}
