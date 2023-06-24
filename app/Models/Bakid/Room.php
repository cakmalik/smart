<?php

namespace App\Models\Bakid;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];
    //dormitory
    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class);
    }
    //students
    public function students()
    {
        return $this->belongsToMany(Student::class, 'room_students');
    }
}
