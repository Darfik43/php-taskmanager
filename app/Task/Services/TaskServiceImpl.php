<?php

namespace App\Task\Services;

use App\Task\DTOs\TaskDTO;
use App\Task\Repositories\TaskRepository;
use App\Task\TaskService;

class TaskServiceImpl implements TaskService
{
    public function __construct(
        private readonly TaskRepository $taskRepository
    ) {}
    public function create(TaskDTO $taskDTO): void
    {
        // TODO: Implement create() method.
    }

    public function update(TaskDTO $taskDTO): void
    {
        // TODO: Implement update() method.
    }

    public function delete(TaskDTO $taskDTO): void
    {
        // TODO: Implement delete() method.
    }

    public function get(int $id): TaskDTO
    {
        // TODO: Implement get() method.
    }

    public function getAll(int $user_id): array
    {
        // TODO: Implement getAll() method.
    }

}
