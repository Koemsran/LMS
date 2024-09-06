<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'token_balance', 'leave_balance'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function store($request, $userId = null)
    {
        // Get the required data from the request except user_id
        $data = $request->only('user_id','token_balance', 'leave_balance');

        // Use updateOrCreate to either update or create the leave balance for the given user_id
        $leaveBalance = self::updateOrCreate(
            ['user_id' => $userId], // Condition to find the record
            $data // Data to update or create
        );

        return $leaveBalance;
    }
}
