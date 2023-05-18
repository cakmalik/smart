<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'm@m.m',
            'password' => bcrypt('password'),
        ]);

        Team::create([
            'user_id' => 1,
            'name' => 'John Doe',
            'personal_team' => true,
        ]);

        $this->command->info('User seeded!');
    }
}
