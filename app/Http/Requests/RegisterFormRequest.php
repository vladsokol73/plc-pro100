<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guest();
    }

    //Валидация
    public function rules(): array
    {
        return [
            "email" => ["required", "email:dns", " min:8", " max:40", " unique:users"],
            "name" => ["required", "min:2, max:20"],
            "password" => ["required", " min:8, max:30"],
            'password_confirmation' => ["required", 'same:password']
        ];
    }

    //Кастомные сообщения
    public function messages()
    {
        return [
            'email.required' => 'Почта пуста',
            'name.required' => 'Имя пусто',
            'password.required' => 'Пароль пуст',
            'password_confirmation.required' => 'Повторный пароль пуст',
            'email.email:dns' => 'Не правильный формат почты',
            'email.min' => 'Почта должна быть не менее 8 символов',
            'email.max' => 'Почта должна быть не более 40 символов',
            'email.unique' => 'Такой пользователь уже есть',
            'name.min' => 'Не менее 2 символов',
            'name.max' => 'Не более 20 символов',
            'password.min' => 'Не менее 8 символов',
            'password.max' => 'Не более 30 символов',
            'password_confirmation.same' => 'Пароли не совпадают',
        ];
    }
}
