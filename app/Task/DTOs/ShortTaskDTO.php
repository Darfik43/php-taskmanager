<?php

namespace App\Task\DTOs;

use App\Task\Enums\Priority;
use App\Task\Models\Task;

class ShortTaskDTO
{
    private function __construct(
        public int $id,
        public string $title,
        public bool $isCompleted,
        public Priority $priority,
    ) {}

    // prob methods below should be moved to another class in future to fabric class
    public static function toDTO(Task $task): ShortTaskDTO
    {
        return new ShortTaskDTO(
            id: $task->id,
            title: $task->title,
            isCompleted: $task->is_completed,
            priority: $task->priority,
        );
    }

    public static function toModel(ShortTaskDTO $taskDTO): Task
    {
        return new Task([
            'id' => $taskDTO->id,
            'title' => $taskDTO->title,
            'is_completed' => $taskDTO->isCompleted,
            'priority' => $taskDTO->priority,
        ]);
    }

    public static function make(array $data): ShortTaskDTO
    {
        return new ShortTaskDTO(
            id: $data['id'],
            title: $data['title'],
            isCompleted: $data['is_completed'],
            priority: $data['priority'],
        );
    }
}
