<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'leave_id'];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function leave(){
        return $this->belongsTo(Leave::class, 'leave_id');
    }
    public static function store($request, $id=null){

        $data = $request->only('user_id','leave_id');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;

    }
}
