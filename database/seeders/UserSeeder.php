<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Actions\Jetstream\AddTeamMember;
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
            'gender' => 'male',
            'email' => 'admin_pa@bakid.id',
            'password' => bcrypt('123'),
            'phone' => rand(1111111111, 9999999999),
            'kk' => rand(9999999999, 99999999999),
            'current_team_id' => 1,
        ])->assignRole('admin');

        $admin = User::create([
            'name' => 'Admin PI',
            'username' => 'admin_pi',
            'gender' => 'female',
            'email' => 'admin_pi@bakid.id',
            'password' => bcrypt('123'),
            'phone' => rand(1111111111, 9999999999),
            'kk' => rand(9999999999, 99999999999),
            'current_team_id' => 1,
        ])->assignRole('admin');

        $madin_pa = User::create([
            'name' => 'Madin PA',
            'username' => 'madin_pa',
            'gender' => 'male',
            'email' => 'madin_pa@bakid.id',
            'password' => bcrypt('123'),
            'phone' => rand(1111111111, 9999999999),
            'kk' => rand(9999999999, 99999999999),
            'current_team_id' => 1,
        ])->assignRole('madin_admin');
        DB::table('user_has_informal_education_permission')->insert([
            'user_id' => $madin_pa->id,
            'education_id' => 1,
        ]);

        $madin_pi = User::create([
            'name' => 'Madin PI',
            'username' => 'madin_pi',
            'gender' => 'female',
            'email' => 'madin_pi@bakid.id',
            'password' => bcrypt('123'),
            'phone' => rand(1111111111, 9999999999),
            'kk' => rand(9999999999, 99999999999),
            'current_team_id' => 1,
        ])->assignRole('madin_admin');
        DB::table('user_has_informal_education_permission')->insert([
            'user_id' => $madin_pi->id,
            'education_id' => 1,
        ]);

        //create user sekretaris
        $seketaris = User::create([
            'name' => 'Sekretaris',
            'username' => 'sekretaris',
            'email' => 'sekretaris@bakid.id',
            'password' => bcrypt('123'),
            'phone' => rand(1111111111, 9999999999),
            'kk' => rand(9999999999, 99999999999),
            'current_team_id' => 1,
        ])->assignRole('sekretaris');

        $bendahara = User::create([
            'name' => 'Bendahara',
            'username' => 'bendahara',
            'email' => 'bendahara@bakid.id',
            'password' => bcrypt('123'),
            'phone' => rand(1111111111, 9999999999),
            'kk' => rand(9999999999, 99999999999),
            'current_team_id' => 1,
        ])->assignRole('bendahara');

        $hankamtib = User::create([
            'name' => 'hankamtib',
            'username' => 'hankamtib',
            'email' => 'hankamtib@bakid.id',
            'password' => bcrypt('123'),
            'phone' => rand(1111111111, 9999999999),
            'kk' => rand(9999999999, 99999999999),
            'current_team_id' => 1,
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
            'password' => bcrypt('123'),
            'current_team_id' => 2,
            'phone' => rand(1111111111, 9999999999),
            'kk' => rand(9999999999, 99999999999),
        ])->assignRole('santri');

        //assign person to team
        $santri->teams()->attach($santri_team->id, ['role' => 'santri']);
    }
}