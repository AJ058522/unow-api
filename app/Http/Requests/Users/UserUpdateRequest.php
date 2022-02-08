<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'nullable|string|max:191',
            'last_name' => 'nullable|string|max:191',
            'telephone' => 'nullable|string|max:191',
            'rfc' => 'nullable|string|max:191',
            'address' => 'nullable|string|max:500',
            'contact_name' => 'nullable|string|max:191',
            'role_id' => 'nullable|numeric',
            'status' => 'nullable|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'boolean'       => 'El campo :attribute debe ser del tipo booleano.',
            'max'       => 'El campo :attribute excede el límite de :max caracteres.',
            'required' => 'El campo :attribute es obligatorio.',
            'string'    => 'El campo :attribute debe ser del tipo texto.'
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
            'role_id' => 'Id Rol',
            'status' => 'Estatus',
            'franchise_id' => 'Id Franquicia',
        ];
    }
}
