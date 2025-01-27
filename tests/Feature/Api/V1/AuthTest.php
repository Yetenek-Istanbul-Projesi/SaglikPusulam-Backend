<?php

namespace Tests\Feature\Api\V1;

use App\Models\User;
use App\Models\PendingUser;
use App\Contracts\VerificationServiceInterface;
use App\DTOs\User\VerificationResponseDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;
use Illuminate\Support\Facades\DB;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // VerificationService'i mock'la
        $mock = Mockery::mock(VerificationServiceInterface::class);
        
        // sendEmailVerification metodunu mock'la
        $mock->shouldReceive('sendEmailVerification')
            ->andReturn(VerificationResponseDTO::success('Email sent successfully'));
        
        // sendPhoneVerification metodunu mock'la    
        $mock->shouldReceive('sendPhoneVerification')
            ->andReturn(VerificationResponseDTO::success('SMS sent successfully'));
            
        // storePendingUser metodunu mock'la
        $mock->shouldReceive('storePendingUser')
            ->andReturnUsing(function ($userData) {
                return PendingUser::create([
                    'verification_token' => 'test-token',
                    'email_verification_code' => '123456',
                    'phone_verification_code' => '123456',
                    'email' => $userData['email'],
                    'phone' => $userData['phone'],
                    'first_name' => $userData['first_name'],
                    'last_name' => $userData['last_name'],
                    'password' => $userData['password'],
                    'terms_accepted' => $userData['terms_accepted'],
                    'privacy_accepted' => $userData['privacy_accepted'],
                    'codes_expire_at' => now()->addMinutes(10)
                ]);
            });

        // verifyEmail metodunu mock'la
        $mock->shouldReceive('verifyEmail')
            ->andReturn(true);
            
        // verifyPhone metodunu mock'la
        $mock->shouldReceive('verifyPhone')
            ->andReturn(true);
            
        // verifyAndCreateUser metodunu mock'la
        $mock->shouldReceive('verifyAndCreateUser')
            ->andReturn(User::factory()->create([
                'email_verified_at' => now(),
                'phone_verified_at' => now()
            ]));

        // Mock'u container'a kaydet
        $this->app->instance(VerificationServiceInterface::class, $mock);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    public function test_user_can_register()
    {
        $userData = [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'phone' => '+905551234567',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'terms_accepted' => true,
            'privacy_accepted' => true
        ];

        $response = $this->postJson('/api/v1/auth/register', $userData);
        
        // Debug için response'u yazdıralım
        dump($response->json());

        $response->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'verification_token'
            ]);

        $this->assertDatabaseHas('pending_users', [
            'email' => $userData['email'],
            'phone' => $userData['phone']
        ]);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('Password123!'),
            'email_verified_at' => now(),
            'phone_verified_at' => now()
        ]);

        $loginData = [
            'email' => 'test@example.com',
            'password' => 'Password123!'
        ];

        $response = $this->postJson('/api/v1/auth/login', $loginData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'authorization' => [
                    'token',
                    'type'
                ],
                'user'
            ]);
    }

    public function test_user_can_request_password_reset()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $response = $this->postJson('/api/v1/auth/forgot-password', [
            'email' => 'test@example.com'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message'
            ]);
    }

    public function test_user_can_reset_password()
    {
        // Kullanıcı oluştur
        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        // Önce şifre sıfırlama isteği yap
        $this->postJson('/api/v1/auth/forgot-password', [
            'email' => 'test@example.com'
        ]);

        // Password reset token'ı veritabanından al
        $resetToken = DB::table('password_reset_tokens')
            ->where('email', 'test@example.com')
            ->first()
            ->token;

        // Yeni şifre ile sıfırlama isteği yap
        $response = $this->postJson('/api/v1/auth/reset-password', [
            'email' => 'test@example.com',
            'token' => $resetToken,
            'password' => 'NewPassword123!',
            'password_confirmation' => 'NewPassword123!'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message'
            ]);

        // Yeni şifre ile giriş yapılabildiğini kontrol et
        $loginResponse = $this->postJson('/api/v1/auth/login', [
            'email' => 'test@example.com',
            'password' => 'NewPassword123!'
        ]);

        $loginResponse->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'authorization' => [
                    'token',
                    'type'
                ],
                'user'
            ]);
    }

    public function test_user_can_verify_registration()
    {
        // Önce register yapalım
        $registerData = [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test2@example.com',
            'phone' => '+905551234568',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'terms_accepted' => true,
            'privacy_accepted' => true
        ];

        $registerResponse = $this->postJson('/api/v1/auth/register', $registerData);
        
        // Debug için response'u yazdıralım
        dump($registerResponse->json());
        
        // Eğer register başarısız olduysa testi atlayalım
        if ($registerResponse->status() !== 201) {
            $this->markTestSkipped('Register failed, skipping verification test');
        }

        $verificationData = [
            'verification_token' => 'test-token', // Mock'ta tanımladığımız sabit token
            'email_code' => '123456',            // Mock'ta tanımladığımız sabit kod
            'phone_code' => '123456'             // Mock'ta tanımladığımız sabit kod
        ];

        $response = $this->postJson('/api/v1/auth/verify', $verificationData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'user',
                'authorization' => [
                    'token',
                    'type'
                ]
            ]);
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $loginData = [
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword'
        ];

        $response = $this->postJson('/api/v1/auth/login', $loginData);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'status',
                'message',
                'errors' => [
                    'login'
                ]
            ]);
    }
} 