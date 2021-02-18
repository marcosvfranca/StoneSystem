<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessosRequest extends FormRequest
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
            'nome' => 'required|string|max:191',
            'exige_material' => 'required',
            'ultimo_processo' => 'required',
            'selecionar_materiais' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Informe o nome do processo',
            'nome.string' => 'Informe o nome do processo',
            'nome.max' => 'Informe o nome do processo',
            'tipo_material_processos.required' => 'Selecione pelo menos um material',
        ];
    }
}
