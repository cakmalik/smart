<?php

namespace App\Models\Student;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEducationalBackground extends Model
{
    use HasFactory;
    protected $guarded = [];

    function student()
    {
        return $this->belongsTo(Student::class);
    }
}
