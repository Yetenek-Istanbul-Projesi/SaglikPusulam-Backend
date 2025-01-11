<?php

namespace App\Traits;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\JsonResponse;

trait HasBreadcrumbs
{
    /**
     * API yanıtına breadcrumb bilgilerini ekler
     */
    protected function addBreadcrumbs(array $data, string $route, array $params = []): JsonResponse
    {
        // Breadcrumb'ları al
        $breadcrumbs = [];
        if (Breadcrumbs::exists($route)) {
            $breadcrumbs = Breadcrumbs::generate($route, ...$params)->toArray();
            
            // Her bir breadcrumb için gerekli bilgileri düzenle
            $breadcrumbs = array_map(function ($breadcrumb) {
                return [
                    'title' => $breadcrumb->title,
                    'url' => $breadcrumb->url
                ];
            }, $breadcrumbs);
        }

        // Yanıta breadcrumb'ları ekle
        return response()->json([
            'data' => $data,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
