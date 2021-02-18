<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChapasBlocosRequest extends FormRequest
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
            'comprimento' => 'required',
            'largura' => 'required',
            'numeracao' => 'required',
            'espessuras_chapas_id' => 'required',
            'estadosChapa' => 'required',
            'observacoesChapa' => 'required',
            'qtd' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'comprimento.required' => 'Preencha o comprimento',
            'largura.required' => 'Preencha a altura',
            'numeracao.required' => 'Preencha a numeração',
            'espessuras_chapas_id.required' => 'Selecione a espessura da chapa',
            'estadosChapa.required' => 'Selecione o estado da chapa',
            'observacoesChapa.required' => 'Selecione a qualidade da serrada',
            'qtd.required' => 'Informe a quantidade'
        ];
    }
}
