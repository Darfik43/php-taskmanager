<?php

namespace App\Services;

use App\Exceptions\EmailAlreadyVerifiedException;
use App\Exceptions\UserNotFoundException;
use App\Exceptions\VerificationInvalidLinkException;
use App\Models\User;

class EmailVerificationServiceImpl implements EmailVerificationService
{
    public function __construct(
        private readonly UserService $userService,
    ){}

    /**
     * @throws UserNotFoundException
     * @throws VerificationInvalidLinkException
     * @throws EmailAlreadyVerifiedException
     */
    public function verifyEmail(array $emailVerificationData): void
    {
        $user = $this->userService->getUserById($emailVerificationData['id']);
        $this->validateVerificationHash($user, $emailVerificationData['hash']);
        $this->ensureEmailNotVerified($user);

        $user->markEmailAsVerified();
    }

    /**
     * @throws VerificationInvalidLinkException
     */
    private function validateVerificationHash(User $user, string $hash): void
    {
        if (!hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            throw new VerificationInvalidLinkException('Invalid verification link');
        }
    }

    /**
     * @throws EmailAlreadyVerifiedException
     */
    private function ensureEmailNotVerified(User $user): void
    {
        if ($user->hasVerifiedEmail()) {
            throw new EmailAlreadyVerifiedException('Email already verified');
        }
    }
}
