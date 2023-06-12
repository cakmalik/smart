<?php

namespace App\Repositories\Student;

use LaravelEasyRepository\Repository;

interface StudentRepository extends Repository
{

    public function createParent($data);

    public function updateParent($data, $student);
}
