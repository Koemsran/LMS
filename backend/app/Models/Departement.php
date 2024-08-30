<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name'];

    public static function store($request, $id=null){
        $data = $request->only('name');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }
}
