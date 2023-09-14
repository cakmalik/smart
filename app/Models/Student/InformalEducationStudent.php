<?php

namespace App\Models\Student;

use App\Models\Student;
use App\Models\Formal\FormalEducation;
use Illuminate\Database\Eloquent\Model;
use App\Models\Formal\FormalEducationClass;
use App\Models\Formal\FormalEducationGrade;
use App\Models\Informal\InformalEducation;
use App\Models\Informal\InformalEducationClass;
use App\Models\Informal\InformalEducationGrade;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InformalEducationStudent extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'informal_education_students';
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function lembaga()
    {
        return $this->belongsTo(InformalEducation::class, 'informal_education_id');
    }
    public function informal()
    {
        return $this->belongsTo(FormalEducation::class, 'formal_education_id');
    }
    public function kelas()
    {
        return $this->belongsTo(InformalEducationClass::class, 'informal_education_class_id');
    }

    public function rombel()
    {
        return $this->belongsTo(InformalEducationGrade::class, 'informal_education_grade_id');
    }
}
