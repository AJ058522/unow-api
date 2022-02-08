<?php

namespace App\Http\Requests\Autentication;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|string|max:191',
            'password' => 'required|string|max:191',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'string'    => 'El campo :attribute debe ser del tipo texto.'
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'Contraseña'
        ];
    }

}
