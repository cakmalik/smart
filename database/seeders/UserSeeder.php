<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'admin']);
        $santriRole = Role::create(['name' => 'santri']);
        $permission = Permission::create(['name' => 'manage users']);
        $permissionSantri = Permission::create(['name' => 'manage family']);
        $role->givePermissionTo($permission);
        $santriRole->givePermissionTo($permissionSantri);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@bakid.com',
            'password' => bcrypt('password'),
            'phone' => '081234567890',
            'kk' => '1234567890123456',
        ])->assignRole('admin');


        Team::create([
            'user_id' => 1,
            'name' => 'John Doe',
            'personal_team' => true,
        ]);

        $santri_team = Team::create([
            'user_id' => 2,
            'name' => 'Santri bakid',
            'personal_team' => false,
        ]);

        $santri = User::create([
            'name' => 'Santri bakid',
            'email' => 'santri@bakid.com',
            'password' => bcrypt('password'),
            'current_team_id' => 2,
            'phone' => '08123456783390',
            'kk' => '123456789012333456',

        ])->assignRole('santri');

        $santri->teams()->attach($santri_team->id, ['role' => 'santri']);

        $this->command->info('User seeded!');
    }
}
