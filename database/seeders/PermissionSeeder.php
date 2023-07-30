<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        $p_students = ['access students', 'edit students', 'delete students', 'approval students'];
        $p_dormitories = ['access dormitories', 'edit dormitories', 'delete dormitories', 'approval dormitories'];
        $p_formal = ['access formal', 'edit formal', 'delete formal', 'approval formal'];
        $p_informal = ['access informal', 'edit informal', 'delete informal', 'approval informal'];
        $p_violation = ['access violation', 'edit violation', 'delete violation', 'approval violation'];
        $p_permit = ['access permit', 'edit permit', 'delete permit', 'approval permit'];
        $p_invoice = ['access invoice', 'edit invoice', 'delete invoice', 'approval invoice'];


        $permissions = array_merge(
            $p_users,
            $p_students,
            $p_dormitories,
            $p_formal,
            $p_informal,
            $p_violation,
            $p_permit,
            $p_invoice
        );

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
