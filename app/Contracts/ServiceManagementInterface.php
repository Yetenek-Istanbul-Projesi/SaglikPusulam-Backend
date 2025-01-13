<?php

namespace App\Contracts;

use App\DTOs\Service\ServiceDTO;
use App\DTOs\Service\ReviewDTO;
use App\Models\Service;
use App\Models\Review;
use App\DTOs\Google\PlaceSearchDTO;
use App\DTOs\Google\PlaceDetailsDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface ServiceManagementInterface
{
    /**
     * Yeni bir hizmet oluşturur
     */
    public function createService(ServiceDTO $serviceDTO): Service;

    /**
     * Hizmet bilgilerini günceller
     */
    public function updateService(int $serviceId, ServiceDTO $serviceDTO): Service;

    /**
     * Hizmet detaylarını getirir
     */
    public function getServiceDetails(int $serviceId): ?Service;

    /**
     * Hizmet listesini getirir
     */
    public function getServiceList(array $filters = [], int $perPage = 10): LengthAwarePaginator;

    /**
     * Hizmeti siler
     */
    public function deleteService(int $serviceId): bool;

    /**
     * Hizmet değerlendirmesi ekler
     */
    public function addServiceReview(int $serviceId, ReviewDTO $reviewDTO): Review;

    /**
     * Hizmet değerlendirmesini günceller
     */
    public function updateServiceReview(int $reviewId, ReviewDTO $reviewDTO): Review;

    /**
     * Hizmet değerlendirmesini siler
     */
    public function deleteServiceReview(int $reviewId): bool;

    /**
     * Google Place'i senkronize eder
     */
    public function syncGooglePlace(PlaceSearchDTO $place): Service;

    /**
     * Google Place Detaylarını senkronize eder
     */
    public function syncGooglePlaceDetails(PlaceDetailsDTO $details): Service;

    /**
     * Google değerlendirmelerini senkronize eder
     */
    public function syncGoogleReviews(Service $service, array $googleReviews): void;
}
