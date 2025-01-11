<?php

namespace App\DTOs\Comment;

class CommentDTO
{
    // Burada kullanıcıdan gelen verileri belirtiyoruz
    public function __construct(
        public readonly int $service_id,
        public readonly string $content,
        public readonly bool $is_anonymous,
        public readonly ?string $anonymous_name = null,
        public readonly ?int $user_id = null
    ) {
    }

    // Burada kullanıcıdan gelen verileri mevcut verilere aktarıyoruz
    public static function fromRequest(array $data, ?int $userId = null): self
    {
        return new self(
            service_id: $data['service_id'],
            content: $data['content'],
            is_anonymous: $data['is_anonymous'] ?? false,
            anonymous_name: $data['is_anonymous'] ? ($data['anonymous_name'] ?? null) : null,
            user_id: $data['is_anonymous'] ? null : $userId
        );
    }
}
