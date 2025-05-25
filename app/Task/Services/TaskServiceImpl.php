<?php

namespace App\Task\Services;

use App\Task\DTOs\TaskDTO;
use App\Task\Models\Task;
use App\Task\Repositories\TaskRepository;
use App\Task\TaskService;

class TaskServiceImpl implements TaskService
{
    public function __construct(
        private readonly TaskRepository $taskRepository
    ) {}
    public function create(TaskDTO $taskDTO): void
    {
        $this->taskRepository->create(new Task((array)$taskDTO));
    }

    public function update(TaskDTO $taskDTO): void
    {
        $this->taskRepository->update(new Task((array)$taskDTO));
    }

    public function delete(TaskDTO $taskDTO): void
    {
        if ()
        $this->taskRepository->delete()
    }

    public function get(int $id): TaskDTO
    {
        $task = $this->taskRepository->findById($id);

        if ($task) {
            return new TaskDTO();
        }
    }

    public function getAll(int $user_id): array
    {
        // TODO: Implement getAll() method.
    }

    private function isUserOwner(TaskDTO $taskDTO): bool
    {
        $task = $this->get($taskDTO->userId);
        return $taskDTO->userId === $task->userId;
    }
}
