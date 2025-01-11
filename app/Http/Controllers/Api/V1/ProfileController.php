<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\Services\ProfileServiceInterface;
use App\DTOs\Profile\UpdateProfileDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function __construct(
        private readonly ProfileServiceInterface $profileService
    ) {}

    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $user = auth()->user();
        $dto = UpdateProfileDTO::fromRequest($request->validated());
        
        $updatedUser = $this->profileService->updateProfile($user, $dto);

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $updatedUser
        ]);
    }
}
