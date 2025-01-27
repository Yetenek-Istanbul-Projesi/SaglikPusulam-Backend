<?php

namespace Tests\Feature\Api\V1;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $token;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Test kullanıcısı oluştur
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);
        
        // JWT token al
        $this->token = JWTAuth::fromUser($this->user);
    }

    public function test_user_can_update_profile()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->put('/api/v1/profile/update', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone' => '5551234567'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Profil bilgileriniz güncellendi'
            ]);
    }

    public function test_user_can_upload_photo()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->post('/api/v1/profile/upload-photo', [
            'photo' => $file
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Profil fotoğrafınız güncellendi'
            ]);

        // Dosyanın storage'da var olduğunu kontrol et
        $this->assertTrue(Storage::disk('public')->exists('profile-photos/' . $file->hashName()));
    }

    public function test_user_can_change_password()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->post('/api/v1/profile/change-password', [
            'current_password' => 'password123',
            'new_password' => 'newpassword123',
            'new_password_confirmation' => 'newpassword123'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Şifreniz başarıyla güncellendi'
            ]);
    }

    public function test_user_can_get_favorites()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->get('/api/v1/profile/favorites');

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success'
            ])
            ->assertJsonStructure([
                'status',
                'data'
            ]);
    }

    public function test_user_can_get_comparisons()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->get('/api/v1/profile/comparisons');

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success'
            ])
            ->assertJsonStructure([
                'status',
                'data'
            ]);
    }

    public function test_user_can_toggle_favorite()
    {
        $placeId = 'test_place_id';

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->post("/api/v1/profile/favorites/{$placeId}");

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success'
            ])
            ->assertJsonStructure([
                'status',
                'data'
            ]);
    }

    public function test_user_can_toggle_comparison()
    {
        $placeId = 'test_place_id';

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->post("/api/v1/profile/comparisons/{$placeId}");

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success'
            ])
            ->assertJsonStructure([
                'status',
                'data'
            ]);
    }

    public function test_user_can_check_lists()
    {
        $placeId = 'test_place_id';

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->get("/api/v1/profile/check-lists/{$placeId}");

        $response->assertStatus(200);
    }

    public function test_user_can_get_reviews()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->get('/api/v1/profile/reviews');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data'
            ]);
    }
} 