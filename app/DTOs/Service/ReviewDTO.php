<?php

namespace App\DTOs\Service;

class ReviewDTO
{
    public function __construct(
        public readonly string $comment,
        public readonly float $rating,
        public readonly ?object $photo,
        public readonly ?string $reviewer_name = null,
        public readonly bool $is_google_review = false,
        public readonly ?string $google_review_id = null,
        public readonly ?string $source = null,
        public readonly ?string $sourceReviewId = null,
        public readonly ?string $sourceReviewTime = null
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            comment: $data['comment'],
            rating: $data['rating'],
            photo: $data['photo'] ?? null,
            reviewer_name: $data['reviewer_name'] ?? null,
            is_google_review: $data['is_google_review'] ?? false,
            google_review_id: $data['google_review_id'] ?? null,
            source: $data['source'] ?? null,
            sourceReviewId: $data['sourceReviewId'] ?? null,
            sourceReviewTime: $data['sourceReviewTime'] ?? null
        );
    }
}
