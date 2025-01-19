<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HealthFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'rating' => 'nullable|numeric|min:1|max:5',
            'distance' => 'nullable|integer|min:1|max:10',
            'is_open' => 'nullable|boolean',
            'services' => 'nullable|array',
            'services.*' => 'string'
        ];
    }

    public function messages(): array
    {
        return [
            'rating.numeric' => 'Puan sayısal bir değer olmalıdır',
            'rating.min' => 'Puan en az 1 olmalıdır',
            'rating.max' => 'Puan en fazla 5 olmalıdır',
            'distance.integer' => 'Mesafe tam sayı olmalıdır',
            'distance.min' => 'Mesafe en az 1 km olmalıdır',
            'distance.max' => 'Mesafe en fazla 10 km olmalıdır',
            'is_open.boolean' => 'Açık/Kapalı değeri geçerli bir boolean olmalıdır',
            'services.array' => 'Hizmetler bir dizi olmalıdır',
            'services.*.string' => 'Hizmet değerleri metin olmalıdır'
        ];
    }
    protected function prepareForValidation()
    {
        if ($this->has('is_open')) {
            $this->merge([
                'is_open' => filter_var($this->is_open, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)
            ]);
        }
    }
}
