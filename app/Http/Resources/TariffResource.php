<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TariffResource extends JsonResource
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
            'description' => $this->description,
            'rate_per_unit' => $this->rate_per_unit,
            'min_units' => $this->min_units,
            'max_units' => $this->max_units,
            'tax_percentage' => $this->tax_percentage,
            'service_fee' => $this->service_fee,
            'is_active' => $this->is_active,
            'effective_from' => $this->effective_from,
            'effective_to' => $this->effective_to,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

