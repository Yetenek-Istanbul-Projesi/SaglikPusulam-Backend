<?php

namespace Tests\Feature\Api\V1;

use Tests\TestCase;
use App\Models\User;
use Mockery;
use App\Services\HealthSearchService;
use App\Services\HealthDetailsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;

class HealthTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $token;
    private $healthSearchService;
    private $healthDetailsService;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);
        
        $this->token = JWTAuth::fromUser($this->user);

        // Mock servisleri oluştur
        $this->healthSearchService = Mockery::mock(HealthSearchService::class);
        $this->healthDetailsService = Mockery::mock(HealthDetailsService::class);
        
        // Mock servisleri container'a kaydet
        $this->app->instance(HealthSearchService::class, $this->healthSearchService);
        $this->app->instance(HealthDetailsService::class, $this->healthDetailsService);
    }

    public function test_can_search_health_services()
    {
        // Mock response hazırla
        $this->healthSearchService
            ->shouldReceive('searchResults')
            ->once()
            ->andReturn([
                'results' => [
                    ['id' => 1, 'name' => 'Test Hastanesi']
                ],
                'total' => 1,
                'meta' => []
            ]);

        $response = $this->postJson('/api/v1/health/search', [
            'province' => 'İstanbul',
            'type' => 'hastane'
        ]);

        $response->assertStatus(200);
    }

    public function test_can_filter_health_services()
    {
        // Mock response hazırla
        $this->healthSearchService
            ->shouldReceive('filterResults')
            ->once()
            ->andReturn([
                'results' => [
                    ['id' => 1, 'name' => 'Test Hastanesi']
                ],
                'total' => 1,
                'meta' => []
            ]);

        $response = $this->postJson('/api/v1/health/filter', [
            'rating' => 4,
            'distance' => 10
        ]);

        $response->assertStatus(200);
    }

    public function test_can_load_more_results()
    {
        // Mock response hazırla
        $this->healthSearchService
            ->shouldReceive('getNextPage')
            ->once()
            ->andReturn([
                'results' => [
                    ['id' => 1, 'name' => 'Test Hastanesi']
                ],
                'total' => 1,
                'meta' => []
            ]);

        $response = $this->getJson('/api/v1/health/load-more');

        $response->assertStatus(200);
    }

    public function test_can_get_most_favorited()
    {
        // Mock response hazırla
        $this->healthDetailsService
            ->shouldReceive('getMostFavoritedPlaces')
            ->once()
            ->andReturn([
                [
                    'id' => 1,
                    'place_id' => 'test_place_id',
                    'name' => 'Test Hastanesi',
                    'address' => 'Test Adresi',
                    'rating' => 4.5,
                    'favorite_count' => 10,
                    'main_photo_url' => 'http://example.com/photo.jpg',
                    'types' => ['hastane']
                ]
            ]);

        $response = $this->getJson('/api/v1/health/most-favorited');

        $response->assertStatus(200);
    }

    public function test_can_search_in_results()
    {
        // Mock response hazırla
        $this->healthSearchService
            ->shouldReceive('findPlaceInResults')
            ->with('test_place_id')
            ->once()
            ->andReturn([
                'id' => 1,
                'place_id' => 'test_place_id',
                'name' => 'Test Hastanesi',
                'address' => 'Test Adresi',
                'rating' => 4.5,
                'favorite_count' => 10,
                'main_photo_url' => 'http://example.com/photo.jpg',
                'types' => ['hastane']
            ]);

        $response = $this->getJson('/api/v1/health/details/search?placeId=test_place_id');

        $response->assertStatus(200);
    }

    public function test_can_get_place_reviews()
    {
        $placeId = 'test_place_id';
        
        $response = $this->getJson("/api/v1/health/details/{$placeId}/reviews");

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_add_review()
    {
        $placeId = 'test_place_id';
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->postJson("/api/v1/health/details/{$placeId}/add-review", [
            'rating' => 5,
            'comment' => 'Harika bir hizmet'
        ]);

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_update_review()
    {
        $placeId = 'test_place_id';
        
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->postJson("/api/v1/health/details/{$placeId}/add-review", [
            'rating' => 5,
            'comment' => 'İlk yorum'
        ]);
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->putJson("/api/v1/health/details/{$placeId}/update-review", [
            'rating' => 4,
            'comment' => 'Güncellenen yorum'
        ]);

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_delete_review()
    {
        $placeId = 'test_place_id';
        
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->postJson("/api/v1/health/details/{$placeId}/add-review", [
            'rating' => 5,
            'comment' => 'Silinecek yorum'
        ]);
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->deleteJson("/api/v1/health/details/{$placeId}/delete-review");

        $response->assertStatus(200);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
} 