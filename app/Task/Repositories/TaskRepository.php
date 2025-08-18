<?php

namespace App\Task\Repositories;

use App\Task\DTOs\TaskDTO;
use App\Task\Models\Task;

interface TaskRepository
{
    public function create(TaskDTO $dto, int $userId): Task;
    public function update(int $id, int $userId, TaskDTO $dto): Task;
    public function delete(int $id, int $userId): void;
    public function findAllByUser(int $userId): array;
    public function findByIdAndUser(int $id, int $userId): ?Task;
}
