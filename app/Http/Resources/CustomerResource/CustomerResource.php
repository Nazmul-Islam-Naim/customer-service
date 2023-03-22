<?php

namespace App\Http\Resources\CustomerResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'address' => $this->address,
            'area_name' => $this->area->name,
            'area_id' => $this->area_id,
            'allareas' => auth()->user()->areas()->select('areas.id','areas.name')->get(),
            'business_cat_name' => $this->businessCategory->name,
            'business_cat_id' => $this->business_cat_id,
            'product_id' => $this->products()->select('products.id','products.name')->get()
        ];
    }
}
