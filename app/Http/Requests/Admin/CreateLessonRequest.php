<?php

namespace App\Http\Requests\Admin;

use App\Rules\LessonsExistRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateLessonRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'teacher_full_name' => 'required|string|min:5',
            'class_number' => 'required|integer',
            'week_number' => 'required|integer',
            'day_number' => 'required|integer',
            'group_id' => 'required|exists:groups,id',
            'lesson_start' => [new LessonsExistRule($this->group_id, $this->week_number, $this->day_number), 'required'],
        ];
    }
}
