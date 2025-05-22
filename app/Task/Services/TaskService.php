<?php

namespace App\Task;

interface TaskService
{
    public function create(TaskDTO $taskDTO): bool;
    public function update(TaskDTO $taskDTO): bool;
    public function delete(TaskDTO $taskDTO): bool;
    public function get(int $id): TaskDTO;
    public function getAll(int $user_id): array;
}
