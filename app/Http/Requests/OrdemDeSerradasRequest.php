<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdemDeSerradasRequest extends FormRequest
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
            'blocos_brutos_id' => ['required'],
            'espessuras_chapas_id' => ['required'],
            'observacoes' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'blocos_brutos_id.required' => 'Selecione o bloco',
            'espessuras_chapas_id.required' => 'Selecione a espessura',
            'observacoes.string' => 'Valor inválido para o campo observações',
        ];
    }

}
