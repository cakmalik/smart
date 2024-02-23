<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Formal\FormalEducationClass;
use App\Models\Formal\FormalEducationGrade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BakidEducationGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // rombel
         $formal_education_class = FormalEducationClass::all();

         foreach ($formal_education_class as $key => $value) {
             // $value->rombel()->create(['grade_name   ' => $value->class_name . 'A', 'qty' => 40]);
             FormalEducationGrade::create([
                 'formal_education_class_id' => $value->id,
                 'grade_name' => $value->class_name . 'A',
                 'qty' => 40
             ]);
 
             FormalEducationGrade::create([
                 'formal_education_class_id' => $value->id,
                 'grade_name' => $value->class_name . 'B',
                 'qty' => 40
             ]);
 
             FormalEducationGrade::create([
                 'formal_education_class_id' => $value->id,
                 'grade_name' => $value->class_name . 'C',
                 'qty' => 40
             ]);
         }
    }
}
