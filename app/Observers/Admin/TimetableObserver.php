<?php

namespace App\Observers\Admin;

use App\Models\Lesson;

class TimetableObserver
{
    public function updating(Lesson $lesson)
    {
        foreach ($lesson->getAttributes() as $key => $value) {
            if (is_null($lesson->$key)) {
                unset($lesson->$key);
            }
        }

    }
}
