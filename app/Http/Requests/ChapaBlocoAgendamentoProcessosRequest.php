<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChapaBlocoAgendamentoProcessosRequest extends FormRequest
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
            'agendamento_processo_id' => 'required',
            'chapas_bloco' => 'required|array',
            'tipos_materiais' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'agendamento_processo_id.required' => 'Agendamento inválido',
            'chapas_bloco.required' => 'Selecione pelo menos 1 chapa para o agendamento',
            'chapas_bloco.array' => 'Tipo de dado inválido para as chapas',
            'tipos_materiais.required' => 'Selecione pelo menos um material',
            'tipos_materiais.array' => 'Tipo de dado inválido para os materiais'
        ];
    }


}
