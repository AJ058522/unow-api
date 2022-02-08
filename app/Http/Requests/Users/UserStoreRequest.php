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
            'telephone' => 'nullable|string|max:191',
            'rfc' => 'nullable|string|max:191',
            'address' => 'nullable|string|max:500',
            'contact_name' => 'nullable|string|max:191',
            'password' => 'required|confirmed|string|max:191',
            'password_confirmation' => 'required|string|max:191',
            'role_id' => 'required|numeric',
            'status' => 'nullable|numeric',
            'franchise_id' => 'nullable|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'boolean' => 'El campo :attribute debe ser del tipo booleano.',
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
            'name' => 'Nombre',
            'last_name' => 'Apellido',
            'telephone' => 'Teléfono',
            'rfc' => 'RFC',
            'address' => 'Dirección',
            'contact_name' => 'Nombre de Contacto',
            'password' => 'Contraseña',
            'password_confirmation' => 'Confirmación de Contraseña',
            'role_id' => 'Id Rol',
            'status' => 'Estatus',
            'franchise_id' => 'Id Franquicia',
        ];
    }
}
