<?php

namespace App\Http\Requests\task;

use Illuminate\Foundation\Http\FormRequest;

class storeUserTasks extends FormRequest
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
    public function rules(): array
    {
        return [
            "title" => 'required',
            "description" => '',
            "expiration_date" => '',
            "state_id" => 'integer'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Se requiere un título',
        ];
    }

}
