<?php

namespace Database\Seeders;

use App\Models\Bakid\Dormitory;
use App\Models\Bakid\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DormitorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dormitories = [
            [
                'name' => 'A',
                'gender' => 'L',
                'rooms_count' => 16,
                'capacity' => 500,
                'leader_id' => null
            ],
            [
                'name' => 'B',
                'gender' => 'L',
                'rooms_count' => 13,
                'capacity' => 500,
                'leader_id' => null
            ],
            [
                'name' => 'C',
                'gender' => 'L',
                'rooms_count' => 18,
                'capacity' => 500,
                'leader_id' => null
            ],
            [
                'name' => 'D',
                'gender' => 'L',
                'rooms_count' => 26,
                'capacity' => 500,
                'leader_id' => null
            ],
            [
                'name' => 'E',
                'gender' => 'L',
                'rooms_count' => 13,
                'capacity' => 500,
                'leader_id' => null
            ],
            [
                'name' => 'F',
                'gender' => 'L',
                'rooms_count' => 18,
                'capacity' => 500,
                'leader_id' => null
            ],
            [
                'name' => 'G',
                'gender' => 'L',
                'rooms_count' => 21,
                'capacity' => 500,
                'leader_id' => null
            ],
            [
                'name' => 'LPBA',
                'gender' => 'L',
                'rooms_count' => 4,
                'capacity' => 500,
                'leader_id' => null
            ],
            [
                'name' => 'A',
                'gender' => 'P',
                'rooms_count' => 8,
                'capacity' => 500,
                'leader_id' => null
            ],
            [
                'name' => 'B',
                'gender' => 'P',
                'rooms_count' => 4,
                'capacity' => 500,
                'leader_id' => null
            ],
            [
                'name' => 'C',
                'gender' => 'P',
                'rooms_count' => 5,
                'capacity' => 500,
                'leader_id' => null
            ],
            [
                'name' => 'D',
                'gender' => 'P',
                'rooms_count' => 7,
                'capacity' => 500,
                'leader_id' => null
            ],
            [
                'name' => 'E',
                'gender' => 'P',
                'rooms_count' => 4,
                'capacity' => 500,
                'leader_id' => null
            ],
            [
                'name' => 'F',
                'gender' => 'P',
                'rooms_count' => 6,
                'capacity' => 500,
                'leader_id' => null
            ]
        ];

        foreach ($dormitories as $dormitory) {
            $id = Dormitory::create($dormitory)->id;
            for ($i = 1; $i <= $dormitory['rooms_count']; $i++) {
                // $alphabet = chr($i + 64); // Mengonversi angka menjadi huruf berdasarkan kode ASCII
                Room::create([
                    'dormitory_id' => $id,
                    'name' => $i,
                    'capacity' => 10,
                    'leader_id' => null
                ]);
            }
        }
    }
}
