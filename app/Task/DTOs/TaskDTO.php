<?php

namespace App\Task\DTOs;

use App\Task\Enums\Priority;
use DateTimeInterface;

readonly class TaskDTO
{
    private function __construct(
        public ?int $id,
        public string $title,
        public ?string $details,
        public ?Priority $priority,
        public bool $isCompleted,
        public ?DateTimeInterface $deadline,
        public ?int $timeSpent
    ) {}

    /**
     * @throws \Exception
     */
    public static function make(array $data): TaskDTO
    {
        return new TaskDTO(
            id: $data['id'] ?? null,
            title: $data['title'] ?? null,
            details: $data['details'] ?? null,
            priority: $data['priority'] instanceof Priority
                ? $data['priority']
                : (array_key_exists('priority', $data) && $data['priority'] !== null
                    ? Priority::from((int)$data['priority'])
                    : null),
            isCompleted: (bool) ($data['is_completed'] ?? false),
            deadline: $data['deadline'] ? new \DateTimeImmutable($data['deadline']) : null,
            timeSpent: $data['time_spent'] ?? null
        );
    }
}

