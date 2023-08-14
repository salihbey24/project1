<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSubscribeResource extends JsonResource
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
          'subscription_id' => $this->subscription_id,
          'renewed_at' => $this->renewed_at->format('Y-m-d H:i:s'),
          'expired_at' => $this->expired_at->format('Y-m-d H:i:s'),
        ];
    }
}
