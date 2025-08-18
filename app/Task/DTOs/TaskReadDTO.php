<?php

namespace App\Task\DTOs;

use App\Task\Enums\Priority;
use DateTimeInterface;

readonly class TaskReadDTO
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $details,
        public Priority $priority,
        public bool $isCompleted,
        public ?DateTimeInterface $deadline,
        public ?DateTimeInterface $closedAt,
        public ?DateTimeInterface $createdAt,
        public ?DateTimeInterface $updatedAt,
        public ?int $timeSpent,
        public int $userId,
    ) {}
}
