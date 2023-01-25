<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateUserRequest extends FormRequest
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
            'login' => 'min:3|required|unique:users,login|string',
            'full_name' => 'min:5|required|unique:users,full_name|string',
            'email' => 'email|unique:users,email|required',
            'password' => 'min:8|string|required|confirmed',
            'group_id' => 'integer|exists:groups,id|required',
        ];
    }
}
