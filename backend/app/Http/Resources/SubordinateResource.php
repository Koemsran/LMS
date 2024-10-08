<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubordinateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'namager' => $this->manager->name,
            'namager_email' => $this->manager->email,
            'subordinator' => $this->subordinator->name,
            'subordinator_email' => $this->subordinator->email,
            'subordinator_balance' => $this->subordinator->leave_balance,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
