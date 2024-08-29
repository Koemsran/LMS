<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "user_name"=>$this->user->name,
            "leave_type"=>$this->leaveType->name,
            "date_from"=>$this->date_from,
            "date_to"=>$this->date_to,
            "duration"=>$this->duration,
            "reason"=>$this->reason,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
