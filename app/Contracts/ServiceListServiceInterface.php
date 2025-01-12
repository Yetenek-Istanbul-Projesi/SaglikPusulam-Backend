<?php

namespace App\Contracts;

use App\DTOs\Service\ServiceListDTO;

interface ServiceListServiceInterface
{
    /**
     * Hizmeti favorilere ekler
     */
    public function addToFavorites(ServiceListDTO $dto): array;

    /**
     * Hizmeti karşılaştırma listesine ekler
     */
    public function addToComparisons(ServiceListDTO $dto): array;

    /**
     * Hizmeti favorilerden çıkarır
     */
    public function removeFromFavorites(ServiceListDTO $dto): array;

    /**
     * Hizmeti karşılaştırma listesinden çıkarır
     */
    public function removeFromComparisons(ServiceListDTO $dto): array;

    /**
     * Kullanıcının favori hizmetlerini getirir
     */
    public function getFavorites(): array;

    /**
     * Kullanıcının karşılaştırma listesindeki hizmetleri getirir
     */
    public function getComparisons(): array;
}
