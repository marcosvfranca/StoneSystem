<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MotivosRequest extends FormRequest
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
            'motivo' => 'required|string|max:191'
        ];
    }

    public function messages()
    {
        return  [
            'motivo.required' => 'Informe o motivo',
            'motivo.string' => 'Conteúdo invalido para o motivo',
            'motivo.max' => 'Tamanho máximo excedido'
        ];
    }
}
