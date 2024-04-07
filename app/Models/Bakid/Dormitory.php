<?php

namespace App\Models\Bakid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dormitory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'room_students', 'dormitory_id', 'student_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function scopeFilter($query, $val)
    {
        return $query->where('gender', $val);
    }
}