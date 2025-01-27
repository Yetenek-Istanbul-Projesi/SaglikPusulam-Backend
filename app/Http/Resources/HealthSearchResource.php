<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HealthSearchResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'success' => true,
            'data' => [
                'results' => $this->resource['results'],
                'total' => $this->resource['total'],
                'meta' => $this->resource['meta'] ?? []
            ]
        ];
    }
}
