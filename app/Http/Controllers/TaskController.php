<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use App\Task\Models\Task;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService
    ) {}

    public function store(TaskRequest $request): Task
    {
        return $this->taskService->createTask($request->validated());
    }
}
