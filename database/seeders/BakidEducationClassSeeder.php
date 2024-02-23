<?php

namespace Database\Seeders;

use App\Models\Formal\FormalEducation;
use App\Models\Formal\FormalEducationClass;
use App\Models\Informal\InformalEducationClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BakidEducationClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // case 'MI':
        FormalEducationClass::create([
            'formal_education_id' => 1,
            'class_name' => '1',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 1,
            'class_name' => '2',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 1,
            'class_name' => '3',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 1,
            'class_name' => '4',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 1,
            'class_name' => '5',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 1,
            'class_name' => '6',
            'qty' => 40,
            'current_qty' => 0,
        ]);

        // case 'MTs 1':
        FormalEducationClass::create([
            'formal_education_id' => 2,
            'class_name' => '7',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 2,
            'class_name' => '8',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 2,
            'class_name' => '9',
            'qty' => 40,
            'current_qty' => 0,
        ]);

        // case 'MTs 2':
        FormalEducationClass::create([
            'formal_education_id' => 3,
            'class_name' => '7',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 3,
            'class_name' => '8',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 3,
            'class_name' => '9',
            'qty' => 40,
            'current_qty' => 0,
        ]);

        // case 'MA 1':
        FormalEducationClass::create([
            'formal_education_id' => 4,
            'class_name' => '10',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 4,
            'class_name' => '11',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 4,
            'class_name' => '12',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        // case 'MA 2':
        FormalEducationClass::create([
            'formal_education_id' => 5,
            'class_name' => '10',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 5,
            'class_name' => '11',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 5,
            'class_name' => '12',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        // case 'STIS':
        FormalEducationClass::create([
            'formal_education_id' => 6,
            'class_name' => 'Semester 1',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 6,
            'class_name' => 'Semester 2',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 6,
            'class_name' => 'Semester 3',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 6,
            'class_name' => 'Semester 4',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 6,
            'class_name' => 'Semester 5',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 6,
            'class_name' => 'Semester 6',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 6,
            'class_name' => 'Semester 7',
            'qty' => 40,
            'current_qty' => 0,
        ]);
        FormalEducationClass::create([
            'formal_education_id' => 6,
            'class_name' => 'Semester 8',
            'qty' => 40,
            'current_qty' => 0,
        ]);
    }
}
