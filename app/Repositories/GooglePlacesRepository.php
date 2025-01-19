<?php

namespace App\Repositories;

use App\Contracts\Repositories\GooglePlacesRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GooglePlacesRepository implements GooglePlacesRepositoryInterface
{
    private string $apiKey;
    private $httpClient;
    private const FIELDS_MASK = 'places.id,places.displayName,places.primaryTypeDisplayName,places.rating,places.userRatingCount,places.editorialSummary,places.googleMapsLinks.directionsUri,places.photos,places.googleMapsUri,places.formattedAddress,places.nationalPhoneNumber,places.websiteUri,places.currentOpeningHours,places.reviews,places.location';

    public function __construct()
    {
        $this->apiKey = config('services.google.places_api_key');
        $this->httpClient = Http::withHeaders([
            'X-Goog-Api-Key' => $this->apiKey
        ]);
    }

    public function searchPlaces(string $query, ?string $pageToken = null): array
    {
        $endpoint = 'https://places.googleapis.com/v1/places:searchText';

        $payload = [
            'textQuery' => $query,
            'languageCode' => 'tr',
            'regionCode' => 'TR',
            'maxResultCount' => 20,
        ];

        if ($pageToken) {
            $payload['pageToken'] = $pageToken;
        }
        $response = $this->httpClient->withHeaders([
            'X-Goog-FieldMask' => self::FIELDS_MASK,
        ])->post($endpoint, $payload);

        return $response->json();
    }

    public function getPlaceDetails(string $placeId): array
    {
        $endpoint = "https://places.googleapis.com/v1/places/{$placeId}";

        $response = $this->httpClient->withHeaders([
            'X-Goog-FieldMask' => self::FIELDS_MASK,
        ])->get($endpoint);

        return $response->json();
    }

    public function getPhotoUrl(string $photoReference, int $maxWidth = 400): string
    {
        // Kendi API endpoint'imizi döndür
        return route('api.places.photo', ['photoReference' => $photoReference]);
    }

    public function fetchPhoto(string $photoReference, int $maxWidth = 400): string
    {
        $url = "https://places.googleapis.com/v1/{$photoReference}/media?maxWidthPx={$maxWidth}";

        try {
            $response = Http::withHeaders([
                'X-Goog-Api-Key' => $this->apiKey,
                'Accept' => 'image/jpeg'
            ])->get($url);

            if (!$response->successful()) {
                throw new \Exception('Fotoğraf yüklenemedi: ' . $response->body());
            }

            return $response->body();
        } catch (\Exception $e) {
            \Log::error('Google Places Photo Error', [
                'error' => $e->getMessage(),
                'url' => $url
            ]);
            throw $e;
        }
    }

    public function getCoordinates(string $province, ?string $district = null): array
    {
        $endpoint = 'https://maps.googleapis.com/maps/api/geocode/json';
        $address = $district ? "$district, $province, Turkey" : "$province, Turkey";

        $response = Http::get($endpoint, [
            'address' => $address,
            'key' => $this->apiKey,
            'language' => 'tr',
            'region' => 'tr'
        ]);

        $data = $response->json();

        if ($data['status'] !== 'OK' || empty($data['results'])) {
            Log::error('Google Geocoding API error', [
                'status' => $data['status'] ?? 'Unknown',
                'error_message' => $data['error_message'] ?? 'No results found',
                'address' => $address
            ]);
            throw new \RuntimeException("Verilen adresde geocode bulunamadı: $address");
        }

        $location = $data['results'][0]['geometry']['location'];
        return [
            'lat' => $location['lat'],
            'lng' => $location['lng']
        ];
    }
}
