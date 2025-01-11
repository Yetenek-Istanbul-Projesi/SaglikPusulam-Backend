<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\Services\ProfileServiceInterface;
use App\DTOs\Auth\ChangePasswordDTO;
use App\DTOs\Profile\UpdateProfileDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{ 
    
    public function __construct(
        private readonly ProfileServiceInterface $profileService
    ) {}

    public function update(UpdateProfileRequest $request): JsonResponse
    { // Burada kullanıcıdan gelen verileri mevcut verilere aktarıyoruz.
        $user = auth()->user();
        $dto = UpdateProfileDTO::fromRequest($request->validated());// Burada kullanıcıdan gelen verileri mevcut verilere aktarıyoruz.
        
        $updatedUser = $this->profileService->updateProfile($user, $dto); // Profili güncelliyoruz.

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $updatedUser
        ]);
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    { // Burada kullanıcıdan gelen verileri mevcut verilere aktarıyoruz.
        try {
            $user = auth()->user();
            $dto = ChangePasswordDTO::fromRequest($request->validated()); // Burada kullanıcıdan gelen verileri mevcut verilere aktarıyoruz.
            
            $this->profileService->changePassword($user, $dto); // Paroluyu güncelliyoruz.

            return response()->json([
                'message' => 'Password changed successfully'
            ]);
        } catch (\InvalidArgumentException $e) { // Hata durumunda hata mesajını döndürürüz.
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
