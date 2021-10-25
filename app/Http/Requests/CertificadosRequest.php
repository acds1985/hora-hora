<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificadosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titulo' => ['required', 'min:5'],
            'horas' => ['required','numeric'],
            'tipo' => ['required'],
            'path' => ['required','mimes:pdf,doc,docx,png,jpg,jpeg','max:2048']
        ];
    }
}
