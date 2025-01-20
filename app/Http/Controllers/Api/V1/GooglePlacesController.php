<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Contracts\Services\GooglePlacesServiceInterface;
use App\DTOs\Google\HealthSearchCriteriaDTO;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class GooglePlacesController extends Controller
{
    public function __construct(
        private readonly GooglePlacesServiceInterface $googlePlacesService
    ) {}

    public function search(Request $request): JsonResponse
    {
        $criteria = new HealthSearchCriteriaDTO(
            province: $request->query('province'),
            district: $request->query('district'),
            facilityType: $request->query('facility_type'),
            specialization: $request->query('specialization')
        );

        $places = $this->googlePlacesService->searchHealthFacilities($criteria);

        return response()->json([
            'success' => true,
            'data' => $places
        ]);
    }

    public function getPhotoUrl(string $photoReference): JsonResponse
    {
        if (!$photoReference) {
            return response()->json([
                'success' => false,
                'message' => 'Fotoğraf referansı bulunamadı'
            ], 400);
        }

        $url = $this->googlePlacesService->getPhotoUrl($photoReference, 400);

        return response()->json([
            'success' => true,
            'data' => [
                'url' => $url
            ]
        ]);
    }
    public function getPhoto(string $photoReference)
    {
        try {
            if (!$photoReference) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fotoğraf referansı bulunamadı'
                ], 400);
            }

            $photoData = $this->googlePlacesService->fetchPhoto($photoReference);

            // Raw binary response
            return response($photoData)
                ->withHeaders([
                    'Content-Type' => 'image/jpeg',
                    'Content-Length' => strlen($photoData),
                    'Cache-Control' => 'public, max-age=86400',
                    'X-Content-Type-Options' => 'nosniff'
                ]);

        } catch (\Exception $e) {
            \Log::error('Photo fetch error', [
                'error' => $e->getMessage(),
                'photoReference' => $photoReference
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Fotoğraf yüklenemedi: ' . $e->getMessage()
            ], 500);
        }
    }
}
