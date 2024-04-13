<?php

namespace App\Models\Student;

use App\Models\Student;
use App\Models\Formal\FormalEducation;
use Illuminate\Database\Eloquent\Model;
use App\Models\Formal\FormalEducationClass;
use App\Models\Formal\FormalEducationGrade;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormalEducationStudent extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'formal_education_students';

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function lembaga()
    {
        return $this->belongsTo(FormalEducation::class, 'formal_education_id');
    }

    public function formal()
    {
        return $this->belongsTo(FormalEducation::class, 'formal_education_id');
    }

    public function kelas()
    {
        return $this->belongsTo(FormalEducationClass::class, 'formal_education_class_id');
    }

    public function rombel()
    {
        return $this->belongsTo(FormalEducationGrade::class, 'formal_education_grade_id');
    }
}