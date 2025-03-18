<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'required|string|max:25', // First name must be required, string, and max 255 characters
            'last_name' => 'required|string|max:25', // Last name must be required, string, and max 255 characters
            'department_id' => 'required', // Department must exist in the departments table
            'status' => 'required', // Status must be either 'active' or 'inactive'
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'First name is required.',
            'first_name.string' => 'First name must be a string.',
            'first_name.max' => 'First name cannot exceed 25 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.string' => 'Last name must be a string.',
            'last_name.max' => 'Last name cannot exceed 25 characters.',
            'department_id.required' => 'Department is required.',
            'status.required' => 'Status is required.'
        ];
    }

    /* Customize the failed validation response format.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        // Get the validation errors
        $errors = $validator->errors()->getMessages();

        // Format the errors in the required structure
        $formattedErrors = [];
        foreach ($errors as $field => $messages) {
            $formattedErrors[$field] = $messages[0];
        }

        // Return the custom response with 200 status code
        throw new ValidationException(
            $validator,
            response()->json([
                'type' => 'validation_error',
                'message' => 'There were validation errors.',
                'validation_errors' => $formattedErrors,
            ], 200) // Return response with 200 status code
        );
    }
}
