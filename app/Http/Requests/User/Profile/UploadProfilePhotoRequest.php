<?php

namespace App\Http\Requests\User\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UploadProfilePhotoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ];
    }

    public function messages(): array
    {
        return [
            'photo.required' => 'Profil fotoğrafı gereklidir.',
            'photo.image' => 'Yüklenen dosya bir resim olmalıdır.',
            'photo.mimes' => 'Profil fotoğrafı jpeg, png, jpg veya gif formatında olmalıdır.',
            'photo.max' => 'Profil fotoğrafı en fazla 2MB olabilir.'
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
