<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendamentoProcessosRequest extends FormRequest
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
            'grupos_usuario_id' => 'required',
            'processo_id' => 'required',
            'observacoes' => ['nullable', 'string', 'max:191'],
        ];
    }

    public function messages()
    {
        return [
            'grupos_usuario_id.required' => 'Selecione o setor do agendamento',
            'processo_id.required' => 'Informe o processo que deseja agendar',
            'observacoes.string' =>  'Conteúdo inválido',
            'observacoes.max' => 'Tamanho máximo excedido para as observações'
        ];
    }
}
