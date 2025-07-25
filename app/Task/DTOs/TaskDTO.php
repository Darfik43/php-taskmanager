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
        public bool $isCompleted,
        public Priority $priority,
        public \DateTime $deadline,
        public ?\DateTime $closedAt,
        public \DateTime $createdAt,
        public \DateTime $updatedAt,
        public ?int $timeSpent,
        public int $userId,
    ) {}

    // prob methods below should be moved to another class in future to fabric class
    public static function toDTO(Task $task): TaskDTO
    {
        return new TaskDTO(
            id: $task->id,
            title: $task->title,
            details: $task->details,
            isCompleted: $task->is_completed,
            priority: $task->priority,
            deadline: $task->deadline,
            closedAt: $task->closed_at,
            createdAt: $task->created_at,
            updatedAt: $task->updated_at,
            timeSpent: $task->time_spent,
            userId: $task->user_id
        );
    }

    public static function toModel(TaskDTO $taskDTO): Task
    {
        return new Task([
            'id' => $taskDTO->id,
            'title' => $taskDTO->title,
            'details' => $taskDTO->details,
            'is_completed' => $taskDTO->isCompleted,
            'priority' => $taskDTO->priority,
            'deadline' => $taskDTO->deadline,
            'closed_at' => $taskDTO->closedAt,
            'created_at' => $taskDTO->createdAt,
            'updated_at' => $taskDTO->updatedAt,
            'time_spent' => $taskDTO->timeSpent,
            'user_id' => $taskDTO->userId
            ]);
    }

    public static function make(array $data): TaskDTO
    {
        return new TaskDTO(
            id: $data['id'],
            title: $data['title'],
            details: $data['details'],
            isCompleted: $data['is_completed'],
            priority: $data['priority'],
            deadline: $data['deadline'],
            closedAt: $data['closed_at'],
            createdAt: $data['created"at'],
            updatedAt: $data['updated_at'],
            timeSpent: $data['time_spent'],
            userId: $data['user_id'],
        );
    }
}
