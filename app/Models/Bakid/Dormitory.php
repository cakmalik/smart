<?php

namespace App\Models\Bakid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dormitory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'room_students', 'dormitory_id', 'student_id')
            ->withPivot('status')
            ->withTimestamps();
    }
}
