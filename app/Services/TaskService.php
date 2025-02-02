<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function createTask($request): Task {
        return Task::create($request);
    }
}
