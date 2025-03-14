<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeterResource extends JsonResource
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
            'user_id' => $this->user_id,
            'meter_number' => $this->meter_number,
            'meter_type' => $this->meter_type,
            'location' => $this->location,
            'status' => $this->status,
            'last_reading' => $this->last_reading,
            'last_reading_date' => $this->last_reading_date,
            'installation_date' => $this->installation_date,
            'is_validated' => $this->is_validated,
            'validation_date' => $this->validation_date,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => $this->when($this->relationLoaded('user'), new UserResource($this->user)),
        ];
    }
}

