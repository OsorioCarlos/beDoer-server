<?php

namespace App\Http\Requests\UserRequest;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:5|max:40',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:7'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Se requiere un nombre',
            'name.min' => 'Mínimo 5 caracteres',
            'name.max' => 'Máximo  40 caracteres',
            'email.required' => 'Se requiere un email',
            'password.required' => 'Se requiere una contraseña',
            'password.min' => 'Mínimo 7 caracteres'
        ];
    }

}
