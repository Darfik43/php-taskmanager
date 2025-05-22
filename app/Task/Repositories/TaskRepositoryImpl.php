<?php

namespace App\Task\Repositories;

use App\Task\Models\Task;

class TaskRepositoryImpl implements TaskRepository
{

    public function create(Task $task): Task
    {
        $sql = "INSERT INTO tasks ()"
    }

    public function update(Task $task): Task
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }

    public function findById(int $id): ?Task
    {
        // TODO: Implement find() method.
    }

    public function findAll(int $user_id): array
    {
        // TODO: Implement find() method.
    }
}
