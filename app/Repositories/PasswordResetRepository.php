<?php

namespace App\Repositories;

use App\Contracts\Repositories\IPasswordResetRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordResetRepository implements IPasswordResetRepository
{
    public function createToken(string $identifier): string
    {
        $token = Str::random(60);
        
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $identifier],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        return $token;
    }

    public function findValidToken(string $identifier, string $token): ?object
    {
        return DB::table('password_reset_tokens')
            ->where('email', $identifier)
            ->where('token', $token)
            ->where('created_at', '>', Carbon::now()->subHours(1))
            ->first();
    }

    public function deleteToken(string $identifier): void
    {
        DB::table('password_reset_tokens')
            ->where('email', $identifier)
            ->delete();
    }
}
