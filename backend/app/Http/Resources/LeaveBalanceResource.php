<?php

namespace App\Http\Resources;

use App\Models\Subordinate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveBalanceResource extends JsonResource
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
            'id' => $this->id,
            'user_id' => $this->user->id,
            'manager_id' => $managerId,
            'user_name' => $this->user->name,
            'joining_date' => $this->user->created_at->format('d-m-Y'),
            'total_leave' => $this->user->leave_balance,
            'token_balance' => $this->token_balance,
            'leave_balance' => $this->leave_balance,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
