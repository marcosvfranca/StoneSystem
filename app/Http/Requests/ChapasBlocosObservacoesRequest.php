<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChapasBlocosObservacoesRequest extends FormRequest
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
            'descricao' => [
                'required'
            ],
            'apelido' => [
                'required'
            ],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Preencha este campo'
        ];
    }
}
