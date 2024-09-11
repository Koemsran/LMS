<?php

namespace App\Http\Resources;

use App\Models\Subordinate;
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
        $managerId = Subordinate::where('subordinator_id', $this->user->id)->value('manager_id');
        return [
            "id"=>$this->id,
            "user_name"=>$this->user->name,
            "user_id"=>$this->user->id,
            "manager_id"=>$managerId,
            "profile"=>$this->user->profile,
            "leave_type"=>$this->leaveType->name,
            "date_from"=>$this->date_from,
            "date_to"=>$this->date_to,
            "duration"=>$this->formatDuration($this->duration),
            "status"=>$this->status,
            "reason"=>$this->reason,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }
    protected function formatDuration($duration)
{
    // Check if duration has a decimal part of .00
    if (strpos($duration, '.00') !== false) {
        return rtrim(rtrim($duration, '0'), '.');
    }
    return $duration;
}
}
