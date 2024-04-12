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
        $p_users = ['access users', 'edit users', 'delete users' ];
        $p_students = ['access students', 'edit students', 'delete students' , 'payment students'];
        $p_dormitories = ['access dormitories', 'edit dormitories', 'delete dormitories' ];
        $p_violation = ['access violation', 'edit violation', 'delete violation' ];
        $p_permit = ['access permit', 'edit permit', 'delete permit' ];
        $p_invoice = ['access invoice', 'edit invoice', 'delete invoice' ];
        $p_invoice_categories = ['access invoice_categories', 'edit invoice_categories', 'delete invoice_categories' ];
        $p_mutation = ['access mutation', 'add mutation', 'edit mutation', 'delete mutation' ];

        $p_announcement = ['access announcement', 'edit announcement', 'delete announcement'];

        $p_management = ['access management', 'edit management', 'delete management', 'add management'];
        $p_management_asrama = ['access asrama', 'edit asrama', 'delete asrama', 'add asrama'];
        $p_management_formal = ['access formal', 'edit formal', 'delete formal', 'add formal'];
        $p_management_informal = ['access informal', 'edit informal', 'delete informal', 'add informal'];

        
        $p_psb = ['access psb'];
        $p_alumni = ['access alumni', 'approval alumni'];
        $p_campaign = ['access campaign', 'edit campaign', 'delete campaign', 'approval campaign'];
        $p_in_out_permit = ['access in_out_permit'];
        $p_settings = ['access settings'];
        $p_admission = ['access admission'];
        $payment = ['change payment method'];

        $approval_menu = [
            'menu approval',
            'approval psb',
            'approval alumni',
            'approval asrama',
            'approval formal',
            'approval informal',
            'approval mutasi',
            'approval dropout',
        ];

        $permissions = array_merge(
            $p_users,
            $p_students,
            $p_dormitories,
            $p_violation,
            $p_permit,
            $p_invoice,
            $p_invoice_categories,
            $p_mutation,
            $p_management,
            $p_management_asrama,
            $p_management_formal,
            $p_management_informal,
            $p_psb,
            $p_alumni,
            $p_campaign,
            $p_in_out_permit,
            $p_settings,
            $p_admission,
            $payment,
            $p_announcement,
            $approval_menu
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
        $admin->givePermissionTo($p_invoice);
        $admin->givePermissionTo($p_invoice_categories);
        $admin->givePermissionTo($p_admission);
        $admin->givePermissionTo($p_campaign);
        $admin->givePermissionTo($p_psb);
        $admin->givePermissionTo($p_alumni);
        $admin->givePermissionTo($p_management);


        $sekretaris = Role::where('name', 'sekretaris')->first();
        $sekretaris->givePermissionTo($p_users);
        $sekretaris->givePermissionTo($p_students);
        $sekretaris->givePermissionTo('approval students');
        $sekretaris->givePermissionTo($p_invoice);
        $sekretaris->givePermissionTo($p_admission);
        $sekretaris->givePermissionTo($p_campaign);
        $sekretaris->givePermissionTo($p_psb);
        $sekretaris->givePermissionTo($approval_menu);
        
        
        $bendahara = Role::where('name', 'bendahara')->first();
        $bendahara->givePermissionTo($p_students);
        $bendahara->givePermissionTo($p_invoice);
        $bendahara->givePermissionTo($p_admission);
        $bendahara->givePermissionTo($p_campaign);
        $bendahara->givePermissionTo($p_psb);
        
        $hankamtib = Role::where('name', 'hankamtib')->first();
        $hankamtib->givePermissionTo($p_students);
        $hankamtib->givePermissionTo($p_in_out_permit);
        $hankamtib->givePermissionTo($p_violation);
        
        $student = Role::where('name', 'santri')->first();
        $student->givePermissionTo($p_students);
        $student->givePermissionTo($payment);
    }
}