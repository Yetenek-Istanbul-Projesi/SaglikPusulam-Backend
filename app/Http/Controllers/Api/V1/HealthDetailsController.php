<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\HealthSearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HealthDetailsController extends Controller
{
    public function __construct(
        private readonly HealthSearchService $healthSearchService
    ) {}

    public function findSearchInResults(Request $request): JsonResponse
    {
        $placeId = $request->input('place_id');
        
        if (!$placeId) {
            return response()->json(['error' => 'Place ID gereklidir.'], 400);
        }

        try {
            $result = $this->healthSearchService->findPlaceInResults($placeId);
            return response()->json(['data' => $result]);
        } catch (\RuntimeException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}