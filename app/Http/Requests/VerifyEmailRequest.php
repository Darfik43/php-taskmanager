<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function fulfill(): void
    {
        $user = User::find($this->route('id'));

        if (!$user || !hash_equals(
            sha1($user->getEmailForVerification()),
            (string) $this->route('hash')
            )) {
            throw new AuthorizationException('Invalid verification link');
        }

        if ($user->hasVerifiedEmail()) {
            throw new AuthorizationException('Email already verified');
        }

        $user->markEmailAsVerified();
    }
}
