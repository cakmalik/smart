<?php

namespace Database\Seeders;

use App\Models\Bakid\InOutPermissionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InOutPermissionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InOutPermissionType::create([
            'name' => 'dekat',
            'duration' => 15,
            'violation_id' => 1
        ]);
        InOutPermissionType::create([
            'name' => 'jauh',
            'duration' => 15,
            'violation_id' => 1
        ]);
        InOutPermissionType::create([
            'name' => 'bermalam',
            'duration' => 15,
            'violation_id' => 1
        ]);
    }
}
