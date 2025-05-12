<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyEmailRequest;
use App\Http\Resources\EmailVerificationResource;
use App\Services\EmailVerificationService;

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
