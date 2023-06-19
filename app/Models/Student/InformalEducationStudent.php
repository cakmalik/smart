<?php

namespace App\Models\Student;

use App\Models\Student;
use App\Models\Formal\FormalEducation;
use Illuminate\Database\Eloquent\Model;
use App\Models\Formal\FormalEducationClass;
use App\Models\Formal\FormalEducationGrade;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InformalEducationStudent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function formal()
    {
        return $this->belongsTo(FormalEducation::class);
    }

    public function class()
    {
        return $this->belongsTo(FormalEducationClass::class);
    }

    public function grade()
    {
        return $this->belongsTo(FormalEducationGrade::class);
    }
}
