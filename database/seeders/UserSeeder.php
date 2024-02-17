<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Actions\Jetstream\AddTeamMember;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create a team
        $adminTeam = Team::create([
            'user_id' => 1,
            'name' => 'Admin Team',
            'personal_team' => false,
        ]);

        //create user admin
        $admin = User::create([
            'name' => 'Admin PA',
            'username' => 'admin_pa',
            'email' => 'admin_pa@bakid.id',
            'password' => bcrypt('password'),
            'phone' => '123',
            'kk' => '1234',
            'current_team_id' => 1
        ])->assignRole('admin');

        $admin = User::create([
            'name' => 'Admin PI',
            'username' => 'admin_pi',
            'email' => 'admin_pi@bakid.id',
            'password' => bcrypt('password'),
            'phone' => '12344',
            'kk' => '12345',
            'current_team_id' => 1
        ])->assignRole('admin');

        //create user sekretaris
        $seketaris = User::create([
            'name' => 'Sekretaris',
            'username' => 'sekretaris',
            'email' => 'sekretaris@bakid.id',
            'password' => bcrypt('password'),
            'phone' => '111',
            'kk' => '1111', 'current_team_id' => 1
        ])->assignRole('sekretaris');


        $bendahara = User::create([
            'name' => 'Bendahara',
            'username' => 'bendahara',
            'email' => 'bendahara@bakid.id',
            'password' => bcrypt('password'),
            'phone' => '222',
            'kk' => '222', 'current_team_id' => 1
        ])->assignRole('bendahara');

        $hankamtib = User::create([
            'name' => 'hankamtib',
            'username' => 'hankamtib',
            'email' => 'hankamtib@bakid.id',
            'password' => bcrypt('password'),
            'phone' => '333',
            'kk' => '333', 'current_team_id' => 1
        ])->assignRole('hankamtib');

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
            'password' => bcrypt('password'),
            'current_team_id' => 2,
            'phone' => '08123456783390',
            'kk' => '123456789012333456',

        ])->assignRole('santri');

        //assign person to team
        $santri->teams()->attach($santri_team->id, ['role' => 'santri']);
    }
}
