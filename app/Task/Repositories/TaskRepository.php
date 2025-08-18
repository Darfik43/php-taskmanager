<?php

namespace App\Task\Repositories;

use App\Task\Models\Task;

interface TaskRepository
{
    public function create(Task $task): Task;
    public function update(Task $task): Task;
    public function delete(int $id): int;
    public function findById(int $id): ?Task;
    public function findShortAllByUser(int $userId): array;
}
