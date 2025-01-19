<?php

namespace App\Repositories;

use App\Contracts\Repositories\GooglePlacesRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GooglePlacesRepository implements GooglePlacesRepositoryInterface
{
    private string $apiKey;
    private const FIELDS_MASK = 'places.id,places.displayName,places.primaryTypeDisplayName,places.rating,places.userRatingCount,places.editorialSummary,places.googleMapsLinks.directionsUri,places.photos,places.googleMapsUri,places.formattedAddress,places.nationalPhoneNumber,places.websiteUri,places.currentOpeningHours,places.reviews,places.location';

    public function __construct()
    {
        $this->apiKey = config('services.google.places_api_key');
    }

    public function searchPlaces(string $query, ?string $pageToken = null): array
    {
        $endpoint = 'https://places.googleapis.com/v1/places:searchText';

        $payload = [
            'textQuery' => $query,
            'languageCode' => 'tr',
            'regionCode' => 'TR',
            'maxResultCount' => 5,
        ];

        if ($pageToken) {
            $payload['pageToken'] = $pageToken;
        }
        $response = Http::withHeaders([
            'X-Goog-Api-Key' => $this->apiKey,
            'X-Goog-FieldMask' => self::FIELDS_MASK,
        ])

            ->post($endpoint, $payload);

        return $response->json();
    }

    public function getPlaceDetails(string $placeId): array
    {
        $endpoint = "https://places.googleapis.com/v1/places/{$placeId}";

        $response = Http::withHeaders([
            'X-Goog-Api-Key' => $this->apiKey,
            'X-Goog-FieldMask' => self::FIELDS_MASK,
        ])->get($endpoint);

        return $response->json();
    }
    public function getPhotoUrl(string $photoReference, int $maxWidth = 400): string
    {
        return "https://places.googleapis.com/v1/places/{$photoReference}/media?key={$this->apiKey}&maxWidthPx={$maxWidth}";
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
            throw new \RuntimeException("Could not find coordinates for the given location");
        }

        $location = $data['results'][0]['geometry']['location'];
        return [
            'lat' => $location['lat'],
            'lng' => $location['lng']
        ];
    }
}
