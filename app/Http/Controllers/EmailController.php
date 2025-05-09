<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyEmailRequest;
use App\Http\Resources\EmailVerificationResource;
use Illuminate\Http\JsonResponse;

class EmailController extends Controller
{
    public function __construct(
        private readonly EmailVerificationService $emailVerificationService
    ) {}

    public function verify(VerifyEmailRequest $request): EmailVerificationResource
    {
        $this->emailVerificationService->verifyEmail($request);
    }
}
