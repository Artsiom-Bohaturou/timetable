<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property string $name
 * @property string $teacher_full_name
 * @property int $class_number
 * @property int $lesson_start
 * @property string $day_name
 * @property int $week_number
 * @property int $group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\LessonFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereClassNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereDayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereLessonStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereTeacherFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereWeekNumber($value)
 * @mixin \Eloquent
 */
class Lesson extends Model
{
    use HasFactory;

    public static $seederLessonCount = 30;

    protected $fillable = [
        'name',
        'teacher_full_name',
        'class_number',
        'lesson_start',
        'day_number',
        'week_number',
        'group_id',
    ];

    public function group()
    {
        return $this->hasOne(Group::class);
    }
}
