<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'search' => [/* 'bail', 'required', 'min:1', */ 'max:120'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            /* 'search.required' => 'Введите поисковый запрос.',
            'search.min' => 'Количество символов запроса ":input" должно быть больше, чем :min.', */
            'search.max' => 'Количество символов запроса ":input" должно быть меньше, чем :max.',
        ];
    }
}
