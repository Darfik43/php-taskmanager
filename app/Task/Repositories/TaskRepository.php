<?php

namespace App\Task\Repositories;

use App\Task\Models\Task;

interface TaskRepository
{
    public function create(Task $task): bool;
    public function update(Task $task): int;
    public function delete(int $id): int;
    public function findById(int $id): ?Task;
    public function findAll(int $user_id): array;
}
