<?php

namespace App\Services\Service;

use App\Models\User;
use App\Models\Service;
use App\Models\Review;
use App\DTOs\Service\ServiceDTO;
use App\DTOs\Service\ReviewDTO;
use App\DTOs\Google\PlaceSearchDTO;
use App\DTOs\Google\PlaceDetailsDTO;
use App\Contracts\ServiceManagementInterface;
use App\Enums\ReviewSourceEnum;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class ServiceManagementService implements ServiceManagementInterface
{
    public function createService(ServiceDTO $serviceDTO): Service
    {
        $service = new Service();
        $this->fillServiceFromDTO($service, $serviceDTO);
        $service->save();
        
        return $service;
    }

    public function updateService(int $serviceId, ServiceDTO $serviceDTO): Service
    {
        $service = Service::findOrFail($serviceId);
        $this->fillServiceFromDTO($service, $serviceDTO);
        $service->save();
        
        return $service;
    }

    public function getServiceDetails(int $serviceId): ?Service
    {
        return Service::with(['photos', 'reviews.user'])
            ->findOrFail($serviceId);
    }

    public function getServiceList(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $query = Service::query()->with(['photos']);

        // Filtreleri uygula
        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['rating'])) {
            $query->where('rating', '>=', $filters['rating']);
        }

        return $query->paginate($perPage);
    }

    public function deleteService(int $serviceId): bool
    {
        $service = Service::findOrFail($serviceId);
        
        // Fotoğrafları sil
        foreach ($service->photos as $photo) {
            Storage::delete($photo->path);
            $photo->delete();
        }
        
        return $service->delete();
    }

    public function addServiceReview(int $serviceId, ReviewDTO $reviewDTO): Review
    {
        $service = Service::findOrFail($serviceId);
        
        $review = new Review();
        $review->service_id = $service->id;
        $review->user_id = auth()->id();
        $review->rating = $reviewDTO->rating;
        $review->comment = $reviewDTO->comment;
        $review->source = ReviewSourceEnum::LOCAL;
        $review->save();
        
        // Ortalama puanı güncelle
        $this->updateServiceRating($service);
        
        return $review;
    }

    public function updateServiceReview(int $reviewId, ReviewDTO $reviewDTO): Review
    {
        $review = Review::findOrFail($reviewId);
        
        // Sadece kendi yorumunu güncelleyebilir
        if ($review->user_id !== auth()->id()) {
            throw new \Exception('Unauthorized');
        }
        
        $review->rating = $reviewDTO->rating;
        $review->comment = $reviewDTO->comment;
        $review->save();
        
        // Ortalama puanı güncelle
        $this->updateServiceRating($review->service);
        
        return $review;
    }

    public function deleteServiceReview(int $reviewId): bool
    {
        $review = Review::findOrFail($reviewId);
        
        // Sadece kendi yorumunu silebilir
        if ($review->user_id !== auth()->id()) {
            throw new \Exception('Unauthorized');
        }
        
        $service = $review->service;
        $result = $review->delete();
        
        // Ortalama puanı güncelle
        $this->updateServiceRating($service);
        
        return $result;
    }

    public function syncGooglePlace(PlaceSearchDTO $place): Service
    {
        return Service::updateOrCreate(
            ['google_place_id' => $place->placeId],
            [
                'name' => $place->name,
                'description' => $place->description,
                'address' => $place->address,
                'latitude' => $place->latitude,
                'longitude' => $place->longitude,
                'rating' => $place->rating,
                'review_count' => $place->userRatingsTotal,
                'is_open_now' => $place->isOpenNow,
                'photo_references' => $place->photoReferences,
                'facility_type' => $place->facilityType?->value,
                'type' => $place->facilityType?->value ?? 'other'
            ]
        );
    }

    public function syncGooglePlaceDetails(PlaceDetailsDTO $details): Service
    {
        $service = Service::updateOrCreate(
            ['google_place_id' => $details->placeId],
            [
                'name' => $details->name,
                'address' => $details->address,
                'phone' => $details->phoneNumber,
                'website' => $details->website,
                'place_url' => $details->placeUrl,
                'latitude' => $details->latitude,
                'longitude' => $details->longitude,
                'rating' => $details->rating,
                'review_count' => $details->userRatingsTotal,
                'is_open_now' => $details->isOpenNow,
                'opening_hours' => $details->openingHours,
                'photo_references' => $details->photoReferences,
                'description' => $details->description,
                'facility_type' => $details->facilityType?->value
            ]
        );

        // Google yorumlarını senkronize et
        if (!empty($details->reviews)) {
            $this->syncGoogleReviews($service, $details->reviews);
        }

        return $service->load(['photos', 'reviews.user']);
    }

    public function syncGoogleReviews(Service $service, array $googleReviews): void
    {
        foreach ($googleReviews as $review) {
            $user = User::firstOrCreate(
                ['email' => $review['author_name'] . '@google.review'],
                [
                    'name' => $review['author_name'],
                    'password' => Hash::make(Str::random(16)),
                    'profile_photo_url' => $review['profile_photo_url'] ?? null
                ]
            );

            Review::updateOrCreate(
                [
                    'service_id' => $service->id,
                    'user_id' => $user->id,
                    'source' => ReviewSourceEnum::GOOGLE,
                    'source_review_time' => Carbon::createFromTimestamp($review['time'])
                ],
                [
                    'rating' => $review['rating'],
                    'comment' => $review['text'],
                    'source_review_id' => $review['time'] . '_' . $user->id
                ]
            );
        }
    }

    private function fillServiceFromDTO(Service $service, ServiceDTO $dto): void
    {
        $service->name = $dto->name;
        $service->description = $dto->description;
        $service->address = $dto->address;
        $service->phone = $dto->phone;
        $service->website = $dto->website;
        $service->latitude = $dto->latitude;
        $service->longitude = $dto->longitude;
        $service->facility_type = $dto->facilityType;
    }

    private function updateServiceRating(Service $service): void
    {
        $avgRating = $service->reviews()->avg('rating');
        $reviewCount = $service->reviews()->count();
        
        $service->rating = $avgRating;
        $service->review_count = $reviewCount;
        $service->save();
    }
}
