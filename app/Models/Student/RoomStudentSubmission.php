<?php

namespace App\Models\Student;

use App\Models\Student;
use App\Models\Bakid\Room;
use App\Models\Bakid\Dormitory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomStudentSubmission extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class, 'dormitory_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}