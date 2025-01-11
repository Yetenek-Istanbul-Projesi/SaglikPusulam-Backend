<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\UserServiceInterface;
use App\DTOs\UserDTO;
use App\DTOs\Auth\LoginDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{  
    //  Kullanıcı kaydolma ve oturum açma islemleri
    private UserServiceInterface $userService;
    private AuthService $authService;

    public function __construct(
        UserServiceInterface $userService,
        AuthService $authService
    ) {
        $this->userService = $userService;
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        // $request : Kullanıcı verileri
        // $validated : Kullanıcı verilerinin doğrulanması
        // UserDTO::fromRequest($request->validated()) : Kullanıcı verilerini Kalıba Dönüştürme
        // $this->userService->register(UserDTO::fromRequest($request->validated())) : Dönüştürülen verileri Veritabanına Kaydetme


        $user = $this->userService->register(
            UserDTO::fromRequest($request->validated())
        );


        // auth()->login($user) : Kullanıcı oturum açma(Kaydolmuş olan kullanıcı oturum açar)
        // $user : Kullanıcının oturum açma bilgileri
        // $token : Oturum açan kullanıcının oturum tokeni

        $token = auth()->login($user);

        // İşlemin sonunda apiye oturum açma bilgileri ve oturum tokeni gönderilir
        return response()->json([
            'status' => 'success',
            'message' => 'Kullanıcı başarıyla oluşturuldu',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function login(Request $request): JsonResponse
    {
        // $request : Kullanıcı verileri
        // $validated : Kullanıcı verilerinin doğrulanması
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Kullanıcı giris yapma islemi
        try {
            $result = $this->authService->login(
                LoginDTO::fromRequest($validated)
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
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Geçersiz kimlik bilgileri',
            ], 401);
        }
    }
}
