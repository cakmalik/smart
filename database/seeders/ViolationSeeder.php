<?php

namespace Database\Seeders;

use App\Models\Bakid\Violation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViolationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Violation::insert([
            [
                'name' => 'Terlambat',
                'point' => 10,
                'scope' => 'ringan'
            ],
            [
                'name' => 'Merokok',
                'point' => 20,
                'scope' => 'berat'
            ]
        ]);
    }
}
