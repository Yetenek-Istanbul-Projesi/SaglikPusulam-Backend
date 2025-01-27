<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\HealthSearchService;
use App\Contracts\Services\HealthDetailsServiceInterface;
use App\Contracts\Services\ReviewServiceInterface;
use App\Http\Requests\AddReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\HealthPlace;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

/**
 * Sağlık hizmeti detayları işlemleri
 */
class HealthDetailsController extends Controller
{
    public function __construct(
        private readonly HealthSearchService $healthSearchService,
        private readonly HealthDetailsServiceInterface $healthDetailsService,
        private readonly ReviewServiceInterface $reviewService
    ) {}

    /**
     * Sağlık hizmeti arama sonuçlarında arama yap
     */
    public function findSearchInResults(Request $request): JsonResponse
    {
        $placeId = $request->input('placeId');
        if (empty($placeId)) {
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
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Sağlık hizmeti detaylarını getir
     */
    public function findPlaceDetails(Request $request): JsonResponse
    {
        $placeId = $request->input('placeId');
        if (empty($placeId)) {
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

    /**
     * Kullanıcının yorumlarını getir
     */
    public function getUserReviews(Request $request): JsonResponse
    {
        try {
            $token = $request->bearerToken();
            
            if (!$token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token bulunamadı'
                ], 401);
            }

            try {
                $user = \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();
                if (!$user) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Geçersiz token'
                    ], 401);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token doğrulanamadı'
                ], 401);
            }
    
            $page = (int) $request->input('page', 1);
            $perPage = (int) $request->input('per_page', 10);
            
            $result = $this->reviewService->getUserReviews($page, $perPage);
            
            return response()->json([
                'status' => 'success',
                'data' => $result['data'],
                'meta' => $result['meta']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Yorum sil
     */
    public function deleteReview(string $placeId): JsonResponse
    {
        try {
            $this->reviewService->deleteReview($placeId);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Yorum başarıyla silindi.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Yorumları getir
     */
    public function getReviews(Request $request, string $placeId): JsonResponse
    {
        try {
            $page = (int) $request->input('page', 1);
            $perPage = (int) $request->input('per_page', 10);
            
            $result = $this->reviewService->getReviews($placeId, $page, $perPage);
            
            return response()->json([
                'status' => 'success',
                'data' => $result->toArray()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Yorum ekle
     */
    public function addReview(AddReviewRequest $request, string $placeId): JsonResponse
    {
        try {
            $review = $this->reviewService->addReview($placeId, $request->validated());
            
            return response()->json([
                'status' => 'success',
                'message' => 'Yorumunuz başarıyla eklendi.',
                'review' => $review
            ]);
        } catch (AuthenticationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Oturum süreniz dolmuş. Lütfen tekrar giriş yapın.'
            ], 401);
        } catch (\Exception $e) {
            
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Yorumu güncelle
     */
    public function updateReview(UpdateReviewRequest $request, string $placeId): JsonResponse
    {
        try {
            $result = $this->reviewService->updateReview($placeId, $request->validated());
            
            return response()->json([
                'status' => 'success',
                'message' => 'Yorumunuz basariyla güncellendi.',
                'data' => $result->toArray()
            ]);
        } catch (AuthenticationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Yorum yapabilmek için giriş yapmalısınız.'
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * En çok favoriye alınan sağlık hizmetlerini getir
     */
    public function getMostFavorited(): JsonResponse
    {
        try {
            $mostFavorited = $this->healthDetailsService->getMostFavoritedPlaces();
            
            return response()->json([
                'status' => 'success',
                'data' => $mostFavorited
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}