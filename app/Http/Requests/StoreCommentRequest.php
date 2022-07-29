<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'commentContent' => 'bail|required|min:1|max:30000',
            'commentCheck'   => 'required',
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
            'commentContent.required' => 'Введите содержимое комментария.',
            'commentContent.min'      => 'Количество символов содержимого комментария ":input" должно быть больше, чем :min.',
            'commentContent.max'      => 'Количество символов содержимого комментария ":input" должно быть меньше, чем :max.',
            'commentCheck.required'   => 'Необходимо согласиться с правилами сайта.',
        ];
    }
}
