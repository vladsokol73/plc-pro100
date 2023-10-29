<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->guest();
    }

    //Валидация
    public function rules(): array
    {
        return [
            "email" => ["required", "email:dns", "min:5, max:15"],
            "password" => ["required", "min:8, max:30"]
        ];
    }
}
