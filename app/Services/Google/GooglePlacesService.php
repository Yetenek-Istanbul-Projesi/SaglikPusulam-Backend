<?php

namespace App\Services\Google;

use App\DTOs\Google\PlaceSearchDTO;
use App\DTOs\Google\PlaceDetailsDTO;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class GooglePlacesService
{
    private string $apiKey;
    private const CACHE_TTL = 3600; // 1 hour

    public function __construct()
    {
        $this->apiKey = config('services.google.places_api_key');
    }

    public function searchNearbyHealthFacilities(float $latitude, float $longitude, int $radius = 5000): Collection
    {
        $cacheKey = "places_search:{$latitude}:{$longitude}:{$radius}";
        
        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($latitude, $longitude, $radius) {
            $response = Http::get('https://maps.googleapis.com/maps/api/place/nearbysearch/json', [
                'location' => "{$latitude},{$longitude}",
                'radius' => $radius,
                'type' => 'health',
                'key' => $this->apiKey
            ]);

            if (!$response->successful()) {
                throw new \Exception('Failed to fetch places from Google API');
            }

            return collect($response->json('results'))->map(function ($place) {
                return new PlaceSearchDTO(
                    placeId: $place['place_id'],
                    name: $place['name'],
                    address: $place['vicinity'] ?? '',
                    latitude: $place['geometry']['location']['lat'],
                    longitude: $place['geometry']['location']['lng'],
                    rating: $place['rating'] ?? 0,
                    userRatingsTotal: $place['user_ratings_total'] ?? 0,
                    isOpenNow: $place['opening_hours']['open_now'] ?? null,
                    photoReferences: collect($place['photos'] ?? [])->pluck('photo_reference')->toArray()
                );
            });
        });
    }

    public function getPlaceDetails(string $placeId): PlaceDetailsDTO
    {
        $cacheKey = "place_details:{$placeId}";
        
        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($placeId) {
            $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
                'place_id' => $placeId,
                'fields' => 'name,formatted_address,formatted_phone_number,geometry,opening_hours,photos,rating,reviews,user_ratings_total,website,url',
                'key' => $this->apiKey
            ]);

            if (!$response->successful()) {
                throw new \Exception('Failed to fetch place details from Google API');
            }

            $place = $response->json('result');

            return new PlaceDetailsDTO(
                placeId: $place['place_id'],
                name: $place['name'],
                address: $place['formatted_address'],
                phoneNumber: $place['formatted_phone_number'] ?? null,
                website: $place['website'] ?? null,
                placeUrl: $place['url'] ?? null,
                latitude: $place['geometry']['location']['lat'],
                longitude: $place['geometry']['location']['lng'],
                rating: $place['rating'] ?? 0,
                userRatingsTotal: $place['user_ratings_total'] ?? 0,
                isOpenNow: $place['opening_hours']['open_now'] ?? null,
                openingHours: $place['opening_hours']['weekday_text'] ?? [],
                photoReferences: collect($place['photos'] ?? [])->pluck('photo_reference')->toArray(),
                reviews: collect($place['reviews'] ?? [])->map(function ($review) {
                    return [
                        'author_name' => $review['author_name'],
                        'rating' => $review['rating'],
                        'text' => $review['text'],
                        'time' => $review['time'],
                        'profile_photo_url' => $review['profile_photo_url']
                    ];
                })->toArray()
            );
        });
    }

    public function getPhotoUrl(string $photoReference, int $maxWidth = 400): string
    {
        return "https://maps.googleapis.com/maps/api/place/photo?" . http_build_query([
            'maxwidth' => $maxWidth,
            'photo_reference' => $photoReference,
            'key' => $this->apiKey
        ]);
    }
}
