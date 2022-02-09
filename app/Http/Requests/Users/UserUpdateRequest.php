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
            'name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'job' => 'required|string|max:191',
            'birthday' => 'required|string|max:191',
            'estatus' => 'nullable|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'confirmed' => 'El campo :attribute no coincide con la confirmación de :attribute.',
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
            'job' => 'Puesto de trabajo',
            'birthday' => 'Fecha de nacimiento',
            'estatus' => 'Estatus',
        ];
    }
}
