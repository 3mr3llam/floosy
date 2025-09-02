<?php

namespace App\Http\Requests;

use App\Traits\HasFailedValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class ResetPasswordRequest extends FormRequest
{
    use HasFailedValidation;

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
            'mobile' => 'required|exists:users,mobile',
            'password' => 'required|confirmed|string|min:6',
        ];
    }
}
