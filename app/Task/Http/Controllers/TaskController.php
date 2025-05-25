<?php

namespace App\Task\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Task\Http\Requests\CreateTaskRequest;
use App\Task\Http\Requests\UpdateTaskRequest;
use App\Task\Http\Resources\TaskCollection;
use App\Task\Http\Resources\TaskResource;
use App\Task\TaskService;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService
    ) {}

    public function index(): TaskCollection
    {

    }

    public function show(int $id): TaskResource
    {

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
