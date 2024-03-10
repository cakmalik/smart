<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'sekretaris',
                'guard_name' => 'web'

            ],
            [
                'name' => 'bendahara',
                'guard_name' => 'web'

            ],
            [
                'name' => 'hankamtib',
                'guard_name' => 'web'

            ],
            [
                'name' => 'madin',
                'guard_name' => 'web'

            ],
        ];

        Role::insert($roles);
    }
}
