<?php

namespace App\Task\Services;

use App\Task\DTOs\ShortTaskDTO;
use App\Task\DTOs\TaskDTO;
use App\Task\Exceptions\TaskNotFoundException;
use App\Task\Models\Task;
use App\Task\Repositories\TaskRepository;

class TaskServiceImpl implements TaskService
{
    public function __construct(
        private readonly TaskRepository $taskRepository
    )
    {
    }


    public function create(TaskDTO $taskDTO): void
    {
            $this->taskRepository->create(TaskDTO::toModel($taskDTO));
    }

    /**
     * @throws TaskNotFoundException
     */
    public function update(TaskDTO $taskDTO): void
    {
        $task = $this->taskRepository->findById($taskDTO->id);

        $this->isUserOwner($taskDTO->userId, $task)
            ? $this->taskRepository->update(TaskDTO::toModel($taskDTO))
            : throw new TaskNotFoundException("Task not found");
    }


    /**
     * @throws TaskNotFoundException
     */
    public function delete(int $id, int $userId): void
    {
        $task = $this->taskRepository->findById($id);

        $this->isUserOwner($userId, $task)
            ? $this->taskRepository->delete($id)
            : throw new TaskNotFoundException("Task not found");
    }

    /**
     * @throws TaskNotFoundException
     */
    public function get(int $id, int $userId): TaskDTO
    {
        $task = $this->taskRepository->findById($id);

        if ($task && $this->isUserOwner($userId, $task)) {
            return TaskDTO::toDTO($task);
        } else
            throw new TaskNotFoundException("Task not found");
    }

    public function getShortAllByUser(int $user_id): array
    {
        $taskList = $this->taskRepository->findShortAllByUser($user_id);

        $result = [];
        foreach ($taskList as $task) {
            $result[] = ShortTaskDTO::toDTO($task);
        }

        return $result;
    }

    private function isUserOwner(int $userId, Task $task): bool
    {
        return $userId === $task->user_id;
    }
}
