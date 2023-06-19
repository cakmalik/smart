<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomStudent extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function students()
    {
        return $this->belongsTo(Student::class);
    }
}
