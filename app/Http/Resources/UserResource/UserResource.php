<?php

namespace App\Http\Resources\UserResource;

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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role->title,
            'department' => $this->department->title,
            'designation' => $this->designation->title,
            'area' => $this->area->name,
            'address' => $this->area->name,
            'district' => $this->area->district->name,
            'division' => $this->area->district->division->name,
            'avatar' => $this->avatar,
            'status' => $this->status,
        ];
    }
}
