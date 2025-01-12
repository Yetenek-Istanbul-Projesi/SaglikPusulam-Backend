<?php

namespace App\Services\Service;

use App\Contracts\ServiceListServiceInterface;
use App\DTOs\Service\ServiceListDTO;
use App\Models\Favorite;
use App\Models\Comparison;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ServiceListService implements ServiceListServiceInterface
{
    public function addToFavorites(ServiceListDTO $dto): array
    {
        $service = Service::findOrFail($dto->service_id);
        
        // Daha önce eklenip eklenmediğini kontrol ediyoruz
        $exists = Favorite::where('user_id', Auth::id())
            ->where('service_id', $dto->service_id)
            ->exists();

        if ($exists) {
            throw new \Exception('Bu hizmet zaten favorilerinizde');
        }

        // Favori listesine ekleme
        $favorite = Favorite::create([
            'user_id' => Auth::id(),
            'service_id' => $dto->service_id
        ]);

        return [
            'message' => 'Hizmet favorilere eklendi',
            'favorite' => $favorite
        ];
    }

    public function addToComparisons(ServiceListDTO $dto): array
    {
        $service = Service::findOrFail($dto->service_id);
        
        // Daha önce eklenip eklenmediğini kontrol ediyoruz
        $exists = Comparison::where('user_id', Auth::id())
            ->where('service_id', $dto->service_id)
            ->exists();

        if ($exists) {
            throw new \Exception('Bu hizmet zaten karşılaştırma listenizde');
        }

        // Karşılaştırma listesi limiti kontrolü (örneğin maksimum 3 hizmet)
        $comparisonCount = Comparison::where('user_id', Auth::id())->count();
        if ($comparisonCount >= 3) {
            throw new \Exception('Karşılaştırma listeniz dolu (Maksimum 3 hizmet)');
        }

        // Karşılaştırma listesine ekleme
        $comparison = Comparison::create([
            'user_id' => Auth::id(),
            'service_id' => $dto->service_id
        ]);

        return [
            'message' => 'Hizmet karşılaştırma listesine eklendi',
            'comparison' => $comparison
        ];
    }

    public function removeFromFavorites(ServiceListDTO $dto): array
    {
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('service_id', $dto->service_id)
            ->firstOrFail();

        $favorite->delete();

        return [
            'message' => 'Hizmet favorilerden çıkarıldı'
        ];
    }

    public function removeFromComparisons(ServiceListDTO $dto): array
    {
        $comparison = Comparison::where('user_id', Auth::id())
            ->where('service_id', $dto->service_id)
            ->firstOrFail();

        $comparison->delete();

        return [
            'message' => 'Hizmet karşılaştırma listesinden çıkarıldı'
        ];
    }

    public function getFavorites(): array
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->with('service')
            ->get();

        return [
            'favorites' => $favorites
        ];
    }

    public function getComparisons(): array
    {
        $comparisons = Comparison::where('user_id', Auth::id())
            ->with('service')
            ->get();

        return [
            'comparisons' => $comparisons
        ];
    }
}
