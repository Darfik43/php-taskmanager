<?php

namespace App\Services;

interface EmailVerificationService
{
    public function verifyEmail(array $emailVerificationData);
}
