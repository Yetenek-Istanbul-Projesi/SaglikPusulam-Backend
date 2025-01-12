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
use App\Services\PasswordResetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{  
    //  Kullanıcı kaydolma ve oturum açma islemleri
    private UserServiceInterface $userService;
    private PasswordResetService $passwordResetService;

    public function __construct(UserServiceInterface $userService, PasswordResetService $passwordResetService)
    {
        $this->userService = $userService;
        $this->passwordResetService = $passwordResetService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->register(
                RegisterDTO::fromRequest($request->validated())
            );

            $token = auth()->login($user);

            return response()->json([
                'status' => 'success',
                'message' => 'Kullanıcı başarıyla oluşturuldu',
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

    public function login(LoginRequest $request): JsonResponse
    {
        // $request : Kullanıcı verileri
        // $validated : Kullanıcı verilerinin doğrulanması
        try {
            $result = $this->userService->login(
                LoginDTO::fromRequest($request->validated())
            );
            // İşlemin sonunda apiye oturum açma bilgileri ve oturum tokeni gönderilir
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

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        try {
            $this->passwordResetService->sendResetLink(
                ForgotPasswordDTO::fromRequest($request->validated())
            );
            
            return response()->json([
                'status' => 'success',
                'message' => 'Şifre sıfırlama bağlantısı e-posta adresinize gönderildi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Şifre sıfırlama bağlantısı gönderilemedi',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        try {
            $this->passwordResetService->reset(
                ResetPasswordDTO::fromRequest($request->validated())
            );
            
            return response()->json([
                'status' => 'success',
                'message' => 'Şifreniz başarıyla sıfırlandı'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Şifre sıfırlama işlemi başarısız',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
