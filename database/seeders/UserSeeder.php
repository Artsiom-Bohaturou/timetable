<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)->create();
        User::factory(1)->create([
            'login' => 'artem',
            'password' => Hash::make('12345678'),
            'remember_token' => 'AAAAAAAA',
            'group_id' => 1,
            'email' => 'art@mail.com',
        ]);
    }
}
