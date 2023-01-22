<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(rand(6, 15)),
            'teacher_full_name' => $this->faker->name(),
            'class_number' => rand(100, 499),
            'lesson_start' => rand(1, 6),
            'day_name' => $this->faker->dayOfWeek(),
            'week_number' => rand(1, 4),
            'group_id' => rand(1, Group::$seederGroupCount),
        ];
    }
}
