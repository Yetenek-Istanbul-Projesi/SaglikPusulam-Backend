<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comment' => 'sometimes|required|string|max:1000',
            'rating' => 'sometimes|required|integer|min:1|max:5',
            'is_anonymous' => 'sometimes|required|boolean'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'comment.required' => 'Yorum alanı zorunludur.',
            'comment.string' => 'Yorum metni geçerli bir metin olmalıdır.',
            'comment.max' => 'Yorum en fazla 1000 karakter olabilir.',
            'rating.required' => 'Puan alanı zorunludur.',
            'rating.integer' => 'Puan tam sayı olmalıdır.',
            'rating.min' => 'Puan en az 1 olmalıdır.',
            'rating.max' => 'Puan en fazla 5 olabilir.',
            'is_anonymous.boolean' => 'Anonim alanı geçerli bir boolean değer olmalıdır.'
        ];
    }
}
