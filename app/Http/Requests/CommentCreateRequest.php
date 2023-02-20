<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentCreateRequest extends FormRequest
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
            'name' => 'required|min:3|unique:comments',
            'text' => 'required'
        ];

        
    }

    public function messages()
    {
        return [
            'name.required' => 'Имя написать обязателно',
            'text.required' => 'Коменария написать обязателно',
            'name.min' => 'Имя должно быть больше 3 буков',
            'name.unique' => 'Имя должно быть уникалний',
        ];
    }
}
