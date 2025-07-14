<?php

namespace App\Email\Services;

use App\Authentication\Exceptions\UserNotFoundException;
use App\Authentication\Models\User;
use App\Authentication\Services\UserService;
use App\Email\Http\Exceptions\EmailAlreadyVerifiedException;
use App\Email\Http\Exceptions\VerificationInvalidLinkException;

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
