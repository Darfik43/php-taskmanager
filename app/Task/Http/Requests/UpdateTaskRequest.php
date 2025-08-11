<?php

namespace App\Task\Http\Requests;

use App\Task\Rules\RussianChars;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateTaskRequest extends ApiFormRequest
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
            'title' => ['max:50', new RussianChars()],
            'details' => ['max:100', new RussianChars()],
            'is_completed' => 'required|boolean',
            'priority' => 'integer|between:1,4',
            'deadline' => 'date',
            'time_spent' => 'numeric',
        ];
    }
}
