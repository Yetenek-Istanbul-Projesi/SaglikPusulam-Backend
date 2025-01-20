<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\HealthSearchService;
use App\Services\HealthDetailsService;
use App\Models\HealthPlace;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HealthDetailsController extends Controller
{
    public function __construct(
        private readonly HealthSearchService $healthSearchService,
        private readonly HealthDetailsService $healthDetailsService
    ) {}

    public function findSearchInResults(Request $request): JsonResponse
    {
        $placeId = $request->input('place_id');
        
        if (!$placeId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Place ID gereklidir.'
            ], 400);
        }

        try {
            $result = $this->healthSearchService->findPlaceInResults($placeId);
            return response()->json([
                'status' => 'success',
                'data' => $result,
                'message' => 'Hizmet detayları başarıyla getirildi'
            ]);
        } catch (\RuntimeException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function findInDatabase(Request $request): JsonResponse
    {
        $placeId = $request->input('place_id');
        
        if (!$placeId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Place ID gereklidir.'
            ], 400);
        }

        try {
            $result = $this->healthDetailsService->findPlaceDetails($placeId);
            return response()->json([
                'status' => 'success',
                'data' => $result,
                'message' => 'Hizmet detayları başarıyla getirildi'
            ]);
        } catch (\RuntimeException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hizmet detayları getirilirken bir hata oluştu'
            ], 500);
        }
    }
}