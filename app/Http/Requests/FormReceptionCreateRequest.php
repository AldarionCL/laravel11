<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormReceptionCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'document' => [ 'required', 'integer' ],
            'invoice' => [ 'required', 'mimes:jpg,png,pdf', 'max:5000' ],
            'received.*' => [ 'required', 'numeric' ]
        ];
    }

    public function messages()
    {
        return  [
        'document.required' => 'Este campo es obligatorio',
        'document.integer' => 'Este campo debe ser un numero',
        'invoice.required' => 'Este campo es obligatorio',
        'invoice.mimes' => 'El tipo de archivo debe ser jpg,png,pdf',
        'invoice.max' => 'El archivo debe tener como tamaño maximo 5MB',
        'received.*.required' => 'Este campo es obligatorio',
        'received.*.numeric' => 'Debe ser un numero',
    ];
    }
}
