<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GruposUsuariosRequest extends FormRequest
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
            'nome' => 'required'
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Campo obrigatório'
        ];
    }
}
