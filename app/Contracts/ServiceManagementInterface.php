<?php

namespace App\Contracts;

use App\DTOs\Service\ServiceDTO;
use App\DTOs\Service\ReviewDTO;
use App\Models\Service;
use App\Models\ServiceReview;
use Illuminate\Pagination\LengthAwarePaginator;

interface ServiceManagementInterface
{
    /**
     * Hizmetleri listeler
     */
    public function listServices(array $filters = []): LengthAwarePaginator;

    /**
     * Belirli bir hizmeti getirir
     */
    public function getService(int $id): Service;

    /**
     * Yeni hizmet oluşturur
     */
    public function createService(ServiceDTO $dto): Service;

    /**
     * Hizmeti günceller
     */
    public function updateService(Service $service, ServiceDTO $dto): Service;

    /**
     * Hizmeti siler
     */
    public function deleteService(Service $service): bool;

    /**
     * Hizmet fotoğrafı yükler
     */
    public function uploadServicePhoto(Service $service, $photo, bool $isPrimary = false): string;

    /**
     * Hizmete değerlendirme ekler
     */
    public function addReview(Service $service, ReviewDTO $dto, ?int $userId = null): ServiceReview;

    /**
     * Google değerlendirmelerini senkronize eder
     */
    public function syncGoogleReviews(Service $service): void;
}
