<?php

namespace App\Repositories;

use App\Models\Task;

interface TaskRepository
{
    public function create(TaskDTO $taskDTO): Task;
    public function update(TaskDTO $taskDTO): Task;
    public function delete(TaskDTO $taskDTO): void;
    public function find(TaskDTO $taskDTO): Task;
}
