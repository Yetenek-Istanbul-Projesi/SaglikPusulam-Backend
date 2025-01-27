<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Contracts\Services\ProfileServiceInterface;
use App\DTOs\Auth\ChangePasswordDTO;
use App\DTOs\User\Profile\UpdateProfileDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\User\Profile\UpdateProfileRequest;
use App\Http\Requests\User\Profile\UploadProfilePhotoRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

/**
 * Profil işlemleri
 */
class ProfileController extends Controller
{
    public function __construct(
        private readonly ProfileServiceInterface $profileService
    ) {}

    /**
     * Profil bilgilerini güncelle
     */
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

    /**
     * Profil fotoğrafı yükle
     */
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
                'photo_url' => asset('storage/' . $path)
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Profil fotoğrafı yüklenemedi'
        ], 400);
    }

    /**
     * Şifre değiştir
     */
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

    /**
     * Favorileri getir
     */
    public function getFavorites(Request $request)
    {
        $favorites = $this->profileService->getFavorites($request->user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $favorites
        ]);
    }

    /**
     * Karşılaştırmaları getir
     */
    public function getComparisons(Request $request)
    {
        $comparisons = $this->profileService->getComparisons($request->user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $comparisons
        ]);
    }

    /**
     * Favorilere ekle/çıkar
     */
    public function toggleFavorite(Request $request, string $placeId)
    {
        $result = $this->profileService->toggleFavorite($request->user()->id, $placeId);
        return response()->json([
            'status' => 'success',
            'data' => $result
        ]);
    }

    /**
     * Karşılaştırmalara ekle/çıkar
     */
    public function toggleComparison(Request $request, string $placeId)
    {
        $result = $this->profileService->toggleComparison($request->user()->id, $placeId);
        return response()->json([
            'status' => 'success',
            'data' => $result
        ]);
    }

    /**
     * Listeleri kontrol et
     */
    public function checkLists(Request $request, string $placeId)
    {
        $result = $this->profileService->checkLists($request->user()->id, $placeId);
        return response()->json([
            'status' => 'success',
            'data' => $result
        ]);
    }
}
