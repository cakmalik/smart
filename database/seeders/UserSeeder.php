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
        $seketaris_pa = User::create([
            'name' => 'sekretaris_pa',
            'gender' => 'male',
            'username' => 'sekretaris_pa',
            'email' => 'sekretaris_pa@bakid.id',
            'password' => bcrypt('123'),
            'phone' => rand(1111111111, 9999999999),
            'kk' => rand(9999999999, 99999999999),
            'current_team_id' => 1,
        ])->assignRole('sekretaris');

        $seketaris_pi = User::create([
            'name' => 'sekretaris_pi',
            'gender' => 'female',
            'username' => 'sekretaris_pi',
            'email' => 'sekretaris_pi@bakid.id',
            'password' => bcrypt('123'),
            'phone' => rand(1111111111, 9999999999),
            'kk' => rand(9999999999, 99999999999),
            'current_team_id' => 1,
            ])->assignRole('sekretaris');
            
            
            $bendahara_pa = User::create([
                'name' => 'Bendahara_pa',
                'gender' => 'male',
                'username' => 'bendahara_pa',
                'email' => 'bendahara_pa@bakid.id',
            'password' => bcrypt('123'),
            'phone' => rand(1111111111, 9999999999),
            'kk' => rand(9999999999, 99999999999),
            'current_team_id' => 1,
        ])->assignRole('bendahara');

        $bendahara_pi = User::create([
            'name' => 'Bendahara_pi',
            'gender' => 'female',
            'username' => 'bendahara_pi',
            'email' => 'bendahara_pi@bakid.id',
            'password' => bcrypt('123'),
            'phone' => rand(1111111111, 9999999999),
            'kk' => rand(9999999999, 99999999999),
            'current_team_id' => 1,
        ])->assignRole('bendahara');

        $hankamtib_pa = User::create([
            'name' => 'hankamtib_pa',
            'gender' => 'male',
            'username' => 'hankamtib_pa',
            'email' => 'hankamtib_pa@bakid.id',
            'password' => bcrypt('123'),
            'phone' => rand(1111111111, 9999999999),
            'kk' => rand(9999999999, 99999999999),
            'current_team_id' => 1,
        ])->assignRole('hankamtib');

        $hankamtib_pi = User::create([
            'name' => 'hankamtib_pi',
            'gender' => 'female',
            'username' => 'hankamtib_pi',
            'email' => 'hankamtib_pi@bakid.id',
            'password' => bcrypt('123'),
            'phone' => rand(1111111111, 9999999999),
            'kk' => rand(9999999999, 99999999999),
            'current_team_id' => 1,
        ])->assignRole('hankamtib');

    }
}