<?php

namespace App\Task\Repositories;

use App\Repositories\TaskDTO;
use App\Task\Models\Task;

interface TaskRepository
{
    public function create(TaskDTO $taskDTO): Task;
    public function update(TaskDTO $taskDTO): Task;
    public function delete(TaskDTO $taskDTO): void;
    public function find(TaskDTO $taskDTO): Task;
    public function findAll(TaskDTO $taskDTO): array;
}
