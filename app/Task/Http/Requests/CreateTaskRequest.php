<?php

namespace App\Task\Http\Requests;

use App\Task\Rules\RussianChars;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateTaskRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:50', new RussianChars()],
            'details' => ['max:100', new RussianChars()],
            'is_completed' => 'required|boolean',
            'priority' => 'required|integer|between:1,4',
            'deadline' => 'date',
            'time_spent' => 'numeric',
        ];
    }


    //TODO try to use this way to fail validation to avoid redirect to index page
//    public function failedValidation(Validator $validator)
//    {
//        throw new HttpResponseException(response()->json([
//            'errors' => $validator->errors()
//        ], 422));
//    }
}
