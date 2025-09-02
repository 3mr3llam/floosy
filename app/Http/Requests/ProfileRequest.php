<?php

namespace App\Http\Requests;

use App\Traits\HasFailedValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    use HasFailedValidation;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'mobile' => 'sometimes|numeric|unique:users,mobile,' . Auth::id(),
            'email' => 'sometimes|email|unique:users,email,' . Auth::id(),
            'password' => 'sometimes|string|confirmed',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birth' => 'nullable|date|before:today',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|integer',
        ];
    }
}
