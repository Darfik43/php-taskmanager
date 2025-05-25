<?php

namespace App\Task\Http\Resources;

use App\Task\DTOs\ShortTaskDTO;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @mixin ShortTaskDTO
 */
class ShortTaskCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
