<?php

namespace App\DTOs\Google;

class HealthSearchCriteriaDTO
{
    public function __construct(
        public readonly string $province,           // İl
        public readonly ?string $district = null,   // İlçe
        public readonly ?string $facilityType = null, // Hastane, Klinik, Doktor
        public readonly ?string $specialization = null // Uzmanlık alanı
    ) {}

    public function toSearchQuery(): string
    {
        $query = [];

        // Tesis türü varsa ekle, yoksa varsayılan olarak sağlık tesisi ara
        if ($this->facilityType) {
            $query[] = match ($this->facilityType) {
                'Hastaneler' => 'hastane',
                'Klinikler' => 'sağlık merkezi OR klinik OR tıp merkezi',
                'Doktorlar' => 'doktor OR uzman doktor',
                default => $this->facilityType
            };
        } else {
            $query[] = 'hastane OR sağlık merkezi OR klinik OR tıp merkezi OR doktor';
        }

        // Uzmanlık alanı varsa ekle
        if ($this->specialization) {
            $query[] = $this->specialization;
        }

        // Ana sorgu kısmını birleştir
        $mainQuery = implode(' ', $query);

        // Lokasyon bilgisini ekle
        $location = $this->district
            ? "{$this->district} {$this->province}"
            : $this->province;

        // Final sorguyu oluştur
        return "{$mainQuery} in {$location}, Türkiye";
    }
}
