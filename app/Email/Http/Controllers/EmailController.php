<?php

namespace App\Email\Http\Controllers;

use App\Authentication\Http\Controllers\Controller;
use App\Email\Http\Requests\VerifyEmailRequest;
use App\Email\Http\Resources\EmailVerificationResource;
use App\Email\Services\EmailVerificationService;

class EmailController extends Controller
{
    public function __construct(
        private readonly EmailVerificationService $emailVerificationService
    ) {}

    public function verify(VerifyEmailRequest $request): EmailVerificationResource
    {
        return new EmailVerificationResource(
            $this->emailVerificationService->verifyEmail($request->validated())
        );
    }
}
