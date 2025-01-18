<?php

namespace App\Repositories;

use App\Contracts\Repositories\GooglePlacesRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GooglePlacesRepository implements GooglePlacesRepositoryInterface
{
    private string $apiKey;
    private const FIELDS_MASK = 'places.id,places.displayName,places.primaryTypeDisplayName,places.rating,places.userRatingCount,places.editorialSummary,places.googleMapsLinks.directionsUri,places.photos,places.googleMapsUri,places.formattedAddress,places.nationalPhoneNumber,places.websiteUri,places.currentOpeningHours,places.reviews';

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
        $url = sprintf(
            'https://places.googleapis.com/v1/%s/media?maxWidthPx=%d&skipHttpRedirect=true&key=%s',
            $photoReference,
            $maxWidth,
            $this->apiKey
        );

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Goog-FieldMask' => 'photoUri'
        ])->get($url);


        if (!$response->successful()) {
            throw new \RuntimeException('Photo URL çekilemedi. Hata: ' . $response->body());
        }
        $responseData = $response->json();
        if (empty($responseData['photoUri'])) {
            throw new \RuntimeException(
                sprintf(
                    'Photo URL bulunamadı. Yanıt: %s',
                    json_encode($responseData, JSON_PRETTY_PRINT)
                )
            );
        }

        return $response->json()['photoUri'] ?? '';
    }
}
