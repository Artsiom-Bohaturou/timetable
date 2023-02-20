<?php

namespace App\Rules;

use App\Models\Lesson;
use Illuminate\Contracts\Validation\Rule;

class LessonsExistRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(
        public $groupId,
        public $weekNumber,
        public $dayNumber
    ) {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $exist = Lesson::where('group_id', $this->groupId)
            ->where('week_number', $this->weekNumber)
            ->where('day_number', $this->dayNumber)
            ->where($attribute, $value)
            ->first();

        return is_null($exist);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
