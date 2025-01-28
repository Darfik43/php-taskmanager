<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class SignupRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'passwordConfirmation' => 'same:password'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator))
            -> errorBag($this->errorBag)
            -> redirectTo($this->getRedirectUrl())
            -> status(  Response::HTTP_BAD_REQUEST);
    }

}
