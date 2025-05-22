<?php

namespace App\Task;

use App\Task\DTOs\TaskDTO;

interface TaskService
{
    public function create(TaskDTO $taskDTO): void;
    public function update(TaskDTO $taskDTO): void;
    public function delete(TaskDTO $taskDTO): void;
    public function get(int $id): TaskDTO;
    public function getAll(int $user_id): array;
}
