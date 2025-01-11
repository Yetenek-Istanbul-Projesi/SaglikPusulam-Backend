<?php

namespace App\Services;

use App\Contracts\Services\ServiceManagementInterface;
use App\DTOs\Service\ServiceDTO;
use App\DTOs\Service\ReviewDTO;
use App\Models\Service;
use App\Models\ServicePhoto;
use App\Models\ServiceReview;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceManagement implements ServiceManagementInterface
{
    public function listServices(array $filters = []): LengthAwarePaginator
    {
        $query = Service::with(['photos', 'reviews'])
            ->when(isset($filters['type']), fn($q) => $q->where('type', $filters['type']))
            ->when(isset($filters['is_active']), fn($q) => $q->where('is_active', $filters['is_active']))
            ->when(isset($filters['min_rating']), fn($q) => $q->where('rating', '>=', $filters['min_rating']));

        return $query->paginate(10);
    }

    public function getService(int $id): Service
    {
        return Service::with(['photos', 'reviews.user'])->findOrFail($id);
    }

    public function createService(ServiceDTO $dto): Service
    {
        return DB::transaction(function () use ($dto) {
            $service = Service::create([
                'name' => $dto->name,
                'description' => $dto->description,
                'is_active' => $dto->is_active,
                'type' => $dto->type,
                'phone' => $dto->phone,
                'website' => $dto->website,
                'working_hours' => $dto->working_hours,
                'address' => $dto->address,
                'latitude' => $dto->latitude,
                'longitude' => $dto->longitude,
                'contact_info' => $dto->contact_info
            ]);

            if ($dto->photos) {
                foreach ($dto->photos as $index => $photo) {
                    $this->uploadServicePhoto($service, $photo, $index === 0);
                }
            }

            return $service->fresh();
        });
    }

    public function updateService(Service $service, ServiceDTO $dto): Service
    {
        return DB::transaction(function () use ($service, $dto) {
            $service->update([
                'name' => $dto->name,
                'description' => $dto->description,
                'is_active' => $dto->is_active,
                'type' => $dto->type,
                'phone' => $dto->phone,
                'website' => $dto->website,
                'working_hours' => $dto->working_hours,
                'address' => $dto->address,
                'latitude' => $dto->latitude,
                'longitude' => $dto->longitude,
                'contact_info' => $dto->contact_info
            ]);

            if ($dto->photos) {
                // Delete existing photos if new ones are provided
                foreach ($service->photos as $photo) {
                    Storage::disk('public')->delete($photo->photo_path);
                }
                $service->photos()->delete();

                // Upload new photos
                foreach ($dto->photos as $index => $photo) {
                    $this->uploadServicePhoto($service, $photo, $index === 0);
                }
            }

            return $service->fresh();
        });
    }

    public function deleteService(Service $service): bool
    {
        return DB::transaction(function () use ($service) {
            // Delete photos from storage
            foreach ($service->photos as $photo) {
                Storage::disk('public')->delete($photo->photo_path);
            }

            return $service->delete();
        });
    }

    public function addReview(Service $service, ReviewDTO $dto, ?int $userId = null): ServiceReview
    {
        return DB::transaction(function () use ($service, $dto, $userId) {
            $review = new ServiceReview([
                'comment' => $dto->comment,
                'rating' => $dto->rating,
                'is_google_review' => $dto->is_google_review,
                'reviewer_name' => $dto->reviewer_name,
                'google_review_id' => $dto->google_review_id,
                'review_time' => now(),
                'user_id' => $userId
            ]);

            if ($dto->photo) {
                $review->photo_path = $this->uploadReviewPhoto($dto->photo);
            }

            $service->reviews()->save($review);

            // Update service rating and review count
            $this->updateServiceRating($service);

            return $review;
        });
    }

    public function syncGoogleReviews(Service $service): void
    {
        // Implement Google Places API integration here
        // This would fetch reviews from Google Places API and sync them
        // You'll need to implement this based on your Google API setup
    }

    public function uploadServicePhoto(Service $service, $photo, bool $isPrimary = false): string
    {
        $path = $photo->store('services', 'public');
        
        ServicePhoto::create([
            'service_id' => $service->id,
            'photo_path' => $path,
            'is_primary' => $isPrimary
        ]);

        return $path;
    }

    private function uploadReviewPhoto($photo): string
    {
        return $photo->store('reviews', 'public');
    }

    private function updateServiceRating(Service $service): void
    {
        $averageRating = $service->reviews()->avg('rating');
        $reviewCount = $service->reviews()->count();

        $service->update([
            'rating' => round($averageRating, 2),
            'review_count' => $reviewCount
        ]);
    }
}
