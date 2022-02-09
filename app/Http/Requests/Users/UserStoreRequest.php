<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|email|unique:users',
            'job' => 'required|string|max:191',
            'birthday' => 'required|string|max:191',
            'estatus' => 'nullable|numeric',
            'password' => 'required|confirmed|string|max:191',
            'password_confirmation' => 'required|string|max:191',
        ];
    }

    public function messages(): array
    {
        return [
            'confirmed' => 'El campo :attribute no coincide con la confirmación de :attribute.',
            'email' => 'El campo :attribute debe ser del tipo email.',
            'max' => 'El campo :attribute excede el límite de :max caracteres.',
            'numeric' => 'El campo :attribute debe ser numérico.',
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser del tipo texto.',
            'unique' => 'El :attribute ya se encuentra registrado.'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nombres',
            'last_name' => 'Apellidos',
            'email' => 'Email',
            'job' => 'Puesto de trabajo',
            'birthday' => 'Fecha de nacimiento',
            'estatus' => 'Estatus',
            'password' => 'Contraseña',
            'password_confirmation' => 'Confirmación de Contraseña',
        ];
    }
}
