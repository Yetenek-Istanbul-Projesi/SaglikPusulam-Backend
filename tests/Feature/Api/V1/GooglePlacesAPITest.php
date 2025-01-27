<?php

namespace Tests\Feature\Api\V1;

use App\Contracts\Services\GooglePlacesServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

class GooglePlacesAPITest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $mock = Mockery::mock(GooglePlacesServiceInterface::class);

        // searchHealthFacilities metodunu mock'la
        $mock->shouldReceive('searchHealthFacilities')
            ->andReturn([
                'places' => [
                    [
                        'id' => 'place123',
                        'name' => 'Test Hastanesi',
                        'address' => 'Test Caddesi No:1',
                        'rating' => 4.5
                    ]
                ]
            ]);

        // fetchPhoto metodunu mock'la
        $mock->shouldReceive('fetchPhoto')
            ->andReturn('fake-binary-image-data');

        $this->app->instance(GooglePlacesServiceInterface::class, $mock);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    public function test_can_search_health_facilities()
    {
        $searchParams = [
            'province' => 'İstanbul'
        ];

        $response = $this->getJson('/api/v1/places/search?' . http_build_query($searchParams));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'places' => [
                        '*' => [
                            'id',
                            'name',
                            'address',
                            'rating'
                        ]
                    ]
                ]
            ]);
    }

    public function test_search_with_missing_parameters()
    {
        $response = $this->getJson('/api/v1/places/search');

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'The province field is required.',
                'errors' => [
                    'province' => ['The province field is required.']
                ]
            ]);
    }

    public function test_can_get_photo()
    {
        $photoReference = 'test-photo-reference';
        
        $response = $this->get("/api/v1/places/photo/{$photoReference}");

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'image/jpeg')
            ->assertHeader('Cache-Control', 'max-age=86400, public')
            ->assertHeader('X-Content-Type-Options', 'nosniff');
    }
} 