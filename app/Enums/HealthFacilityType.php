<?php

namespace App\Enums;

enum HealthFacilityType: string
{
    case HOSPITAL = 'hospital';
    case CLINIC = 'clinic';
    case DOCTOR = 'doctor';

    public static function fromString(?string $type): ?self
    {
        return match(strtolower($type ?? '')) {
            'hastane', 'hospital' => self::HOSPITAL,
            'klinik', 'clinic' => self::CLINIC,
            'doktor', 'doctor' => self::DOCTOR,
            default => null
        };
    }

    public function toLocalizedString(): string
    {
        return match($this) {
            self::HOSPITAL => 'Hastane',
            self::CLINIC => 'Klinik',
            self::DOCTOR => 'Doktor'
        };
    }
}
