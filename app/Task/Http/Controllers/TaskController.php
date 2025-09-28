<?php

namespace App\Task\Http\Controllers;

use App\Authentication\Http\Controllers\Controller;
use App\Task\DTOs\TaskDTO;
use App\Task\Http\Requests\CreateTaskRequest;
use App\Task\Http\Requests\UpdateTaskRequest;
use App\Task\Http\Resources\ShortTaskCollection;
use App\Task\Http\Resources\TaskResource;
use App\Task\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService
    ) {}

    public function index(): JsonResponse
    {
        $tasks = $this->taskService->getAllByUser(auth()->id());
        return response()->json(TaskResource::collection($tasks));
    }

    public function show(int $id): JsonResponse
    {
        $task = $this->taskService->get($id, auth()->id());
        return response()->json(new TaskResource($task));
    }

    public function store(CreateTaskRequest $request): JsonResponse
    {
        $dto = TaskDTO::make($request->validated());
        $task = $this->taskService->create(auth()->id(), $dto);

        return response()->json(new TaskResource($task), 201);
    }

    public function update(UpdateTaskRequest $request, int $id): JsonResponse
    {
        $dto = TaskDTO::make($request->validated());
        $task = $this->taskService->update($id, auth()->id(), $dto);

        return response()->json(new TaskResource($task));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->taskService->delete($id, auth()->id());
        return response()->json(null, 204);
    }
}
