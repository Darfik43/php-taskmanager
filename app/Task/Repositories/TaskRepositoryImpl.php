<?php

namespace App\Task\Repositories;

use App\Repositories\TaskDTO;
use App\Task\Models\Task;

class TaskRepositoryImpl implements TaskRepository
{

    public function create(TaskDTO $taskDTO): Task
    {
        $sql = "INSERT INTO tasks ()"
    }

    public function update(TaskDTO $taskDTO): Task
    {
        // TODO: Implement update() method.
    }

    public function delete(TaskDTO $taskDTO): void
    {
        // TODO: Implement delete() method.
    }

    public function find(TaskDTO $taskDTO): Task
    {
        // TODO: Implement find() method.
    }

    public function findAll(TaskDTO $taskDTO): array
    {
        // TODO: Implement find() method.
    }
}
