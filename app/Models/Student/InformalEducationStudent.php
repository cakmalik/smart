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

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function informal()
    {
        return $this->belongsTo(InformalEducation::class, 'informal_education_id');
    }

    public function class()
    {
        return $this->belongsTo(InformalEducationClass::class,'informal_education_class_id');
    }

    public function grade()
    {
        return $this->belongsTo(InformalEducationGrade::class);
    }
}
