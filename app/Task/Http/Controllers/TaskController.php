<?php

namespace App\Task\Http\Controllers;

use App\Authentication\Http\Controllers\Controller;
use App\Task\DTOs\TaskDTO;
use App\Task\Http\Requests\CreateTaskRequest;
use App\Task\Http\Requests\UpdateTaskRequest;
use App\Task\Http\Resources\ShortTaskCollection;
use App\Task\Http\Resources\TaskResource;
use App\Task\Services\TaskService;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService
    ) {}

    public function index(): ShortTaskCollection
    {
        $result = $this->taskService->getShortAllByUser(auth()->id());
        return new ShortTaskCollection($result);
    }

    public function show(int $id): TaskResource
    {
        return new TaskResource($this->taskService->get($id, auth()->id()));
    }

    public function store(CreateTaskRequest $createTaskRequest): void
    {
        $this->taskService->create(TaskDTO::make($createTaskRequest->toArray()));
    }

    public function update(UpdateTaskRequest $updateTaskRequest): void
    {
        $this->taskService->update(TaskDTO::make($updateTaskRequest->toArray()));
    }

    public function destroy($id): void
    {
        $this->taskService->delete($id, auth()->id());
    }
}
