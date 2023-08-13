<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $p_users = ['access users', 'edit users', 'delete users', 'approval users'];
        $p_students = ['access students', 'edit students', 'delete students', 'approval students', 'payment students'];
        $p_dormitories = ['access dormitories', 'edit dormitories', 'delete dormitories', 'approval dormitories'];
        $p_formal = ['access formal', 'edit formal', 'delete formal', 'approval formal'];
        $p_informal = ['access informal', 'edit informal', 'delete informal', 'approval informal'];
        $p_violation = ['access violation', 'edit violation', 'delete violation', 'approval violation'];
        $p_permit = ['access permit', 'edit permit', 'delete permit', 'approval permit'];
        $p_invoice = ['access invoice', 'edit invoice', 'delete invoice', 'approval invoice'];
        $p_settings = ['access settings'];
        $p_admission = ['access admission'];

        $permissions = array_merge(
            $p_users,
            $p_students,
            $p_dormitories,
            $p_formal,
            $p_informal,
            $p_violation,
            $p_permit,
            $p_invoice,
            $p_settings,
            $p_admission
        );

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        $admin = Role::where('name', 'admin')->first();
        $admin->givePermissionTo($p_users);
        $admin->givePermissionTo($p_students);
        $admin->givePermissionTo('approval students');
        $admin->givePermissionTo($p_settings);
        $admin->givePermissionTo($p_dormitories);
        $admin->givePermissionTo($p_admission);


        $sekretaris = Role::where('name', 'sekretaris')->first();
        $sekretaris->givePermissionTo($p_users);
        $sekretaris->givePermissionTo($p_students);
        $sekretaris->givePermissionTo('approval students');
        $sekretaris->givePermissionTo($p_admission);
        
        $bendahara = Role::where('name', 'bendahara')->first();
        $bendahara->givePermissionTo($p_students);
        $bendahara->givePermissionTo('payment students');
        $bendahara->givePermissionTo($p_admission);
    }
}
