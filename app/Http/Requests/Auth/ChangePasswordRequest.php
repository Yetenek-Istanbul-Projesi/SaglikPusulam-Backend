<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|different:current_password',
            'new_password_confirmation' => 'required|string|same:new_password'
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Mevcut şifre alanı zorunludur',
            'new_password.required' => 'Yeni şifre alanı zorunludur',
            'new_password.min' => 'Yeni şifre en az 8 karakter olmalıdır',
            'new_password.different' => 'Yeni şifre mevcut şifreden farklı olmalıdır',
            'new_password_confirmation.same' => 'Şifre tekrarı eşleşmiyor'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new ValidationException($validator, response()->json([
            'status' => 'error',
            'message' => 'Validasyon hatası',
            'errors' => $validator->errors()
        ], 422));
    }
}
