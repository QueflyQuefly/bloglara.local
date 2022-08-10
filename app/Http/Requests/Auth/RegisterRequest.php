<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'check' => ['required'],
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
            'name.required' => 'Введите имя и фамилию.',
            'name.string' => 'Имя и фамилия должны быть строкой.',
            'name.max' => 'Количество символов ":input" должно быть меньше, чем :max.',
            'email.required' => 'Введите email.',
            'email.string' => 'Email должна быть строкой.',
            'email.email' => 'Введенная вами почта не соответсвует действительному адресу email.',
            'email.unique' => 'Пользователь с таким email уже зарегистрирован.',
            'email.max' => 'Количество символов email ":input" должно быть меньше, чем :max символов.',
            'password.required' => 'Введите пароль.',
            'password.confirmed' => 'Пароли не совпадают.',
            'password.min' => 'Количество символов пароля должно быть больше, чем :min символов.',
            'check.required' => 'Необходимо согласиться с правилами сайта.',
        ];
    }
}
