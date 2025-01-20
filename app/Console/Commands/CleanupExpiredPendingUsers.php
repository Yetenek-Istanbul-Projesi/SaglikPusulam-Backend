<?php

namespace App\Console\Commands;

use App\Models\PendingUser;
use Illuminate\Console\Command;

class CleanupExpiredPendingUsers extends Command
{
    protected $signature = 'users:cleanup-pending';
    protected $description = 'Cleanup expired pending user records';

    public function handle()
    {
        $deleted = PendingUser::where('codes_expire_at', '<', now())
            ->orWhere('created_at', '<', now()->subDay())
            ->delete();

        $this->info("Deleted {$deleted} expired pending user records.");
    }
}
