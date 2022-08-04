<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'postTitle' => 'bail|required|min:1|max:120',
            'postContent' => 'bail|required|min:1|max:30000',
            'postImage' => 'bail|image|min:1|max:1024', // |required
            'postCheck' => 'required',
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
            'postTitle.required' => 'Введите заголовок.',
            'postTitle.min' => 'Количество символов заголовка ":input" должно быть больше, чем :min.',
            'postTitle.max' => 'Количество символов заголовка ":input" должно быть меньше, чем :max.',
            'postContent.required' => 'Введите содержимое поста.',
            'postContent.min' => 'Количество символов содержимого поста ":input" должно быть больше, чем :min.',
            'postContent.max' => 'Количество символов содержимого поста ":input" должно быть меньше, чем :max.',
            // 'postImage.required' => 'Пожалуйста, добавьте картинку',
            'postImage.image' => 'Пожалуйста, добавьте именно картинку, у выбранного файла неверное расширение',
            'postImage.min' => 'Количество символов пути к картинке ":input" должно быть больше, чем :min.',
            'postImage.max' => 'Количество символов пути к картинке ":input" должно быть меньше, чем :max.',
            'postCheck.required' => 'Необходимо согласиться с правилами сайта.',
        ];
    }
}
