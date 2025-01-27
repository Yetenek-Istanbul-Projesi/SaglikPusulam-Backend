<?php

namespace App\Services\User;

use App\Contracts\Services\ProfileServiceInterface;
use App\Contracts\Services\GooglePlacesServiceInterface;
use App\DTOs\Auth\ChangePasswordDTO;
use App\DTOs\User\Profile\UpdateProfileDTO;
use App\DTOs\Profile\UserListDTO;
use App\Models\User;
use App\Contracts\Repositories\ProfileRepositoryInterface;
use App\Contracts\Repositories\HealthPlaceRepositoryInterface;

class ProfileService implements ProfileServiceInterface
{
    public function __construct(
        private readonly ProfileRepositoryInterface $repository,
        private readonly GooglePlacesServiceInterface $googlePlacesService,
        private readonly HealthPlaceRepositoryInterface $healthPlaceRepository
    ) {}

    public function updateProfile(User $user, UpdateProfileDTO $dto): User
    {
        return $this->repository->updateProfile($user, $dto);
    }

    public function uploadPhoto(User $user, $photo): string
    {
        return $this->repository->uploadPhoto($user, $photo);
    }

    public function changePassword(User $user, ChangePasswordDTO $dto): bool
    {
        return $this->repository->changePassword($user, $dto);
    }

    public function getFavorites(int $userId): array
    {
        $favorites = $this->repository->getFavorites($userId)->toArray();
        return [
            'places' => $favorites,
            'total' => count($favorites),
            'message' => 'Favori hizmetleriniz başarıyla getirildi'
        ];
    }

    public function getComparisons(int $userId): array
    {
        $comparisons = $this->repository->getComparisons($userId)->toArray();
        return [
            'places' => $comparisons,
            'total' => count($comparisons),
            'message' => 'Karşılaştırma listeniz başarıyla getirildi'
        ];
    }

    public function toggleFavorite(int $userId, string $placeId): array
    {
        // Önce place'i health_places'e ekle
        $this->healthPlaceRepository->updateOrCreate(
            ['google_place_id' => $placeId],
            ['place_data' => $this->googlePlacesService->getPlaceDetails($placeId)]
        );

        $dto = new UserListDTO($userId, $placeId);
        $result = $this->repository->toggleFavorite($dto);

        // Eğer favoriden çıkarıldıysa ve başka referans yoksa sil
        if (!$result) {
            $this->healthPlaceRepository->deleteIfUnused($placeId);
        }

        return [
            'status' => $result ? 'eklendi' : 'silindi',
            'message' => $result 
                ? 'Hizmet favorilerinize eklendi' 
                : 'Hizmet favorilerinizden çıkarıldı'
        ];
    }

    public function toggleComparison(int $userId, string $placeId): array
    {
        // Önce place'i health_places'e ekle
        $this->healthPlaceRepository->updateOrCreate(
            ['google_place_id' => $placeId],
            ['place_data' => $this->googlePlacesService->getPlaceDetails($placeId)]
        );

        $dto = new UserListDTO($userId, $placeId);
        $result = $this->repository->toggleComparison($dto);

        // Eğer karşılaştırmadan çıkarıldıysa ve başka referans yoksa sil
        if (!$result) {
            $this->healthPlaceRepository->deleteIfUnused($placeId);
        }

        return [
            'status' => $result ? 'eklendi' : 'silindi',
            'message' => $result 
                ? 'Hizmet karşılaştırma listenize eklendi' 
                : 'Hizmet karşılaştırma listenizden çıkarıldı'
        ];
    }

    public function checkLists(int $userId, string $placeId): array
    {
        $dto = new UserListDTO($userId, $placeId);
        $result = $this->repository->checkUserLists($dto);
        return [
            'isFavorite' => $result['is_favorite'],
            'isInComparison' => $result['is_in_comparison'],
            'message' => 'Hizmet durumu başarıyla kontrol edildi'
        ];
    }
}
