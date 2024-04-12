<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DummyStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // SANTRI
          $santri_team = Team::create([
            'user_id' => 3,
            'name' => 'Santri bakid',
            'personal_team' => false,
        ]);

        $santriRole = Role::create(['name' => 'santri']);
        $permissionSantri = Permission::create(['name' => 'manage family']);
        // $role->givePermissionTo($permission);
        $santriRole->givePermissionTo($permissionSantri);
        //create dummy user
        $santri = User::create([
            'name' => 'Santri bakid',
            'username' => 'santri2',
            'email' => 'santri@bakid.id',
            'password' => bcrypt('123'),
            'current_team_id' => 2,
            'phone' => rand(1111111111, 9999999999),
            'kk' => rand(9999999999, 99999999999),
        ])->assignRole('santri');

        //assign person to team
        $santri->teams()->attach($santri_team->id, ['role' => 'santri']);
    }
}