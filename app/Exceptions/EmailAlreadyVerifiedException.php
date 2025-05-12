<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class EmailAlreadyVerifiedException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'error' => $this->message
        ], 409);
    }
}
