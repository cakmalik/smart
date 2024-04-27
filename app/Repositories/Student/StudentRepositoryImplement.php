<?php

namespace App\Repositories\Student;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Student;
use App\Models\Student\RoomStudent;
use App\Models\StudentFamily;
use Illuminate\Support\Collection;

class StudentRepositoryImplement extends Eloquent implements StudentRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Student $model)
    {
        $this->model = $model;
    }

    public function createParent($data)
    {
        return StudentFamily::create($data);
    }

    public function updateParent($data, $student)
    {
        return $student->parent->update($data);
    }

    function findNis($nis): Student
    {
        return
            Student::where('nis', $nis)->first();
    }

    public function updateAsrama($dormitory_id, $room_id, $student)
    {
        RoomStudent::where('student_id', $student->id)->update(['dormitory_id' => $dormitory_id, 'room_id' => $room_id]);
    }
}