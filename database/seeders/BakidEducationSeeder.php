<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Formal\FormalEducation;
use App\Models\Informal\InformalEducation;
use App\Models\Formal\FormalEducationClass;
use App\Models\Formal\FormalEducationGrade;
use App\Models\Informal\InformalEducationClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BakidEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formal = [
            [
                'name' => 'MI',
                'level' => 'primary',
            ],
            [
                'name' => 'MTs 1',
                'level' => 'secondary',
            ],
            [
                'name' => 'MTs 2',
                'level' => 'secondary',
            ],
            [
                'name' => 'MA 1 ',
                'level' => 'high',
            ],
            [
                'name' => 'MA 2 ',
                'level' => 'high',
            ],
            [
                'name' => 'STIS ',
                'level' => 'bachelor',
            ],
        ];

        $informal_classes = [
            [
                'name' => 'Sifir',
            ],
            [
                'name' => 'I MID',
            ],
            [
                'name' => 'II MID',
            ],
            [
                'name' => 'III MID',
            ],
            [
                'name' => 'IV MID',
            ],
            [
                'name' => 'V MID',
            ],
            [
                'name' => 'VI MID',
            ],

            [
                'name' => 'I MTSD',
            ],
            [
                'name' => 'II MTSD',
            ],
            [
                'name' => 'III MTSD',
            ],
        ];

        foreach ($formal as $key => $value) {
            $formal = FormalEducation::create(['name' => $value['name'], 'level' => $value['level']]);
        }

        $informal = InformalEducation::create(['name' => 'Madin']);

        foreach ($informal_classes as $key => $value) {
            InformalEducationClass::create(['informal_education_id' => $informal->id, 'class_name' => $value['name'], 'qty' => 40, 'current_qty' => 0]);
        }

       
    }
}
