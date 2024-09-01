<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subordinate extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id'];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public static function store($request, $id = null){
        $data = $request->only('user_id');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }
}
