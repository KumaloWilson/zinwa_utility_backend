<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'reference' => $this->reference,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
            'payment_provider' => $this->payment_provider,
            'status' => $this->status,
            'currency' => $this->currency,
            'description' => $this->description,
            'metadata' => $this->metadata,
            'completed_at' => $this->completed_at,
            'refunded_at' => $this->refunded_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => $this->when($this->relationLoaded('user'), new UserResource($this->user)),
            'meter' => $this->when($this->relationLoaded('meter'), new MeterResource($this->meter)),
            'token' => $this->when($this->relationLoaded('token'), function () {
                return $this->token ? new TokenResource($this->token) : null;
            }),
        ];
    }
}

