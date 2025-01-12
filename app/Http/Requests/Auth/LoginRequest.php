<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['nullable', 'email', 'required_without:phone'],
            'phone' => ['nullable', 'string', 'required_without:email'],
            'password' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.required_without' => 'E-posta veya telefon numarasından birini girmelisiniz.',
            'phone.required_without' => 'E-posta veya telefon numarasından birini girmelisiniz.',
            'password.required' => 'Şifre alanı zorunludur.',
        ];
    }
}
