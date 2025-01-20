<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // JWT middleware zaten kontrol ediyor
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $rating = $this->input('rating');
        if (is_string($rating)) {
            // Sadece sayısal karakterleri al
            $rating = preg_replace('/[^0-9]/', '', $rating);
            // Boş string veya geçersiz değer için varsayılan 1
            $rating = $rating === '' ? 1 : (int) $rating;
            // 1-5 aralığına zorla
            $rating = max(1, min(5, $rating));
            
            $this->merge([
                'rating' => $rating
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'is_anonymous' => 'boolean'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'comment.required' => 'Yorum alanı zorunludur.',
            'comment.max' => 'Yorum en fazla 1000 karakter olabilir.',
            'rating.required' => 'Puanlama zorunludur.',
            'rating.integer' => 'Puanlama tam sayı olmalıdır.',
            'rating.min' => 'Puanlama en az 1 olabilir.',
            'rating.max' => 'Puanlama en fazla 5 olabilir.',
            'is_anonymous.boolean' => 'Anonim seçeneği geçersiz.'
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'Validasyon hatası.',
            'errors' => $validator->errors()
        ], 422));
    }
}
