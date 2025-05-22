<?php

namespace App\Task\DTOs;

readonly class TaskDTO
{
    public function __construct(
        public int $id,
        public string $title,
        public string $details,
        public int $priority,
        public \DateTime $deadline,
        public \DateTime $closedAt,
        public \DateTime $createdAt,
        public \DateTime $updatedAt,
        public int $timeSpent,
        public int $userId,
    ) {}
}
