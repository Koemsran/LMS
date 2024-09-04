<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{
    return [
        "id" => $this->id,
        "name" => $this->name,
        "email" => $this->email,
        "profile" => $this->profile,
        "leave_balance" => $this->leave_balance,
        'created_at' => $this->created_at->format('d-m-Y'),
        'updated_at' => $this->updated_at->format('d-m-Y'),
        'roles' => $this->roles->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
            ];
        }),
    ];
}

}
