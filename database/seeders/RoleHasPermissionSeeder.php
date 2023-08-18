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
        $p_report = ['access report'];
        $p_payment = ['access payment', 'edit payment', 'delete payment', 'approval payment'];

        $admin = Role::where('name', 'admin')->first();
        $admin->givePermissionTo($p_users);
        $admin->givePermissionTo($p_students);
        $admin->givePermissionTo('approval students');
        $admin->givePermissionTo($p_settings);
        $admin->givePermissionTo($p_dormitories);
        $admin->givePermissionTo($p_payment);


        $sekretaris = Role::where('name', 'sekretaris')->first();
        $sekretaris->givePermissionTo($p_users);
        $sekretaris->givePermissionTo($p_students);
        $sekretaris->givePermissionTo('approval students');
        $sekretaris->givePermissionTo($p_payment);

        $bendahara = Role::where('name', 'bendahara')->first();
        $bendahara->givePermissionTo($p_students);
        $bendahara->givePermissionTo('payment students');
        $bendahara->givePermissionTo($p_payment);

        $student = Role::where('name', 'santri')->first();
        $student->givePermissionTo($p_students);
        $student->givePermissionTo('change payment method');
    }
}
