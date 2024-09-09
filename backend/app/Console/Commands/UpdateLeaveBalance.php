<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class UpdateLeaveBalance extends Command
{
    protected $signature = 'leave:update-balance';
    protected $description = 'Update leave balance for all users by adding 2 days if a month has passed since last update';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::all();
        $currentDate = Carbon::now();

        foreach ($users as $user) {
            // Check if a month has passed since the last update
            if (!$user->last_leave_update || $currentDate->diffInMonths($user->last_leave_update) >= 1) {
                // Increment leave_balance by 2 days
                $user->leave_balance = ($user->leave_balance ?? 0) + 2;
                // Update the last update timestamp
                $user->last_leave_update = $currentDate;
                $user->save();
            }
        }

        $this->info('Leave balances updated successfully.');
    }
}
