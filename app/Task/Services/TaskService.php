<?php

namespace App\Task\Services;

use App\Task\DTOs\TaskDTO;

interface TaskService
{
    public function create(TaskDTO $taskDTO): TaskDTO;
    public function update(TaskDTO $taskDTO): void;
    public function delete(int $id, int $userId): void;
    public function get(int $id, int $userId): TaskDTO;
    public function getShortAllByUser(int $user_id): array;
}
