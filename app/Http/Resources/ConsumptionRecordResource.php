<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsumptionRecordResource extends JsonResource
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
            'meter_id' => $this->meter_id,
            'token_id' => $this->token_id,
            'reading' => $this->reading,
            'units_consumed' => $this->units_consumed,
            'reading_date' => $this->reading_date,
            'reading_type' => $this->reading_type,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'meter' => $this->when($this->relationLoaded('meter'), new MeterResource($this->meter)),
            'token' => $this->when($this->relationLoaded('token'), function () {
                return $this->token ? new TokenResource($this->token) : null;
            }),
        ];
    }
}

