<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Bakid\Dormitory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminDaerahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // make role
        $role = Role::create([
            'name' => 'admin_daerah',
            'guard_name' => 'web',
        ]);

        $role->givePermissionTo(['access students', 'edit students', 'delete students']);

        $dormitories = Dormitory::get();

        foreach ($dormitories as $dormitory) {
            $admin = User::create([
                'name' => 'Admin Daerah ' . $dormitory->name,
                'username' => 'admin_' . $dormitory->gender . '_' . $dormitory->name,
                'gender' => $dormitory->gender == 'L' ? 'male' : 'female',
                'email' => 'admin_' . $dormitory->gender . '_' . $dormitory->name . '@bakid.id',
                'password' => bcrypt('123'),
                'phone' => rand(1111111111, 9999999999),
                'kk' => rand(9999999999, 99999999999),
                'current_team_id' => 1,
            ])->assignRole('admin_daerah');
        }
    }
}