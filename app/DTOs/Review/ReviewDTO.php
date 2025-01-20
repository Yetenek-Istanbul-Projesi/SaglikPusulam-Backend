<?php

namespace App\DTOs\Review;

class ReviewDTO
{
    public function __construct(
        public readonly string $comment,
        public readonly int $rating,
        public readonly string $userName,
        public readonly ?string $profilePhoto,
        public readonly string $createdAt,
        public readonly string $source,
        public readonly bool $isAnonymous,
        public readonly ?string $placeName = null,
        public readonly ?string $placeId = null
    ) {}

    public static function fromArray(array $data): self
    {
        $userName = $data['user_name'] ?? 'Kullanıcı';
        if ($data['is_anonymous'] ?? false) {
            $userName = 'Anonim';
        }

        return new self(
            comment: $data['comment'],
            rating: $data['rating'],
            userName: $userName,
            profilePhoto: $data['is_anonymous'] ?? false ? null : ($data['profile_photo'] ?? null),
            createdAt: $data['created_at'],
            source: $data['source'],
            isAnonymous: $data['is_anonymous'] ?? false,
            placeName: $data['place_name'] ?? null,
            placeId: $data['place_id'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'comment' => $this->comment,
            'rating' => $this->rating,
            'user_name' => $this->userName,
            'profile_photo' => $this->profilePhoto,
            'created_at' => $this->createdAt,
            'source' => $this->source,
            'is_anonymous' => $this->isAnonymous,
            'place_name' => $this->placeName,
            'place_id' => $this->placeId
        ];
    }
}
