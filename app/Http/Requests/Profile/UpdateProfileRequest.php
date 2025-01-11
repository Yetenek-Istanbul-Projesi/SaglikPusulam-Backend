<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . auth()->id(),
            'phone' => 'sometimes|string|max:20',
            'address' => 'sometimes|string',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
