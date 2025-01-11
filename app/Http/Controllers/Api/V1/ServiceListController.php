<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\Service\ServiceListDTO;
use App\Http\Controllers\Controller;
use App\Services\ServiceListService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceListController extends Controller
{
    private ServiceListService $serviceListService;

    public function __construct(ServiceListService $serviceListService)
    {
        $this->serviceListService = $serviceListService;
    }

    // Favori listesine ekleme
    public function addToFavorites(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'service_id' => 'required|integer|exists:services,id'
        ]);

        try {
            $result = $this->serviceListService->addToFavorites(
                ServiceListDTO::fromRequest($validated)
            );

            return response()->json([
                'status' => 'success',
                'message' => $result['message'],
                'data' => $result['favorite']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    // Karşılaştırma listesine ekleme
    public function addToComparisons(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'service_id' => 'required|integer|exists:services,id'
        ]);

        try {
            $result = $this->serviceListService->addToComparisons(
                ServiceListDTO::fromRequest($validated)
            );

            return response()->json([
                'status' => 'success',
                'message' => $result['message'],
                'data' => $result['comparison']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    // Favori listesinden çıkarma
    public function removeFromFavorites(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'service_id' => 'required|integer|exists:services,id'
        ]);

        try {
            $result = $this->serviceListService->removeFromFavorites(
                ServiceListDTO::fromRequest($validated)
            );

            return response()->json([
                'status' => 'success',
                'message' => $result['message']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    // Karşılaştırma listesinden çıkarma
    public function removeFromComparisons(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'service_id' => 'required|integer|exists:services,id'
        ]);

        try {
            $result = $this->serviceListService->removeFromComparisons(
                ServiceListDTO::fromRequest($validated)
            );

            return response()->json([
                'status' => 'success',
                'message' => $result['message']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    // Favori listesini getirme
    public function getFavorites(): JsonResponse
    {
        $result = $this->serviceListService->getFavorites();

        return response()->json([
            'status' => 'success',
            'data' => $result['favorites']
        ]);
    }

    // Karşılaştırma listesini getirme
    public function getComparisons(): JsonResponse
    {
        $result = $this->serviceListService->getComparisons();

        return response()->json([
            'status' => 'success',
            'data' => $result['comparisons']
        ]);
    }
}
