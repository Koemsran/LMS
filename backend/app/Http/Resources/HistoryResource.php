<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
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
            'user_name' => $this->user->name,
            'user_id' => $this->user->id,
            'leave_type' => $this->leave->leaveType->name,
            'date_from' => $this->leave->date_from,
            'date_to' => $this->leave->date_to,
            'status' => $this->leave->status,
            'reason' => $this->leave->reason,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
