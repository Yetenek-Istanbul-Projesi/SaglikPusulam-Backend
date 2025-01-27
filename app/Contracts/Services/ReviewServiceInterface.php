<?php

namespace App\Contracts\Services;

use App\DTOs\Review\ReviewDTO;
use App\DTOs\Review\ReviewCollectionDTO;

interface ReviewServiceInterface
{
    /**
     * Get reviews for a place with pagination
     */
    public function getReviews(string $placeId, int $page = 1, int $perPage = 10): ReviewCollectionDTO;

    /**
     * Add a new review to a place
     */
    public function addReview(string $placeId, array $data): ReviewDTO;

    /**
     * Update an existing review
     */
    public function updateReview(string $placeId, array $data): ReviewDTO;

    /**
     * Get user's reviews with pagination
     */
    public function getUserReviews(int $page = 1, int $perPage = 10): array;

    /**
     * Delete a review
     */
    public function deleteReview(string $placeId): void;
}
