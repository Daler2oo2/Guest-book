<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdsCreateRequest extends FormRequest
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
            'user' => 'required|string|min:3',
            'tel' => 'required|min:9',
            'title' => 'required|string',
            'price' => 'required',
            'city' => 'required|string',
        ];
    }
}
