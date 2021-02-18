<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItensChapasSerradasRequest extends FormRequest
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
            'chapas_serradas_id' => ['required'],
            'qtd' => ['required', 'min:1'],
            'numeracao_inicial' => ['required'],
            'comprimento' => ['required', 'max:191'],
            'altura' => ['required', 'max:191'],
            'espessuras_chapas_id' => ['required', 'max:191']
        ];
    }

    public function messages()
    {
        return [
            'qtd.required' => 'Informe a quantidade de chapas',
            'qtd.min' => 'Informe um valor maior que zero',
            'numeracao_inicial.required' => 'Informe a numeração inicial',
            'comprimento.required' => 'Informe o comprimento',
            'altura.required' => 'Informe a altura',
            'espessuras_chapas_id.required' => 'Selecione a espessura das chapas'
        ];
    }
}
