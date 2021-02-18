<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlocosRequest extends FormRequest
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
            'numeracao' => 'required|max:191',
            'transportadores_id' => 'required',
            'tipos_blocos_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'numeracao.required' => 'Preencha a numerção do bloco',
            'numeracao.max' => 'Numeração maior que 191 caracteres',
            'transportadores_id.required' => 'Selecione o transportador',
            'tipos_blocos_id.required' => 'Selecione a classificação do bloco'
        ];
    }

}
