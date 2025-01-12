<?php

namespace App\Contracts\Repositories;

interface IPasswordResetRepository
{
    public function createToken(string $identifier): string;
    public function findValidToken(string $identifier, string $token): ?object;
    public function deleteToken(string $identifier): void;
}
