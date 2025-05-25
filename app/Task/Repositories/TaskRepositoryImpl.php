<?php

namespace App\Task\Repositories;

use App\Task\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskRepositoryImpl implements TaskRepository
{

    public function create(Task $task): bool
    {
        return DB::insert("
            INSERT INTO tasks (user_id,
                               title,
                               details,
                               priority,
                               is_completed,
                               deadline,
                               time_spent,
                               created_at,
                               updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?,?, NOW(), NOW())
        ", [
            $task->user_id,
            $task->title,
            $task->details,
            $task->priority,
            $task->is_completed,
            $task->deadline,
            $task->time_spent,
        ]);


    }

    public function update(Task $task): int
    {
        return DB::update("
            UPDATE tasks
            SET
                title = ?,
                details = ?,
                priority = ?,
                is_completed = ?,
                deadline = ?,
                time_spent = ?,
                updated_at = NOW()
            WHERE id = ?
        ", [
            $task->title,
            $task->details,
            $task->priority,
            $task->is_completed,
            $task->deadline,
            $task->time_spent,
            $task->id
        ]);
    }

    public function delete(int $id): int
    {
        return DB::delete(
            "DELETE FROM tasks WHERE id = ?",
            [$id]
        );

    }

    public function findById(int $id): ?Task
    {
        $data = DB::selectOne("
        SELECT * FROM tasks
        WHERE id = ?
        LIMIT 1
        ", [$id]);

        return $data ? $this->hydrateTask((array)$data) : null;
    }

    public function findShortAllByUser(int $user_id): array
    {
        $results = DB::select("
            SELECT
                id,
                title,
                priority,
                is_completed,
                deadline
            FROM tasks
            WHERE user_id = ?
            ORDER BY created_at DESC
        ", [$user_id]);

        $tasks = [];
        foreach($results as $result) {
            $tasks[] = $this->hydrateTask((array) $result);
        }

        return $tasks;
    }

    private function hydrateTask(array $data): Task
    {
        $task = new Task();
        $task->id = (int)$data['id'];
        $task->title = (string)$data['title'];
        $task->details = isset($data['details']) ? (string)$data['details'] : null;
        $task->priority = (int)$data['priority'];
        $task->is_completed = (bool)$data['is_completed'];
        $task->deadline = $data['deadline'] ? new \DateTime($data['deadline']) : null;
        $task->created_at = isset($data['created_at']) ? new \DateTime($data['created_at']) : null;
        $task->updated_at = isset($data['updated_at']) ? new \DateTime($data['updated_at']) : null;
        $task->time_spent = isset($data['time_spent']) ? (int)$data['time_spent'] : null;
        $task->user_id = isset($data['user_id']) ? (int)$data['user_id'] : null;


        return $task;
    }
}
