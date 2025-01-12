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
    {
        $result = $this->profileService->update(
            UpdateProfileDTO::fromRequest($request->validated())
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Profil bilgileriniz güncellendi',
            'user' => $result['user']
        ]);
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $this->profileService->changePassword(
            ChangePasswordDTO::fromRequest($request->validated())
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Şifreniz başarıyla güncellendi'
        ]);
    }
}
