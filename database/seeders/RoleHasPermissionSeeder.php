<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $p_settings = ['access settings'];
        $p_users = ['access users', 'edit users', 'delete users', 'approval users'];
        $p_students = ['access students', 'edit students', 'delete students', 'approval students'];
        $p_dormitories = ['access dormitories', 'edit dormitories', 'delete dormitories', 'approval dormitories'];
        $p_formal = ['access formal', 'edit formal', 'delete formal', 'approval formal'];
        $p_informal = ['access informal', 'edit informal', 'delete informal', 'approval informal'];
        $p_violation = ['access violation', 'edit violation', 'delete violation', 'approval violation'];
        $p_permit = ['access permit', 'edit permit', 'delete permit', 'approval permit'];
        $p_invoice = ['access invoice', 'edit invoice', 'delete invoice', 'approval invoice'];

        $admin = Role::where('name', 'admin')->first();
        $admin->givePermissionTo($p_users);
        $admin->givePermissionTo($p_students);
        $admin->givePermissionTo($p_settings);

        $sekretaris = Role::where('name', 'sekretaris')->first();
        $sekretaris->givePermissionTo($p_users);
        $sekretaris->givePermissionTo($p_students);
    }
}
