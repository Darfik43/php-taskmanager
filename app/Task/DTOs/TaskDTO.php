<?php

namespace App\Task\DTOs;

use App\Task\Enums\Priority;
use App\Task\Models\Task;

readonly class TaskDTO
{
    private function __construct(
        public int $id,
        public string $title,
        public string $details,
        public Priority $priority,
        public \DateTime $deadline,
        public \DateTime $closedAt,
        public \DateTime $createdAt,
        public \DateTime $updatedAt,
        public int $timeSpent,
        public int $userId,
    ) {}

    public function toDTO(Task $task): TaskDTO
    {
        return new TaskDTO(
            id: $task->id,
            title: $task->title,
            details: $task->details,
            priority: $task->priority,
            deadline: $task->deadline,
            closedAt: $task->closed_at,
            createdAt: $task->created_at,
            updatedAt: $task->updated_at,
            timeSpent: $task->time_spent,
            userId: $task->user_id
        );
    }

    public function toModel(TaskDTO $taskDTO): Task
    {
        return new Task([
            'id' => $taskDTO->id,
            'title' => $taskDTO->title,
            'details' => $taskDTO->details,
            'priority' => $taskDTO->priority,
            'deadline' => $taskDTO->deadline,
            'closed_at' => $taskDTO->closed_at,
            'created_at' => $taskDTO->created_at,
            'updated_at' => $taskDTO->updated_at,
            'time_spent' => $taskDTO->time_spent,
            'user_id' => $taskDTO->user_id
            ]);
    }
}
