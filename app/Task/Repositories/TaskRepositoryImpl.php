<?php

namespace App\Task\Repositories;

use App\Task\DTOs\TaskDTO;
use App\Task\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskRepositoryImpl implements TaskRepository
{
    public function create(TaskDTO $dto, int $userId): Task
    {
        $id = DB::table('tasks')->insertGetId([
            'user_id'     => $userId,
            'title'       => $dto->title,
            'details'     => $dto->details,
            'priority'    => $dto->priority->value,
            'is_completed'=> $dto->isCompleted,
            'deadline'    => $dto->deadline?->format('Y-m-d H:i:s'),
            'time_spent'  => $dto->timeSpent,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return $this->findByIdAndUser($id, $userId);
    }

    public function update(int $id, int $userId, TaskDTO $dto): Task
    {
        DB::table('tasks')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->update([
                'title'        => $dto->title,
                'details'      => $dto->details,
                'priority'     => $dto->priority->value,
                'is_completed' => $dto->isCompleted,
                'deadline'     => $dto->deadline?->format('Y-m-d H:i:s'),
                'time_spent'   => $dto->timeSpent,
                'updated_at'   => now(),
            ]);

        return $this->findByIdAndUser($id, $userId);
    }

    public function delete(int $id, int $userId): void
    {
        DB::table('tasks')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->delete();
    }

    public function findByIdAndUser(int $id, int $userId): ?Task
    {
        $data = DB::table('tasks')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        return $data ? $this->hydrateTask((array)$data) : null;
    }

    public function findAllByUser(int $userId): array
    {
        $results = DB::table('tasks')
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();

        $tasks = [];
        foreach ($results as $result) {
            $tasks[] = $this->hydrateTask((array)$result);
        }

        return $tasks;
    }

    private function hydrateTask(array $data): Task
    {
        $task = new Task();
        $task->id = (int)$data['id'];
        $task->user_id = (int)$data['user_id'];
        $task->title = $data['title'];
        $task->details = $data['details'] ?? null;
        $task->priority = isset($data['priority']) ? (int)$data['priority'] : 0;
        $task->is_completed = (bool)($data['is_completed'] ?? false);
        $task->deadline = isset($data['deadline']) ? new \DateTimeImmutable($data['deadline']) : null;
        $task->closed_at = isset($data['closed_at']) ? new \DateTimeImmutable($data['closed_at']) : null;
        $task->created_at = isset($data['created_at']) ? new \DateTimeImmutable($data['created_at']) : null;
        $task->updated_at = isset($data['updated_at']) ? new \DateTimeImmutable($data['updated_at']) : null;
        $task->time_spent = isset($data['time_spent']) ? (int)$data['time_spent'] : null;

        return $task;
    }
}
