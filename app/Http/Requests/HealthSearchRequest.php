<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HealthSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'province' => 'required|string',
            'district' => 'nullable|string',
            'facility_type' => 'nullable|string',
            'specialization' => 'nullable|string'
        ];
    }
}
