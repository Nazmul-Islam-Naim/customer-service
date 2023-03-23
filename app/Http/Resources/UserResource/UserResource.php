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
        // dd($this->areas);
        // $areas = [];
        // foreach ($this->areas as $value) {
        //     $areas[] = $value->name;
        // }
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
            'target' => $this->target,
            'status' => $this->status,
        ];
    }
}
