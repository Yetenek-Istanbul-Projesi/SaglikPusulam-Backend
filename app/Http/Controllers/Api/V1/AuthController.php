<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\UserServiceInterface;
use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private UserServiceInterface $userService;
    public function __construct(UserServiceInterface $userService
    ) {
        $this->userService = $userService;
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
}
