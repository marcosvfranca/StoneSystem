<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlocosBrutosRequest extends FormRequest
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
            'numeracao' => ['required'],
            'comprimento' => ['required'],
            'altura' => ['required'],
            'largura' => ['required'],
            'transportadores_id' => ['required'],
            'tipos_blocos_id' => ['required'],
            'classificacoes_blocos_id' => ['required'],
            'fornecedores_id' => ['required'],
            'observacoes_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'numeracao.required' => 'Informe  a numeração do bloco',
            'comprimento.required' => 'Informe o comprimento do bloco',
            'altura.required' => 'Informe a altura do bloco',
            'largura.required' => 'Informe a largura do bloco',
            'transportadores_id.required' => 'Selecione o transportador do bloco',
            'tipos_blocos_id.required' => 'Selecione o material do bloco',
            'classificacoes_blocos_id.required' => 'Selecione a classificação do bloco',
            'fornecedores_id.required' => 'Selecione o fornecedor do bloco',
            'observacoes_id.required' => 'Selecione pelo menos uma observação',
        ];
    }
}
