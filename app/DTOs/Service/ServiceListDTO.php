<?php

namespace App\DTOs\Service;

class ServiceListDTO
{
    // Burada kullanıcıdan gelen verileri belirtiyoruz
    public function __construct(
        public readonly int $service_id
    ) {
    }

    // Burada kullanıcıdan gelen verileri mevcut verilere aktarıyoruz.
    public static function fromRequest(array $data): self
    {
        return new self(
            service_id: $data['service_id']
        );
    }
}
