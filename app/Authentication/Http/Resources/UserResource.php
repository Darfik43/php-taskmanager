<?php

namespace App\Authentication\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
          'id' => $this->id,
          'email' => $this->email,
        ];
    }
}
