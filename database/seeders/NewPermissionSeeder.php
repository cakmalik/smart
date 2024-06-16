<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = Permission::firstOrCreate(['name' => 'submission']);

        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin_daerah');
        })->first();

        $user->givePermissionTo($permission);
    }
}