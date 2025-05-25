<?php

namespace App\Task\Services;

use App\Task\DTOs\TaskDTO;
use App\Task\Exceptions\TaskNotFoundException;
use App\Task\Models\Task;
use App\Task\Repositories\TaskRepository;
use App\Task\TaskService;

class TaskServiceImpl implements TaskService
{
    public function __construct(
        private readonly TaskRepository $taskRepository
    )
    {
    }

    public function create(TaskDTO $taskDTO): void
    {
        $this->taskRepository->create(new Task((array)$taskDTO));
    }

    public function update(TaskDTO $taskDTO): void
    {
        $this->taskRepository->update(TaskDTO::toModel($taskDTO));
    }

    public function delete(int $id, int $userId): void
    {
        if ()
            $this->taskRepository->delete()
    }

    /**
     * @throws TaskNotFoundException
     */
    public function get(int $id, int $userId): TaskDTO
    {
        $task = $this->taskRepository->findById($id);


        return $task ?
            TaskDTO::toDTO($task)
            : throw new TaskNotFoundException("Task not found");
    }

    public function getAll(int $user_id): array
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @throws TaskNotFoundException
     */
    private function isUserOwner(TaskDTO $taskDTO): bool
    {
        $task = $this->get($taskDTO->id);
        return $taskDTO->userId === $task->userId;
    }
}
