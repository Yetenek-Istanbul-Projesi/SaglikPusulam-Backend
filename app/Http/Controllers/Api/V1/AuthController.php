<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\UserServiceInterface;
use App\DTOs\Auth\RegisterDTO;
use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\ForgotPasswordDTO;
use App\DTOs\Auth\ResetPasswordDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Services\Auth\PasswordResetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * AuthController sınıfı, kullanıcı kaydı, giriş, şifre sıfırlama ve doğrulama işlemlerini içerir.
 */
class AuthController extends Controller
{  
    private UserServiceInterface $userService;
    private PasswordResetService $passwordResetService;

    public function __construct(UserServiceInterface $userService, PasswordResetService $passwordResetService)
    {
        $this->userService = $userService;
        $this->passwordResetService = $passwordResetService;
    }

    /**
     * Kullanıcı kaydı
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $result = $this->userService->register(
                RegisterDTO::fromRequest($request->validated())
            );

            return response()->json([
                'status' => 'success',
                'message' => $result['message'],
                'verification_token' => $result['verification_token']
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doğrulama hatası',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bir hata oluştu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Kullanıcı kaydı doğrulama
     */
    public function verifyRegistration(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'verification_token' => 'required|string',
            'email_code' => 'required|string|size:6',
            'phone_code' => 'required|string|size:6'
        ], [
            'verification_token.required' => 'Doğrulama token\'ı gereklidir',
            'email_code.required' => 'E-posta doğrulama kodu gereklidir',
            'email_code.size' => 'E-posta doğrulama kodu 6 karakter olmalıdır',
            'phone_code.required' => 'Telefon doğrulama kodu gereklidir',
            'phone_code.size' => 'Telefon doğrulama kodu 6 karakter olmalıdır'
        ]);

        try {
            $user = $this->userService->verifyRegistration(
                $validated['verification_token'],
                $validated['email_code'],
                $validated['phone_code']
            );

            $token = JWTAuth::fromUser($user);

            return response()->json([
                'status' => 'success',
                'message' => 'Hesabınız başarıyla oluşturuldu',
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Doğrulama hatası',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bir hata oluştu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Kullanıcı girişi
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $result = $this->userService->login(
                LoginDTO::fromRequest($request->validated())
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Giriş başarılı',
                'user' => $result['user'],
                'authorization' => [
                    'token' => $result['token'],
                    'type' => $result['token_type'],
                ]
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Giriş başarısız',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bir hata oluştu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Şifre sıfırlama bağlantısı gönder
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $this->passwordResetService->sendResetLink(
            ForgotPasswordDTO::fromRequest($request->validated())
        );
        
        return response()->json([
            'status' => 'success',
            'message' => 'Şifre sıfırlama bağlantısı e-posta adresinize gönderildi'
        ]);
    }

    /**
     * Şifre sıfırlama
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        \Log::info('Reset password request data:', $request->all());
        
        $this->passwordResetService->reset(
            ResetPasswordDTO::fromRequest($request->validated())
        );
        
        return response()->json([
            'status' => 'success',
            'message' => 'Şifreniz başarıyla sıfırlandı'
        ]);
    }
}
