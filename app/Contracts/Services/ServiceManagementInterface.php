<?php

namespace App\Contracts\Services;

use App\DTOs\Service\ServiceDTO;
use App\DTOs\Service\ReviewDTO;
use App\Models\Service;
use App\Models\ServiceReview;
use Illuminate\Pagination\LengthAwarePaginator;

interface ServiceManagementInterface
{
    public function listServices(array $filters = []): LengthAwarePaginator;
    public function getService(int $id): Service;
    public function createService(ServiceDTO $dto): Service;
    public function updateService(Service $service, ServiceDTO $dto): Service;
    public function deleteService(Service $service): bool;
    public function addReview(Service $service, ReviewDTO $dto, ?int $userId = null): ServiceReview;
    public function syncGoogleReviews(Service $service): void;
    public function uploadServicePhoto(Service $service, $photo, bool $isPrimary = false): string;
}
