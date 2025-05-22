<?php

namespace App\Task\DTOs;

use App\Task\Enums\Priority;

readonly class TaskDTO
{
    public function __construct(
        public int $id,
        public string $title,
        public string $details,
        public Priority $priority,
        public \DateTime $deadline,
        public \DateTime $closedAt,
        public \DateTime $createdAt,
        public \DateTime $updatedAt,
        public int $timeSpent,
        public int $userId,
    ) {}
}
