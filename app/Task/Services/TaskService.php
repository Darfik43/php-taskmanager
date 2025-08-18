<?php

namespace App\Task\Services;

use App\Task\DTOs\TaskDTO;
use App\Task\DTOs\TaskReadDTO;

interface TaskService
{
    public function create(int $userId, TaskDTO $taskDTO): TaskReadDTO;
    public function update(int $id, int $userId, TaskDTO $dto): TaskReadDTO;
    public function delete(int $id, int $userId): void;
    public function get(int $id, int $userId): TaskReadDTO;
    public function getAllByUser(int $user_id): array;
}
