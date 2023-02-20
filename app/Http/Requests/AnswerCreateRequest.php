<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Comments;

class AnswerCreateRequest extends FormRequest
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
            'name' => 'required|min:3',
            'text' => 'required',
            'comments_id' =>  [Rule::exists(Comments::class, 'id')]

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Имя написать обязателно',
            'text.required' => 'Коменария написать обязателно',
            'name.min' => 'Имя должно быть больше 3 буков',
        ];
    }
}
