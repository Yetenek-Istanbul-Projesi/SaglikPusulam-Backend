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
            $query[] = match($this->facilityType) {
                'hospital' => 'hastane',
                'clinic' => 'sağlık merkezi OR klinik OR tıp merkezi',
                'doctor' => 'doktor OR uzman doktor',
                default => $this->facilityType
            };
        } else {
            $query[] = 'hastane OR sağlık merkezi OR klinik OR tıp merkezi OR doktor';
        }

        // Uzmanlık alanı varsa ekle
        if ($this->specialization) {
            $query[] = $this->specialization;
        }

        // Lokasyon bilgisi ekle
        if ($this->district) {
            $query[] = "{$this->district} {$this->province}";
        } else {
            $query[] = $this->province;
        }

        return implode(' ', $query);
    }
}
