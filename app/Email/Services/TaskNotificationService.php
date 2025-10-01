<?php

namespace App\Email\Services;

use App\Authentication\Services\UserService;
use App\Task\Services\TaskService;
use Illuminate\Support\Facades\Mail;

class TaskNotificationService
{
    public function __construct(
        private readonly UserService $userService,
        private readonly TaskService $taskService
    ) {}

    public function sendTaskSummaryForUser(int $userId): void
    {
        $user = $this->userService->getUserById($userId);
        if (!$userId) return;

        $tasks = $this->taskService->getAllIncompletedByUser($userId);
        $tasksCount = count($tasks);

        Mail::to($user->email)
            ->send(new TaskSummaryMail($tasksCount, $tasks));
    }
}
