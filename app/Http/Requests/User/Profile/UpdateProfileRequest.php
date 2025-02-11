<?php

namespace App\Http\Requests\User\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['sometimes', 'string', 'max:255'],
            'last_name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'unique:users,email,' . auth()->id()],
            'phone' => ['sometimes', 'string', 'unique:users,phone,' . auth()->id()],
            'address' => ['sometimes', 'string', 'max:1000'],
            'profile_photo' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.string' => 'Ad alanı metin formatında olmalıdır.',
            'first_name.max' => 'Ad alanı en fazla 255 karakter olabilir.',
            'last_name.string' => 'Soyad alanı metin formatında olmalıdır.',
            'last_name.max' => 'Soyad alanı en fazla 255 karakter olabilir.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.unique' => 'Bu e-posta adresi başka bir kullanıcı tarafından kullanılmaktadır.',
            'phone.string' => 'Telefon numarası metin formatında olmalıdır.',
            'phone.unique' => 'Bu telefon numarası başka bir kullanıcı tarafından kullanılmaktadır.',
            'address.string' => 'Adres alanı metin formatında olmalıdır.',
            'address.max' => 'Adres alanı en fazla 1000 karakter olabilir.',
            'profile_photo.image' => 'Profil fotoğrafı bir resim dosyası olmalıdır.',
            'profile_photo.mimes' => 'Profil fotoğrafı jpeg, png, jpg veya gif formatında olmalıdır.',
            'profile_photo.max' => 'Profil fotoğrafı en fazla 2MB olabilir.',
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
