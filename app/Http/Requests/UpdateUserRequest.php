<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', Rule::unique('users')->ignore(auth()->id())],
            'current_password' => ['current_password'],
            'password' => ['nullable', 'required_with:password_confirmation', 'min:8', 'confirmed'],
            'password_confirmation' => ['nullable', 'required_with:password', 'min:8'],
        ];
    }
}
