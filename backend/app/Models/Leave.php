<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'leave_type_id','date_from', 'date_to', 'duration', 'reason' ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function leaveType(){
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }
    public static function store($request, $id=null){

        $data = $request->only('user_id','leave_type_id','date_from', 'date_to', 'duration', 'reason' );
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;

    }
}
