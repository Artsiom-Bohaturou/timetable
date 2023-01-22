<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'login' => $this->faker->userName(),
            'full_name' => $this->faker->name(),
            'password' => Hash::make(Str::random(8)),
            'group_id' => rand(1, Group::$seederGroupCount),
            'remember_token' => Str::random(10),
            'email' => $this->faker->email(),
        ];
    }
}
