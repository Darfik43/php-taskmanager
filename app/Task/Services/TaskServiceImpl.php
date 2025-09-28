<?php

namespace App\Task\Services;


use App\Task\DTOs\TaskDTO;
use App\Task\DTOs\TaskReadDTO;
use App\Task\Exceptions\TaskNotFoundException;
use App\Task\Mappers\TaskMapper;
use App\Task\Repositories\TaskRepository;

class TaskServiceImpl implements TaskService
{
    public function __construct(private readonly TaskRepository $repository) {}

    public function create(int $userId, TaskDTO $dto): TaskReadDTO
    {
        $task = $this->repository->create($dto, $userId);
        return TaskMapper::toReadDTO($task);
    }

    /**
     * @throws TaskNotFoundException
     */
    public function update(int $id, int $userId, TaskDTO $dto): TaskReadDTO
    {
        $task = $this->repository->findByIdAndUser($id, $userId);
        if (!$task) throw new TaskNotFoundException("Task not found");

        $updated = $this->repository->update($id, $userId, $dto);
        return TaskMapper::toReadDTO($updated);
    }

    /**
     * @throws TaskNotFoundException
     */
    public function delete(int $id, int $userId): void
    {
        $task = $this->repository->findByIdAndUser($id, $userId);
        if (!$task) throw new TaskNotFoundException("Task not found");

        $this->repository->delete($id, $userId);
    }

    /**
     * @throws TaskNotFoundException
     */
    public function get(int $id, int $userId): TaskReadDTO
    {
        $task = $this->repository->findByIdAndUser($id, $userId);
        if (!$task) throw new TaskNotFoundException("Task not found");

        return TaskMapper::toReadDTO($task);
    }

    public function getAllByUser(int $userId): array
    {
        $tasks = $this->repository->findAllByUser($userId);
        return array_map(fn($task) => TaskMapper::toReadDTO($task), $tasks);
    }
}
