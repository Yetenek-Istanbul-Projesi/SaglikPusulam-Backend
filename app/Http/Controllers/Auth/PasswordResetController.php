<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\PasswordReset\ForgotPasswordDTO;
use App\DTOs\PasswordReset\ResetPasswordDTO;
use App\Http\Controllers\Controller;
use App\Services\PasswordResetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PasswordResetController extends Controller
{
    public function __construct(
        private readonly PasswordResetService $passwordResetService
    ) {}

    public function forgotPassword(ForgotPasswordDTO $dto): JsonResponse
    {
        try {
            $this->passwordResetService->sendResetLink($dto);
            
            return response()->json([
                'message' => 'Password reset link has been sent'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error sending reset link',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function reset(ResetPasswordDTO $dto): JsonResponse
    {
        try {
            $this->passwordResetService->reset($dto);
            
            return response()->json([
                'message' => 'Password has been reset successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error resetting password',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
