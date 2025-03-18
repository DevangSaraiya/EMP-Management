<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'name' => 'required|string|max:100', // First name must be required, string, and max 100 characters
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
            'name.required' => 'Department name is required.',
            'first_name.string' => 'Department name must be a string.',
            'first_name.max' => 'Department name cannot exceed 100 characters.',
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
