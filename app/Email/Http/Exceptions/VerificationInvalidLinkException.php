<?php

namespace App\Email\Http\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class VerificationInvalidLinkException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    public function render() : JsonResponse
    {
        return response()->json([
            'success' => false,
            'error' => $this->message
        ], 400);
    }
}
