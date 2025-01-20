<?php

namespace App\Services;

use App\Models\HealthPlace;
use App\Models\PlaceReview;
use App\DTOs\Review\ReviewDTO;
use App\DTOs\Review\ReviewCollectionDTO;
use App\Contracts\Services\ReviewServiceInterface;
use App\Contracts\Services\GooglePlacesServiceInterface;
use App\Contracts\Repositories\HealthPlaceRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReviewService implements ReviewServiceInterface
{
    public function __construct(
        private readonly GooglePlacesServiceInterface $googlePlacesService,
        private readonly HealthPlaceRepositoryInterface $healthPlaceRepository
    ) {}

    /**
     * Yorumları sayfalı şekilde getir
     */
    public function getReviews(string $placeId, int $page = 1, int $perPage = 10): ReviewCollectionDTO
    {
        try {
            $cacheKey = "place_reviews_{$placeId}_page_{$page}_per_page_{$perPage}";
            
            return Cache::remember($cacheKey, now()->addHours(24), function () use ($placeId, $page, $perPage) {
                // Place verilerini al
                $place = $this->healthPlaceRepository->updateOrCreate(
                    ['google_place_id' => $placeId],
                    ['place_data' => $this->googlePlacesService->getPlaceDetails($placeId)]
                );
                
                // Kullanıcı yorumlarını al
                $userReviews = $this->getPlaceUserReviews($place);
                
                // Google yorumlarını al ve birleştir
                $googleReviews = $this->getGoogleReviews($place->place_data);
                $allReviews = $userReviews->concat($googleReviews)
                    ->sortByDesc('created_at');
                
                // Sayfalama yap ve istatistikleri ekle
                $paginatedReviews = $this->paginateReviews($allReviews, $page, $perPage);
                $paginatedReviews->stats = [
                    'user_reviews_count' => $userReviews->count(),
                    'google_reviews_count' => $googleReviews->count(),
                    'total_reviews_count' => $allReviews->count()
                ];
                
                return $paginatedReviews;
            });
        } catch (\Exception $e) {
            throw new \RuntimeException('Yorumlar getirilirken bir hata oluştu: ' . $e->getMessage());
        }
    }

    /**
     * Yeni yorum ekle
     */
    public function addReview(string $placeId, array $data): ReviewDTO
    {
        try {
            // Place'i bul veya oluştur
            $place = $this->healthPlaceRepository->updateOrCreate(
                ['google_place_id' => $placeId],
                ['place_data' => $this->googlePlacesService->getPlaceDetails($placeId)]
            );
            
            // Kullanıcıyı al
            $user = JWTAuth::parseToken()->authenticate();
            
            // Kullanıcının bu yere daha önce yorum yapıp yapmadığını kontrol et
            $existingReview = $place->reviews()
                ->where('user_id', $user->id)
                ->first();
                
            if ($existingReview) {
                throw new \RuntimeException('Bu yere daha önce yorum yaptınız.');
            }
            
            // Anonim kontrolü
            $isAnonymous = $data['is_anonymous'] ?? false;
            
            // Yorumu kaydet
            $review = $place->reviews()->create([
                'user_id' => $user->id,
                'health_place_id' => $place->id,
                'comment' => $data['comment'],
                'rating' => $data['rating'],
                'is_anonymous' => $isAnonymous
            ]);

            // Cache'i temizle
            $cacheKey = "place_reviews_{$placeId}_page_1_per_page_10";
            Cache::forget($cacheKey);

            // Kullanıcı adını oluştur
            $userName = $isAnonymous ? 'Anonim' : trim($user->first_name . ' ' . $user->last_name);
            if (!$isAnonymous && empty(trim($userName))) {
                $userName = 'Kullanıcı';
            }

            // DTO oluştur ve döndür
            return ReviewDTO::fromArray([
                'comment' => $review->comment,
                'rating' => $review->rating,
                'user_name' => $userName,
                'profile_photo' => $isAnonymous ? null : $user->photo,
                'created_at' => $review->created_at->format('Y-m-d H:i:s'),
                'source' => 'user',
                'is_anonymous' => $isAnonymous,
                'place_name' => $place->place_data['displayName']['text'] ?? 'Bilinmeyen Yer',
                'place_id' => $place->google_place_id
            ]);
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }

    /**
     * Yorumu güncelle
     */
    public function updateReview(string $placeId, array $data): ReviewDTO
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            
            $place = $this->healthPlaceRepository->updateOrCreate(
                ['google_place_id' => $placeId],
                ['place_data' => $this->googlePlacesService->getPlaceDetails($placeId)]
            );
            
            $review = $place->reviews()
                ->where('user_id', $user->id)
                ->first();
                
            if (!$review) {
                throw new \RuntimeException('Bu yere ait yorumunuz bulunamadı.');
            }
            
            // Anonim kontrolü
            $isAnonymous = $data['is_anonymous'] ?? $review->is_anonymous;
            
            // Yorumu güncelle
            $review->update([
                'comment' => $data['comment'] ?? $review->comment,
                'rating' => $data['rating'] ?? $review->rating,
                'is_anonymous' => $isAnonymous
            ]);

            // Cache'i temizle
            $cacheKey = "place_reviews_{$placeId}_page_1_per_page_10";
            Cache::forget($cacheKey);

            // Kullanıcı adını oluştur
            $userName = $isAnonymous ? 'Anonim' : trim($user->first_name . ' ' . $user->last_name);
            if (!$isAnonymous && empty(trim($userName))) {
                $userName = 'Kullanıcı';
            }

            // DTO oluştur ve döndür
            return ReviewDTO::fromArray([
                'comment' => $review->comment,
                'rating' => $review->rating,
                'user_name' => $userName,
                'profile_photo' => $isAnonymous ? null : $user->photo,
                'created_at' => $review->created_at->format('Y-m-d H:i:s'),
                'source' => 'user',
                'is_anonymous' => $isAnonymous,
                'place_name' => $place->place_data['displayName']['text'] ?? 'Bilinmeyen Yer',
                'place_id' => $place->google_place_id
            ]);
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }

    /**
     * Kullanıcının yorumlarını getir
     */
    public function getUserReviews(int $page = 1, int $perPage = 10): array
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            \Log::info('User ID: ' . $user->id);
            
            // İlişki kontrolü
            \Log::info('Reviews relationship class: ' . get_class($user->reviews()->getModel()));
            
            $reviews = $user->reviews()
                ->with('healthPlace')
                ->orderBy('created_at', 'desc');
                
            // SQL sorgusu
            \Log::info('Reviews SQL: ' . $reviews->toSql());
            \Log::info('Reviews bindings: ', $reviews->getBindings());
            
            $paginatedReviews = $reviews->paginate($perPage, ['*'], 'page', $page);
            
            \Log::info('Reviews count: ' . $paginatedReviews->total());
            
            $items = collect($paginatedReviews->items())->map(function ($review) {
                \Log::info('Review data:', [
                    'review_id' => $review->id,
                    'user_id' => $review->user_id,
                    'health_place_id' => $review->health_place_id,
                    'health_place' => $review->healthPlace ?? null
                ]);
                
                $userName = $review->is_anonymous ? 'Anonim' : trim($review->user->first_name . ' ' . $review->user->last_name);
                return ReviewDTO::fromArray([
                    'comment' => $review->comment,
                    'rating' => $review->rating,
                    'user_name' => $userName,
                    'profile_photo' => $review->is_anonymous ? null : $review->user->photo,
                    'created_at' => $review->created_at->format('Y-m-d H:i:s'),
                    'source' => 'user',
                    'is_anonymous' => $review->is_anonymous,
                    'place_name' => $review->healthPlace->place_data['displayName']['text'] ?? 'Bilinmeyen Yer',
                    'place_id' => $review->healthPlace->google_place_id
                ]);
            });
            
            return [
                'data' => $items,
                'meta' => [
                    'current_page' => $paginatedReviews->currentPage(),
                    'last_page' => $paginatedReviews->lastPage(),
                    'per_page' => $paginatedReviews->perPage(),
                    'total' => $paginatedReviews->total()
                ]
            ];
        } catch (\Exception $e) {
            throw new \RuntimeException('Yorumlar getirilirken bir hata oluştu: ' . $e->getMessage());
        }
    }

    /**
     * Yorum sil
     */
    public function deleteReview(string $placeId): void
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            
            $place = $this->healthPlaceRepository->updateOrCreate(
                ['google_place_id' => $placeId],
                ['place_data' => $this->googlePlacesService->getPlaceDetails($placeId)]
            );
            
            if (!$place) {
                throw new \RuntimeException('Yer bulunamadı.');
            }
            
            $review = $place->reviews()
                ->where('user_id', $user->id)
                ->first();
                
            if (!$review) {
                throw new \RuntimeException('Bu yere ait yorumunuz bulunamadı.');
            }
            
            $review->delete();
            
            // Cache'i temizle
            $cacheKey = "place_reviews_{$placeId}_page_1_per_page_10";
            Cache::forget($cacheKey);
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }

    /**
     * Google yorumlarını formatla
     */
    private function getGoogleReviews(array $placeData): Collection
    {
        $reviews = $placeData['reviews'] ?? [];
        
        return collect($reviews)->map(function ($review) {
            return ReviewDTO::fromArray([
                'comment' => $review['text']['text'] ?? '',
                'rating' => $review['rating'] ?? 0,
                'user_name' => $review['authorAttribution']['displayName'] ?? '',
                'profile_photo' => $review['authorAttribution']['photoUri'] ?? null,
                'created_at' => $review['relativePublishTimeDescription'] ?? 'şimdi',
                'source' => 'google',
                'is_anonymous' => false
            ]);
        });
    }

    /**
     * Google'dan gelen relative time string'ini timestamp'e çevir
     */
    private function relativeTimeToTimestamp(string $relativeTime): int
    {
        // Varsayılan olarak şu anki zaman
        if (empty($relativeTime)) {
            return time();
        }

        // İngilizce karşılıkları
        $translations = [
            'bir saniye önce' => '1 second ago',
            'saniye önce' => 'seconds ago',
            'bir dakika önce' => '1 minute ago',
            'dakika önce' => 'minutes ago',
            'bir saat önce' => '1 hour ago',
            'saat önce' => 'hours ago',
            'bir gün önce' => '1 day ago',
            'gün önce' => 'days ago',
            'bir hafta önce' => '1 week ago',
            'hafta önce' => 'weeks ago',
            'bir ay önce' => '1 month ago',
            'ay önce' => 'months ago',
            'bir yıl önce' => '1 year ago',
            'yıl önce' => 'years ago'
        ];

        // Sayıyı ayıkla
        preg_match('/(\d+)/', $relativeTime, $matches);
        $number = $matches[1] ?? 1;

        // Türkçe metni İngilizce'ye çevir
        $englishTime = $relativeTime;
        foreach ($translations as $tr => $en) {
            if (str_contains($relativeTime, $tr)) {
                $englishTime = $number . ' ' . $en;
                break;
            }
        }

        // Şimdiki zamandan çıkar
        return strtotime('-' . str_replace(' ago', '', $englishTime));
    }

    /**
     * Kullanıcı yorumlarını formatla
     */
    private function getPlaceUserReviews(HealthPlace $place): Collection
    {
        return $place->reviews()
            ->with('user')
            ->get()
            ->map(function ($review) use ($place) {
                $userName = $review->is_anonymous ? 'Anonim' : trim($review->user->first_name . ' ' . $review->user->last_name);
                return ReviewDTO::fromArray([
                    'comment' => $review->comment,
                    'rating' => $review->rating,
                    'user_name' => $userName,
                    'profile_photo' => $review->is_anonymous ? null : $review->user->photo,
                    'created_at' => $review->created_at->format('Y-m-d H:i:s'),
                    'source' => 'user',
                    'is_anonymous' => $review->is_anonymous,
                    'place_name' => $place->place_data['displayName']['text'] ?? 'Bilinmeyen Yer',
                    'place_id' => $place->google_place_id
                ]);
            });
    }

    /**
     * Yorumları sayfala
     */
    private function paginateReviews(Collection $reviews, int $page, int $perPage): ReviewCollectionDTO
    {
        $total = $reviews->count();
        $lastPage = max(1, ceil($total / $perPage));
        $currentPage = min($page, $lastPage);
        $offset = ($currentPage - 1) * $perPage;
        
        $items = $reviews->slice($offset, $perPage)->values();
        
        return new ReviewCollectionDTO(
            items: $items->all(),
            currentPage: $currentPage,
            lastPage: $lastPage,
            perPage: $perPage,
            total: $total
        );
    }
}
