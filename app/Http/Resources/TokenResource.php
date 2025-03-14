<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
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
            'meter_id' => $this->meter_id,
            'transaction_id' => $this->transaction_id,
            'token_number' => $this->token_number,
            'units' => $this->units,
            'amount' => $this->amount,
            'status' => $this->status,
            'generated_at' => $this->generated_at,
            'used_at' => $this->used_at,
            'expires_at' => $this->expires_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => $this->when($this->relationLoaded('user'), new UserResource($this->user)),
            'meter' => $this->when($this->relationLoaded('meter'), new MeterResource($this->meter)),
            'transaction' => $this->when($this->relationLoaded('transaction'), new TransactionResource($this->transaction)),
        ];
    }
}

