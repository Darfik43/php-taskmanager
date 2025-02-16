<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

class InvalidTokenException extends \Exception
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
