<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subordinate extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'manager_id', 'subordinator_id'];
    public function manager(){
        return $this->belongsTo(User::class, 'manager_id');
    }
    public function subordinator(){
        return $this->belongsTo(User::class, 'subordinator_id');
    }
    public static function store($request, $id = null){
        $data = $request->only('manager_id', 'subordinator_id');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }
}
