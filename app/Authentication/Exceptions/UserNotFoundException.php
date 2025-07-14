<?php

namespace App\Authentication\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use function App\Exceptions\response;

class UserNotFoundException extends Exception
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
        ], 404);
    }
}
