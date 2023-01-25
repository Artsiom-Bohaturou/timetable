<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'login' => 'min:3|nullable|unique:users,login|string',
            'full_name' => 'min:5|nullable|unique:users,full_name|string',
            'email' => 'email|unique:users,email|nullable',
            'password' => 'min:8|string|confirmed|nullable',
            'group_id' => 'integer|exists:groups,id|nullable',
        ];
    }
}
