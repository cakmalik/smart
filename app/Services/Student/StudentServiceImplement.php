<?php

namespace App\Services\Student;

use LaravelEasyRepository\Service;
use App\Repositories\Student\StudentRepository;

class StudentServiceImplement extends Service implements StudentService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(StudentRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }
    public function createAll($request)
    {
        try {
            // insert to students table
            //insert to student_families table
            //insert to student_educations table
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
