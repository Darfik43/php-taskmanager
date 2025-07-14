<?php

namespace App\Email\Services;

interface EmailVerificationService
{
    public function verifyEmail(array $emailVerificationData);
}
