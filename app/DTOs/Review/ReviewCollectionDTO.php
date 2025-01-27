<?php

namespace App\DTOs\Review;

class ReviewCollectionDTO
{
    public array $stats;

    /**
     * @param ReviewDTO[] $items
     */
    public function __construct(
        public readonly array $items,
        public readonly int $currentPage,
        public readonly int $lastPage,
        public readonly int $perPage,
        public readonly int $total,
        ?array $stats = null
    ) {
        $this->stats = $stats ?? [];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            items: array_map(
                fn (array $review) => ReviewDTO::fromArray($review),
                $data['data']
            ),
            currentPage: $data['meta']['current_page'],
            lastPage: $data['meta']['last_page'],
            perPage: $data['meta']['per_page'],
            total: $data['meta']['total'],
            stats: $data['meta']['stats'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(
                fn (ReviewDTO $review) => $review->toArray(),
                $this->items
            ),
            'meta' => [
                'current_page' => $this->currentPage,
                'last_page' => $this->lastPage,
                'per_page' => $this->perPage,
                'total' => $this->total,
                'stats' => $this->stats
            ]
        ];
    }
}
