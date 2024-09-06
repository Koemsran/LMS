<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubordinateRequest extends DefaultRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'manager_id' =>'required|exists:users,id',
            'subordinator_id' =>'required|exists:users,id',
        ];
    }
}
