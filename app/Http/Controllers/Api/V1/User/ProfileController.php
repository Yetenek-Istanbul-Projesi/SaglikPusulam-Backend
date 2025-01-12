<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Contracts\Services\ProfileServiceInterface;
use App\DTOs\Auth\ChangePasswordDTO;
use App\DTOs\User\Profile\UpdateProfileDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Requests\User\UploadProfilePhotoRequest;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct(
        private readonly ProfileServiceInterface $profileService
    ) {}

    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $user = JWTAuth::parseToken()->authenticate();
        $result = $this->profileService->updateProfile(
            $user,
            UpdateProfileDTO::fromRequest($request->validated())
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Profil bilgileriniz güncellendi',
            'user' => $result
        ]);
    }

    public function uploadPhoto(UploadProfilePhotoRequest $request): JsonResponse
    {
        $user = JWTAuth::parseToken()->authenticate();
        
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $path = $request->file('photo')->store('profile-photos', 'public');
            
            $result = $this->profileService->updateProfile(
                $user,
                UpdateProfileDTO::fromRequest(['profile_photo' => $path])
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Profil fotoğrafınız güncellendi',
                'user' => $result,
                'photo_url' => Storage::disk('public')->url($path)
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Profil fotoğrafı yüklenemedi'
        ], 400);
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = JWTAuth::parseToken()->authenticate();
        $this->profileService->changePassword(
            $user,
            ChangePasswordDTO::fromRequest($request->validated())
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Şifreniz başarıyla güncellendi'
        ]);
    }
}
