<?php

namespace App\Task\Http\Controllers;

use App\Http\Controllers\Controller;
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

    public function store(CreateTaskRequest $createTaskRequest)
    {

    }

    public function update(UpdateTaskRequest $updateTaskRequest)
    {

    }

    public function destroy($id)
    {

    }
}
