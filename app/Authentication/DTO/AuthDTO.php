<?php

namespace App\Authentication\DTO;

class AuthDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password
    ) {}
}
