<?php

namespace App\Services\Student;

use LaravelEasyRepository\Service;
use App\Repositories\Student\StudentRepository;

class StudentServiceImplement extends Service implements StudentService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(StudentRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
