<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Burada kullanıcıdan gelen verilerin doğruluğunu kontrol ediyoruz
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms_accepted' => ['required', 'boolean', 'accepted'],
            'privacy_accepted' => ['required', 'boolean', 'accepted'],
        ];
    }

    public function messages(): array
    {
        // Burada doğrulama hatalarının mesajlarını belirliyoruz
        return [
            'first_name.required' => 'Ad alanı zorunludur.',
            'last_name.required' => 'Soyad alanı zorunludur.',
            'email.required' => 'E-posta alanı zorunludur.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'phone.required' => 'Telefon numarası alanı zorunludur.',
            'password.required' => 'Şifre alanı zorunludur.',
            'password.min' => 'Şifre en az 8 karakter olmalıdır.',
            'password.confirmed' => 'Şifre tekrarı eşleşmiyor.',
            'terms_accepted.accepted' => 'Kullanım koşullarını kabul etmelisiniz.',
            'privacy_accepted.accepted' => 'Gizlilik politikasını kabul etmelisiniz.',
        ];
    }

    protected function prepareForValidation()
    {
        // Form-data ile gelen boolean değerleri uygun formata dönüştürme
        $this->merge([
            'terms_accepted' => filter_var($this->terms_accepted, FILTER_VALIDATE_BOOLEAN),
            'privacy_accepted' => filter_var($this->privacy_accepted, FILTER_VALIDATE_BOOLEAN),
        ]);
    }
}
