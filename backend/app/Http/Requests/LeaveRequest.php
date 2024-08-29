<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRequest extends DefaultRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' =>'required|exists:users,id',
            'leave_type_id' =>'required|exists:leave_types,id',
            'date_from' => 'required|date',
            'date_to' => 'required|date|after:start_date',
        ];
    }
}
