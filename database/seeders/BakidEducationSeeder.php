<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Formal\FormalEducation;
use App\Models\Informal\InformalEducation;
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
                'level' => 'primary'
            ],
            [
                'name' => 'MTs 1',
                'level' => 'secondary'
            ],
            [
                'name' => 'MTs 2',
                'level' => 'secondary'
            ],
            [
                'name' => 'MA 1 ',
                'level' => 'high'
            ],
            [
                'name' => 'MA 2 ',
                'level' => 'high'
            ],
            [
                'name' => 'STIS ',
                'level' => 'bachelor'
            ],
        ];


        $informal_classes = [
            [
                'name' => 'Sifir',

            ],
            [
                'name' => '1 MID',

            ],
            [
                'name' => '2 MID',

            ],
            [
                'name' => '3 MID',

            ],
            [
                'name' => '4 MID',

            ],
            [
                'name' => '5 MID',

            ],
            [
                'name' => '6 MID',

            ],

            [
                'name' => '1 MTSD',

            ],
            [
                'name' => '2 MTSD',

            ],
            [
                'name' => '3 MTSD',

            ],
        ];

        foreach ($formal as $key => $value) {
            $formal = FormalEducation::create(['name' => $value['name'], 'level' => $value['level']]);

            switch ($formal->name) {
                case 'MI':
                    $formal->formalEducationClasses()->create(['class_name' => '1', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => '2', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => '3', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => '4', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => '5', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => '6', 'qty' => 40, 'current_qty' => 0]);
                    break;

                case 'STIS':
                    $formal->formalEducationClasses()->create(['class_name' => 'Semester 1', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => 'Semester 2', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => 'Semester 3', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => 'Semester 4', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => 'Semester 5', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => 'Semester 6', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => 'Semester 7', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => 'Semester 8', 'qty' => 40, 'current_qty' => 0]);
                    break;

                case 'MA 1':
                    $formal->formalEducationClasses()->create(['class_name' => '10', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => '11', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => '12', 'qty' => 40, 'current_qty' => 0]);
                    break;
                case 'MA 2':
                    $formal->formalEducationClasses()->create(['class_name' => '10', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => '11', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => '12', 'qty' => 40, 'current_qty' => 0]);
                    break;

                default:
                    $formal->formalEducationClasses()->create(['class_name' => '7', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => '8', 'qty' => 40, 'current_qty' => 0]);
                    $formal->formalEducationClasses()->create(['class_name' => '9', 'qty' => 40, 'current_qty' => 0]);
                    break;
            }
        }

        $informal = InformalEducation::create(['name' => 'Madin']);

        foreach ($informal_classes as $key => $value) {
            InformalEducationClass::create(['informal_education_id' => $informal->id, 'class_name' => $value['name'], 'qty' => 40, 'current_qty' => 0]);
        }
    }
}
