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
            'numeracao_pedreira' => ['required'],
            'nosso_numero' => ['required'],
            'comprimento_bruto' => ['required'],
            'altura_bruta' => ['required'],
            'largura_bruta' => ['required'],
            'comprimento_liquido' => ['required'],
            'altura_liquida' => ['required'],
            'largura_liquida' => ['required'],
            'transportadores_id' => ['required'],
            'tipos_blocos_id' => ['required'],
            'classificacoes_blocos_id' => ['required'],
            'fornecedores_id' => ['required'],
            'observacoes_id' => ['required'],
            'nf_chegada' => ['required'],
            'dt_nf_chegada' => ['required', 'date'],
            'nf_compra' => ['required'],
            'dt_nf_compra' => ['required', 'date']
        ];
    }

    public function messages()
    {
        return [
            'numeracao_pedreira.required' => 'Informe o número de pedreira',
            'nosso_numero.required' => 'Informe o nosso número',
            'comprimento_bruto.required' => 'Informe o comprimento bruto do bloco',
            'altura_bruta.required' => 'Informe a altura bruta do bloco',
            'largura_bruta.required' => 'Informe a largura bruta do bloco',
            'comprimento_liquido.required' => 'Informe o comprimento líquido do bloco',
            'altura_liquida.required' => 'Informe a altura líquida do bloco',
            'largura_liquida.required' => 'Informe a largura líquida do bloco',
            'transportadores_id.required' => 'Selecione o transportador do bloco',
            'tipos_blocos_id.required' => 'Selecione o material do bloco',
            'classificacoes_blocos_id.required' => 'Selecione a classificação do bloco',
            'fornecedores_id.required' => 'Selecione o fornecedor do bloco',
            'observacoes_id.required' => 'Selecione pelo menos uma observação',
            'nf_chegada.required' => 'Informe a NF de chegada',
            'dt_nf_chegada.required' => 'Informe a data da NF de chegada',
            'dt_nf_chegada.date' => 'Valor inválido',
            'nf_compra.required' => 'Informe a NF de compra',
            'dt_nf_compra.required' => 'Informe a data da NF de compra',
            'dt_nf_compra.date' => 'Valor inválido'
        ];
    }
}
