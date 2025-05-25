<?php

namespace App\Task\Http\Resources;

use App\Task\DTOs\TaskDTO;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin TaskDTO  // Это подскажет IDE, что $this - это Task
 */
class TaskResource extends JsonResource
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
            'title' => $this->title,
            'details' => $this->details,
            'is_completed' => $this->isCompleted,
            'priority' => $this->priority,
            'deadline' => $this->deadline,
            'closed_at' => $this->closedAt,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'time_spent' => $this->timeSpent,
            'user_id' => $this->userId
        ];
    }
}
