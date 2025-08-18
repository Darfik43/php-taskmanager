<?php

namespace App\Task\Mappers;

use App\Task\DTOs\TaskReadDTO;
use App\Task\Models\Task;

class TaskMapper
{
    public static function toReadDTO(Task $task): TaskReadDTO
    {
        return new TaskReadDTO(
            id: $task->id,
            title: $task->title,
            details: $task->details,
            priority: $task->priority,
            isCompleted: $task->is_completed,
            deadline: $task->deadline,
            closedAt: $task->closed_at,
            createdAt: $task->created_at,
            updatedAt: $task->updated_at,
            timeSpent: $task->time_spent,
            userId: $task->user_id,
        );
    }
}
