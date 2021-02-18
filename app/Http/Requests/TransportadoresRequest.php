<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransportadoresRequest extends FormRequest
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
            'nome' => 'required|max:191',
            'placa' => 'required|max:191'
        ];
    }

    public function messages()
    {
        return [
            '*.required'=> 'Preenchimento obrigatório',
            '*.max' => 'Digite no máximo 191 caracteres'
        ];
    }
}
