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
        $target = $this->target()->where('user_id',$this->id)->first();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role->title,
            'designation' => $this->designation->title,
            'division' => $this->division->name,
            'district' => $this->district->name,
            'area' => $this->areas()->select('areas.id','areas.name')->get(),
            'avatar' => $this->avatar,
            'nid' => $this->nid,
            'month' => $target->month,
            'year' => $target->year,
            'target' => $target->target,
            'recovery' => $target->recovery,
            'status' => $this->status,
        ];
    }
}
